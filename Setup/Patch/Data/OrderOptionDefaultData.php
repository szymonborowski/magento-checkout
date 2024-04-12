<?php

declare(strict_types=1);

/**
 * File: OrderOptionDefaultData.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsInterfaceFactory;
use Szymonborowski\Checkout\Api\OrderTypeOptionsRepositoryInterface;

/**
 * Class OrderOptionDefaultData
 * @package LizardMedia\AheadworksBlog\Setup\Patch\Data
 */
class OrderOptionDefaultData implements DataPatchInterface, PatchRevertableInterface
{
    private const ORDER_TYPE = [
        'Standardowe',
        'Ekspozycyjne',
        'Testowe',
    ];

    public function __construct(
        private readonly OrderTypeOptionsRepositoryInterface $orderTypeOptionsRepository,
        private readonly OrderTypeOptionsInterfaceFactory $orderTypeOptionsFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        foreach (self::ORDER_TYPE as $option) {
            $orderTypeOption = $this->orderTypeOptionsFactory->create();
            $orderTypeOption->setLabel($option);
            $this->orderTypeOptionsRepository->save($orderTypeOption);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function revert()
    {
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }
}
