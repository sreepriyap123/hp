<?php
declare(strict_types=1);
/**
 *
 *  Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Orders\Controller\Adminhtml\Report\Sales;

class RevenueDetails extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Revenue Details Grid Page
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPage->addBreadcrumb(
            'Revenue Details',
            'Revenue Details'
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Revenue Details'));
        $resultPage->getConfig()->getTitle()
            ->prepend('Revenue Details');
        return $resultPage;
    }
}
