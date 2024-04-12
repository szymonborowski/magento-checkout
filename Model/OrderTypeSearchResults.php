<?php

declare(strict_types=1);

/**
 * File: OrderTypeSearchResults.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model;

use Magento\Framework\Api\SearchResults;
use Szymonborowski\Checkout\Api\Data\OrderTypeSearchResultsInterface;

/**
 * class OrderTypeSearchResults
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeSearchResults extends SearchResults implements OrderTypeSearchResultsInterface
{
}
