<?php

declare(strict_types=1);

/**
 * File: OrderTypeRepository.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Service;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Api\Data\OrderTypeInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeSearchResultsInterfaceFactory;
use Szymonborowski\Checkout\Api\OrderTypeRepositoryInterface;
use Szymonborowski\Checkout\Model\OrderTypeFactory;
use Szymonborowski\Checkout\Model\ResourceModel\OrderType as OrderTypeResource;
use Szymonborowski\Checkout\Model\ResourceModel\OrderType\CollectionFactory as OrderTypeCollectionFactory;

/**
 * class OrderTypeRepository
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeRepository implements OrderTypeRepositoryInterface
{
    public function __construct(
        private readonly OrderTypeFactory $orderTypeFactory,
        private readonly OrderTypeResource $orderTypeResource,
        private readonly OrderTypeCollectionFactory $orderTypeCollectionFactory,
        private readonly OrderTypeSearchResultsInterfaceFactory $orderTypeSearchResultsInterfaceFactory,
        private readonly CollectionProcessorInterface $orderTypeCollectionProcessor

    ) {
    }

    /**
     * @inheritDoc
     */
    public function getByQuoteId(int $quoteId): OrderTypeInterface
    {
        $orderType = $this->orderTypeFactory->create();
        $this->orderTypeResource->load($orderType, $quoteId, OrderTypeInterface::QUOTE_ID);

        if (!$orderType->getId()) {
            throw new NoSuchEntityException(__('Unable to find Order Type with ID "%1"', $quoteId));
        }

        return $orderType;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->orderTypeCollectionFactory->create();
        $this->orderTypeCollectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->orderTypeSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function save(OrderTypeInterface $orderType): void
    {
        $this->orderTypeResource->save($orderType);
    }

    /**
     * @inheritDoc
     */
    public function delete(OrderTypeInterface $orderType): void
    {
        try {
            $this->orderTypeResource->delete($orderType);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete Message Queue the entry: %1', $exception->getMessage())
            );
        }
    }
}
