<?php

namespace Szymonborowski\Checkout\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Szymonborowski\Checkout\Model\OrderType\Source\Options;

class OrderTypeLayoutPreprocessor implements LayoutProcessorInterface
{
    public function __construct(private readonly Options $options)
    {
    }

    /**
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $additionalOptions = $this->options->toOptionArray();

        $jsLayout['components']['checkout']['children']['steps']['children']['order-type-step'] = [
            'component' => 'Szymonborowski_Checkout/js/view/order-type',
            'config' => [
                'template' => 'Szymonborowski_Checkout/order-type',
                'options' => $additionalOptions,
                'multiple' => false,
                'id' => 'order_type'
            ],
            'label' => __('Order type'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'id' => 'order_type'
        ];

        return $jsLayout;
    }
}
