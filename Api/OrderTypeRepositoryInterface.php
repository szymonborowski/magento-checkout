<?php

declare(strict_types=1);

/**
 * File: OrderTypeInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Api\Data\OrderTypeInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeSearchResultsInterface;

/**
 * interface OrderTypeInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeRepositoryInterface
{
    /**
     * @param int $quoteId
     * @return OrderTypeInterface
     * @throws NoSuchEntityException
     */
    public function getByQuoteId(int $quoteId): OrderTypeInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return OrderTypeSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param OrderTypeInterface $orderType
     * @return void
     */
    public function save(OrderTypeInterface $orderType): void;

    /**
     * @param OrderTypeInterface $orderType
     * @return void
     */
    public function delete(OrderTypeInterface $orderType): void;
}
