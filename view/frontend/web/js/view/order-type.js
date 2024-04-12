define([
    'ko',
    'Magento_Ui/js/form/element/checkbox-set',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Customer/js/customer-data',
    'mage/storage',
    'mage/url',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/full-screen-loader',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/error-processor',
    'uiRegistry',
], function (
    ko,
    Component,
    _,
    stepNavigator,
    customerData,
    storage,
    urlBuilder,
    customer,
    fullScreenLoader,
    quote,
    errorProcessor,
    registry
) {
    return Component.extend({
        defaults: {
            template: 'Szymonborowski_Checkout/order-type',
            isVisible: ko.observable(false),
            stepCode: 'order-type',
            stepTitle: 'Order type',
        },

        /**
         * @return {*}
         */
        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                this.stepCode,
                null,
                this.stepTitle,
                this.isVisible,
                _.bind(this.navigate, this),
                0
            );

            return this;
        },

        /**
         * @returns void
         */
        navigate: function () {
            this.isVisible(true);
        },

        rates: function () {
            return this.options;
        },

        setOrderTypeInformation: function () {
            if (this.orderTypeInformationValidation()) {
                registry.async('checkoutProvider')(function (checkoutProvider) {
                    let orderType = checkoutProvider.get('orderType');
                    if (orderType) {
                        checkoutProvider.set('orderType', orderType);
                    }
                });
                stepNavigator.next();
            }
        },

        orderTypeInformationValidation: function () {
            return true;
        },

        setOrderType: function (element) {
            let orderTypeId = element.value;
            let serviceUrl;
            let params = {};
            let headers = {};

            if (!customer.isLoggedIn()) {
                serviceUrl = urlBuilder.build('rest/V1/guest-carts/' + quote.getQuoteId() + '/order-type');
            } else {
                serviceUrl = urlBuilder.build('rest/V1/carts/mine/order-type');
            }

            params.car_id = quote.getQuoteId();
            params.order_type_id = orderTypeId;

            fullScreenLoader.startLoader();

            return storage.post(
                serviceUrl, JSON.stringify(params), true, 'application/json', headers
            ).done(
                function (response) {
                    fullScreenLoader.stopLoader();
                }
            ).fail(
                function (response) {
                    errorProcessor.process(response);
                    fullScreenLoader.stopLoader();
                }
            );
        }
    });
});
