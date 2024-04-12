<?php

declare(strict_types=1);

/**
 * File: EditDataProvider.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Ui\DataProvider\OrderTypes;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Szymonborowski\Checkout\Model\ResourceModel\OrderTypeOptions\CollectionFactory;

/**
 * class EditDataProvider
 * @package Szymonborowski\Checkout\Ui\DataProvider\OrderTypes
 */
class EditDataProvider extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $orderTypeCollectionFactory,
        array $meta = [],
        array $data = [],
    ) {
        $this->collection = $orderTypeCollectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}
