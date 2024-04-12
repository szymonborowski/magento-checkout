<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptions.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model;

use Magento\Framework\Model\AbstractModel;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsInterface;
use Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions as OrderTypeOptionsResourceModel;

/**
 * class OrderTypeOptions
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeOptions extends AbstractModel implements OrderTypeOptionsInterface
{
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @param $value
     */
    public function setId($value): void
    {
        $this->setData(self::ID, $value);
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return (string)$this->getData(self::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setLabel(string $label): void
    {
        $this->setData(self::LABEL, $label);
    }

    protected function _construct(): void
    {
        $this->_init(OrderTypeOptionsResourceModel::class);
    }
}
