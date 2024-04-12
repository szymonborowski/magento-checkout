<?php

declare(strict_types=1);

/**
 * File: OrderType.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model;

use Magento\Framework\Model\AbstractModel;
use Szymonborowski\Checkout\Api\Data\OrderTypeInterface;
use Szymonborowski\Checkout\Model\ResourceModel\OrderType as OrderTypeResourceModel;

/**
 * class OrderTypeInterface
 * @package Szymonborowski\Checkout\Model
 */
class OrderType extends AbstractModel implements OrderTypeInterface
{
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($value): void
    {
        $this->setData(self::ID, $value);
    }

    /**
     * @inheritDoc
     */
    public function getQuoteId(): int
    {
        return (int)$this->getData(self::QUOTE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setQuoteId(int $value): void
    {
        $this->setData(self::QUOTE_ID, $value);
    }

    /**
     * @inheritDoc
     */
    public function getOrderTypeId(): int
    {
        return (int)$this->getData(self::ORDER_TYPE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderTypeId(int $value): void
    {
        $this->setData(self::ORDER_TYPE_ID, $value);
    }

    protected function _construct(): void
    {
        $this->_init(OrderTypeResourceModel::class);
    }
}
