<?php
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\Model\ResourceModel\OrderDetails;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use HP\Orders\Model\OrderDetails as Model;
use HP\Orders\Model\ResourceModel\OrderDetails as ResourceModel;

/**
 * Class Collection
 * Collection for displaying Order extra details of FedEx
 */
class Collection extends AbstractCollection
{
    /**
     * Defines the model and resource model class
     *
     * @return $this
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
        $this->_idFieldName = 'id';
    }
}
