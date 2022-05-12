<?php  declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\CC\Model\ResourceModel;

class CC extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('hp_cc_additional_info', 'cc_id');
    }
}
