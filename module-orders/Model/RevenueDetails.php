<?php  declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Model;

use Magento\Framework\Exception\LocalizedException as CoreException;
use Magento\Rule\Model\AbstractModel;

class RevenueDetails extends \Magento\Framework\Model\AbstractModel
{
    
    /**
     * Initialize resource model.
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(ResourceModel\Report\RevenueDetails::class);
    }
}
