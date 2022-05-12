<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use \HP\Faq\Model\FaqFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Faq::edit';

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \HP\Faq\Model\FaqFactory
     */
    private $faqFactory;

    /**
     * Edit constructor
     *
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
     * Edit the data
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $faqId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->faqFactory->create();

        if ($faqId) {
            $rowData = $rowData->load($faqId);
            if (!$rowData->getFaqId()) {
                $this->messageManager->addError(__('FAQ no longer exist.'));
                return $resultRedirect->setPath('faq/index/edit');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = "Edit FAQ";
        $resultPage->getConfig()->getTitle()->prepend($title);
        $resultPage->setActiveMenu('HP_Faq::edit');
        return $resultPage;
    }
    /**
     * Check Edit Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        if (($this->_authorization->isAllowed('HP_Faq::add')) || ($this->_authorization->isAllowed('HP_Faq::edit'))) {
            return true;
        }
        return false;
    }
}
