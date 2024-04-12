<?php

/**
 * File: OrderRepository.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

declare(strict_types=1);

namespace Szymonborowski\Checkout\Plugin\Sales;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderExtension;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeInterfaceFactory;
use Szymonborowski\Checkout\Api\OrderTypeRepositoryInterface;

/**
 * class OrderRepository
 * @package Szymonborowski\Checkout\Plugin\Sales
 */
class OrderRepository
{
    public function __construct(
        private readonly OrderTypeRepositoryInterface $orderTypeRepository,
        private readonly OrderTypeInterfaceFactory $orderTypeFactory,
        private readonly OrderExtensionFactory $orderExtensionFactory
    ) {
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSave(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ): OrderInterface {
        /** @var OrderExtension $extensionAttributes */
        $extensionAttributes = $resultOrder->getExtensionAttributes();

        if (!($extensionAttributes && $extensionAttributes->getOrderTypeId())) {
            return $resultOrder;
        }

        $orderType = $this->orderTypeFactory->create();
        $orderType->setId((int)$resultOrder->getId());
        $orderType->setOrderTypeId((int)$extensionAttributes->getOrderTypeId());
        $this->orderTypeRepository->save($orderType);

        return $resultOrder;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ): OrderInterface {
        try {
            $orderType = $this->orderTypeRepository->getByOrderId((int)$resultOrder->getId());
            $extensionAttributes = $resultOrder->getExtensionAttributes() ?? $this->orderExtensionFactory->create();
            $extensionAttributes->setOrderTypeId((int)$orderType->getOrderTypeId());
            $resultOrder->setExtensionAttributes($extensionAttributes);
        } catch (NoSuchEntityException $e) {
        }

        return $resultOrder;
    }
}
