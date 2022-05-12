<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Model\ResourceModel;

/**
 * Faq mysql resource.
 */
class Faq extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'faq_id';
    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('faq', 'faq_id');
    }
}
