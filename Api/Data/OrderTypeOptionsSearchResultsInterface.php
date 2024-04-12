<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptionsSearchResultsInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * interface OrderTypeOptionsSearchResultsInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeOptionsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return OrderTypeOptionsInterface[]
     */
    public function getItems();

    /**
     * @param OrderTypeOptionsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
