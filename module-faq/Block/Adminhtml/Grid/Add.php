<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */
declare(strict_types=1);

namespace HP\Faq\Block\Adminhtml\Grid;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use HP\Faq\Block\Adminhtml\Grid\Edit\Button\Generic;
use Magento\Framework\AuthorizationInterface;

class Add extends Generic implements ButtonProviderInterface
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;
    /**
     * Add constructor.
     *
     * @param AuthorizationInterface $authorization
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        AuthorizationInterface $authorization,
        \Magento\Backend\Block\Widget\Context $context
    ) {
        $this->authorization = $authorization;
        parent::__construct($context);
    }
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        if (!$this->authorization->isAllowed('HP_Faq::add')) {
            return [];
        }
        return [
            'label' => __('Add New FAQ'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('*/*/add')),
            'class' => 'primary',
            'sort_order' => 10
        ];
    }
}
