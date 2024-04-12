<?php

declare(strict_types=1);

namespace Szymonborowski\Checkout\Api;

use Magento\Framework\Exception\NoSuchEntityException;

interface OrderTypeManagementInterface
{
    /**
     * @param string $cartId
     * @param string $orderTypeId
     * @return void
     * @throws NoSuchEntityException
     */
    public function saveOrderTypeOnQuestCart($cartId, $orderTypeId): void;

    /**
     * @param string $cartId
     * @param string $orderTypeId
     * @return void
     * @throws NoSuchEntityException
     */
    public function saveOrderTypeOnCustomerCart($cartId, $orderTypeId): void;

    /**
     * @param string $cartId
     * @return int
     * @throws NoSuchEntityException
     */
    public function getOrderTypeOnQuestCart($cartId): int;

    /**
     * @param string $cartId
     * @return int
     * @throws NoSuchEntityException
     */
    public function getOrderTypeOnCustomerCart($cartId): int;
}
