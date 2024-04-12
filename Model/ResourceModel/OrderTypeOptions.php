<?php

declare(strict_types=1);

/**
 * File: OrderTypeOption.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * class OrderTypeOptions
 * @package Szymonborowski\Checkout\Model
 */
class OrderTypeOptions extends AbstractDb
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct(): void
    {
        $this->_init('sb_order_type_option', 'id');
    }
}
