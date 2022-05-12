<?php
/*
 * Copyright © 2022 HP. All rights reserved.
 */
declare(strict_types=1);

namespace HP\Faq\Block\Adminhtml\Grid\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\AuthorizationInterface;

/**
 * Class Delete button
 */
class Delete extends Generic implements ButtonProviderInterface
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * Delete constructor.
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
     * Gets the button data
     *
     * @return array
     */
    public function getButtonData()
    {
        if (!$this->authorization->isAllowed('HP_Faq::delete')) {
            return [];
        }
        $data = [];
        if ($this->getFaqId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this FAQ ?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Get the Delete URL
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['faq_id' => $this->getFaqId()]);
    }
}
