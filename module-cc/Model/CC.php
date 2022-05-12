<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\CC\Model;

use Magento\Framework\Exception\LocalizedException as CoreException;
use Magento\Rule\Model\AbstractModel;

class CC extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model.
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(\HP\CC\Model\ResourceModel\CC::class);
    }
}
