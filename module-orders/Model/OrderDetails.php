<?php
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\Model;

use Magento\Framework\Model\AbstractModel;
use HP\Orders\Model\ResourceModel\OrderDetails as ResourceModel;

/**
 * Class OrderDetails defines the model class
 */
class OrderDetails extends AbstractModel
{
    /**
     * OrderDetails Constructor
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
        $this->_idFieldName = 'id';
    }
}
