<?php

declare(strict_types=1);

/**
 * File: SaveButton.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Block\Adminhtml\EditForm;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * class SaveButton
 * @package Szymonborowski\Checkout\Block\EditForm
 */
class SaveButton implements ButtonProviderInterface
{
    public function __construct(private readonly Context $context)
    {
    }

    public function getEntityId(): ?int
    {
        return ((int)$this->context->getRequest()->getParam('id')) ?: null;
    }

    public function getUrl($route = '', $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
