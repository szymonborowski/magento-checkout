<?php

declare(strict_types=1);

/**
 * File: Options.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model\OrderType\Source;

use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Szymonborowski\Checkout\Api\OrderTypeOptionsRepositoryInterface;

/**
 * class Options
 * @package Szymonborowski\Checkout\Model\OrderType\Source
 */
class Options implements OptionSourceInterface, ArgumentInterface
{
    public function __construct(
        private readonly OrderTypeOptionsRepositoryInterface $orderTypeOptionsRepository,
        private readonly SearchCriteriaInterfaceFactory $searchCriteriaBuilder
    ) {
    }

    public function toOptionArray()
    {
        $optionArray = [];
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $options = $this->orderTypeOptionsRepository->getList($searchCriteria)->getItems();

        foreach ($options as $option) {
            $optionArray[] = [
                'value' => $option->getId(),
                'label' => $option->getLabel()
            ];
        }

        return $optionArray;
    }
}
