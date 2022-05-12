<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Model;

use HP\Faq\Model\ResourceModel\Faq as ResourceModel;

class Faq extends \Magento\Framework\Model\AbstractModel
{
    /**
     * CMS page cache tag.
     */
    public const CACHE_TAG = 'faq';

    /**
     * @var string
     */
    protected $_cacheTag = 'faq';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'faq';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
