<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Faq::grid_list';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Displays the FAQ.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('HP_Faq::grid_list');
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ'));
        return $resultPage;
    }
    /**
     * Check view Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
