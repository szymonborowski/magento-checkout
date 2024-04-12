<?php

declare(strict_types=1);

/**
 * File: OrderTypeInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api\Data;

/**
 * interface OrderTypeInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeInterface
{
    public const ID = 'id';
    public const QUOTE_ID = 'quote_id';
    public const ORDER_TYPE_ID = 'order_type_id';

    /**
     * Get order ID
     */
    public function getId();

    /**
     * Set order ID
     *
     * @param int $value
     * @return void
     */
    public function setId(int $value): void;

    /**
     * Get quote ID
     *
     * @return int
     */
    public function getQuoteId(): int;

    /**
     * Set quote ID
     *
     * @param int $value
     * @return void
     */
    public function setQuoteId(int $value): void;

    /**
     * Get order type ID
     *
     * @return int
     */
    public function getOrderTypeId(): int;

    /**
     * Set order type ID
     *
     * @param int $value
     * @return void
     */
    public function setOrderTypeId(int $value): void;
}
