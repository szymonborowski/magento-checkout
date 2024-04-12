<?php

declare(strict_types=1);

/**
 * File: OrderTypeManagement.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Szymonborowski\Checkout\Api\OrderTypeManagementInterface;
use Szymonborowski\Checkout\Api\OrderTypeRepositoryInterface;

/**
 * class OrderTypeManagement
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeManagement implements OrderTypeManagementInterface
{
    public function __construct(
        private readonly QuoteIdMaskFactory $quoteIdMaskFactory,
        private readonly CartRepositoryInterface $cartRepository,
        private readonly OrderTypeFactory $orderTypeFactory,
        private readonly OrderTypeRepositoryInterface $orderTypeRepository
    ) {
    }

    /**
     * @param string $cartId
     * @param string $orderTypeId
     * @return void
     * @throws NoSuchEntityException
     */
    public function saveOrderTypeOnQuestCart($cartId, $orderTypeId): void
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        $quote = $this->cartRepository->getActive($quoteIdMask->getQuoteId());

        try {
            $orderType = $this->orderTypeRepository->getByQuoteId((int)$quote->getId());
        } catch (NoSuchEntityException $e) {
            $orderType = $this->orderTypeFactory->create();
            $orderType->setQuoteId((int)$quote->getId());
        }

        $orderType->setOrderTypeId((int)$orderTypeId);
        $this->orderTypeRepository->save($orderType);
    }

    /**
     * @param string $cartId
     * @param string $orderTypeId
     * @return void
     * @throws NoSuchEntityException
     */
    public function saveOrderTypeOnCustomerCart($cartId, $orderTypeId): void
    {
        $quote = $this->cartRepository->getActive($cartId);

        try {
            $orderType = $this->orderTypeRepository->getByQuoteId((int)$quote->getId());
        } catch (NoSuchEntityException $e) {
            $orderType = $this->orderTypeFactory->create();
            $orderType->setQuoteId($quote->getId());
        }

        $orderType->setOrderTypeId((int)$orderTypeId);
        $this->orderTypeRepository->save($orderType);
    }

    /**
     * @param string $cartId
     * @return int
     * @throws NoSuchEntityException
     */
    public function getOrderTypeOnQuestCart($cartId): int
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        $quote = $this->cartRepository->getActive($quoteIdMask->getQuoteId());

        try {
            $orderType = $this->orderTypeRepository->getByQuoteId((int)$quote->getId());
        } catch (NoSuchEntityException $e) {
        }

        return isset($orderType) ? $orderType->getOrderTypeId() : 0;
    }

    /**
     * @param string $cartId
     * @return int
     * @throws NoSuchEntityException
     */
    public function getOrderTypeOnCustomerCart($cartId): int
    {
        $quote = $this->cartRepository->getActive($cartId);

        try {
            $orderType = $this->orderTypeRepository->getByQuoteId((int)$quote->getId());
        } catch (NoSuchEntityException $e) {
        }

        return isset($orderType) ? $orderType->getOrderTypeId() : 0;
    }
}
