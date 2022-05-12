<?php  declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Model\ResourceModel\Report;

class RevenueDetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('sales_order_item', 'item_id');
    }
}
