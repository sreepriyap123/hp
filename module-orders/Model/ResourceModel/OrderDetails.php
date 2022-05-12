<?php
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class OrderDetails defines the table
 */
class OrderDetails extends AbstractDb
{
    /**
     * Order details constructor
     */
    protected function _construct()
    {
        $this->_init('order_fedex_details', 'id');
    }
}
