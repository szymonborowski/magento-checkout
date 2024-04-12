<?php

declare(strict_types=1);

/**
 * File: Collection.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Szymonborowski\Checkout\Model\OrderTypeOptions;
use Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions as OrderTypeOptionResourceModel;

/**
 * class Collection
 * @package Szymonborowski\Checkout\Model\ResourceModel\OrderType
 */
class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(OrderTypeOptions::class, OrderTypeOptionResourceModel::class);
    }
}
