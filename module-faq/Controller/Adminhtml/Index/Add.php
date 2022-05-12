<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Add extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \HP\Faq\Model\FaqFactory
     */
    private $faqFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \HP\Faq\Model\FaqFactory $faqFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \HP\Faq\Model\FaqFactory $faqFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->faqFactory = $faqFactory;
    }
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Faq::add';

    /**
     * Add the FAQ
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->faqFactory->create();
        /**
         * Add data to the table
         *
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getFaqId()) {
                $this->messageManager->addError(__('Faq no longer exist.'));
                return $resultRedirect->setPath('faq/index/rowdata');
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Faq ').$rowTitle : __('Add FAQ');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * Check add Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
