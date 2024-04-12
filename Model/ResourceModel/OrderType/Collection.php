<?php

declare(strict_types=1);

/**
 * File: Collection.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model\ResourceModel\OrderType;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Szymonborowski\Checkout\Model\OrderType;
use Szymonborowski\Checkout\Model\ResourceModel\OrderType as OrderTypeResourceModel;

/**
 * class Collection
 * @package Szymonborowski\Checkout\Model\ResourceModel\OrderType
 */
class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(OrderType::class, OrderTypeResourceModel::class);
    }
}
