<?php
 /**
  * Copyright © 2022 HP. All rights reserved.
  */

declare(strict_types=1);

namespace HP\Faq\Block\Adminhtml\Grid\Edit\Button;

use Magento\Backend\Block\Widget\Context;

/**
 * Class Generic to get url
 */
class Generic
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }
    /**
     * Return Faq ID
     *
     * @return int|null
     */
    public function getFaqId()
    {
        return $this->context->getRequest()->getParam('faq_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param  string $route
     * @param  array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
