<?php

declare(strict_types=1);

/**
 * File: OrderTypeOptionsRepository.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Service;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsSearchResultsInterface;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsSearchResultsInterfaceFactory;
use Szymonborowski\Checkout\Api\OrderTypeOptionsRepositoryInterface;
use Szymonborowski\Checkout\Model\OrderTypeOptionsFactory;
use Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions as OrderTypeOptionsResource;
use Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions\CollectionFactory as OrderTypeOptionsCollectionFactory;

/**
 * class OrderTypeOptionsRepository
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeOptionsRepository implements OrderTypeOptionsRepositoryInterface
{
    public function __construct(
        private readonly OrderTypeOptionsFactory $orderTypeOptionsFactory,
        private readonly OrderTypeOptionsResource $orderTypeOptionsResource,
        private readonly OrderTypeOptionsCollectionFactory $orderTypeCollectionFactory,
        private readonly OrderTypeOptionsSearchResultsInterfaceFactory $orderTypeOptionsSearchResultsInterfaceFactory,
        private readonly CollectionProcessorInterface $orderTypeCollectionProcessor
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): OrderTypeOptionsInterface
    {
        $orderTypeOptions = $this->orderTypeOptionsFactory->create();
        $this->orderTypeOptionsResource->load($orderTypeOptions, $id, OrderTypeOptionsInterface::ID);

        return $orderTypeOptions;
    }

    /**
     * @inheritDoc
     */
    public function getByLabel(string $label): OrderTypeOptionsInterface
    {
        $orderTypeOptions = $this->orderTypeOptionsFactory->create();
        $this->orderTypeOptionsResource->load($orderTypeOptions, $label, OrderTypeOptionsInterface::LABEL);

        return $orderTypeOptions;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): OrderTypeOptionsSearchResultsInterface
    {
        $collection = $this->orderTypeCollectionFactory->create();
        $this->orderTypeCollectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->orderTypeOptionsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function save(OrderTypeOptionsInterface $orderType): void
    {
        $this->orderTypeOptionsResource->save($orderType);
    }

    /**
     * @inheritDoc
     */
    public function delete(OrderTypeOptionsInterface $orderType): void
    {
        try {
            $this->orderTypeOptionsResource->delete($orderType);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete Message Queue the entry: %1', $exception->getMessage())
            );
        }
    }
}
