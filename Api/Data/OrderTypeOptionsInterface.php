<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptionsInterface.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * interface OrderTypeOptionsInterface
 * @package Szymonborowski\Checkout\Api\Data
 */
interface OrderTypeOptionsInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const LABEL = 'label';

    public function getId();

    /**
     * @param int $value
     * @return void
     */
    public function setId(int $value): void;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     * @return void
     */
    public function setLabel(string $label): void;
}
