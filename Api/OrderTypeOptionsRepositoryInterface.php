<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptionsInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsSearchResultsInterface;

/**
 * interface OrderTypeOptionsInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeOptionsRepositoryInterface
{
    /**
     * @param int $id
     * @return OrderTypeOptionsInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): OrderTypeOptionsInterface;

    /**
     * @param string $label
     * @return OrderTypeOptionsInterface
     * @throws NoSuchEntityException
     */
    public function getByLabel(string $label): OrderTypeOptionsInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return OrderTypeOptionsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): OrderTypeOptionsSearchResultsInterface;

    /**
     * @param OrderTypeOptionsInterface $orderType
     * @return void
     */
    public function save(OrderTypeOptionsInterface $orderType): void;

    /**
     * @param OrderTypeOptionsInterface $orderType
     * @return void
     */
    public function delete(OrderTypeOptionsInterface $orderType): void;
}
