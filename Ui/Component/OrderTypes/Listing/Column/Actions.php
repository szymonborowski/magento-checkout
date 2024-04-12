<?php

declare(strict_types=1);

/**
 * File: Actions.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Ui\Component\OrderTypes\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * class Actions
 * @package Szymonborowski\Checkout\Ui\Component\OrderTypes\Listing\Column
 */
class Actions extends Column
{
    protected UrlInterface $urlBuilder;
    protected string $viewUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        string $viewUrl = '',
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->viewUrl = $viewUrl;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['view'] = [
                        'href' => $this->urlBuilder->getUrl($this->viewUrl, ['id' => $item['id']]),
                        'target' => '_blank',
                        'label' => __('Delete')
                    ];
                }
            }
        }

        return $dataSource;
    }
}
