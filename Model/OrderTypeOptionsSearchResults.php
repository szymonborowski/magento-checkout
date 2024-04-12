<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptionsSearchResults.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model;

use Magento\Framework\Api\SearchResults;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsSearchResultsInterface;

/**
 * class OrderTypeOptionsSearchResults
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeOptionsSearchResults extends SearchResults implements OrderTypeOptionsSearchResultsInterface
{
}
