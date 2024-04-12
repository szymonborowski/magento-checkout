<?php

declare(strict_types=1);

/**
 * File: OrderTypeSearchResultInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * interface OrderTypeSearchResultInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return OrderTypeInterface[]
     */
    public function getItems();

    /**
     * @param OrderTypeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
