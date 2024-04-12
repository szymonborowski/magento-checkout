<?php

namespace Szymonborowski\Checkout\Plugin\Sales\Order\Grid;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OrderGridCollection;

class Collection
{
    /**
     * @param OrderGridCollection $subject
     * @return void
     * @throws LocalizedException
     */
    public function beforeLoad(OrderGridCollection $subject): void
    {
        if (!$subject->isLoaded()) {
            $sbOrderTypeTableName = $subject->getResource()->getTable('sb_order_type');

            $subject->getSelect()->joinLeft(
                $sbOrderTypeTableName,
                $sbOrderTypeTableName . '.quote_id = main_table.quote_id',
                $sbOrderTypeTableName . '.order_type_id'
            );
        }
    }
}
