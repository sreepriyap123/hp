<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Controller\Adminhtml\Index;

use HP\Faq\Model\Faq as Faq;
use HP\Faq\Api\FaqRepositoryInterface;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var FaqRepositoryInterface $faqRepository
     */
    private $faqRepository;

    /**
     * @var Context $context
     */
    private $context;

    /**
     * @var FaqDataFactory $faqDataFactory
     */
    private $faqDataFactory;

    /**
     * Delete construct
     *
     * @param Context $context
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        FaqRepositoryInterface $faqRepository
    ) {
        $this->faqRepository = $faqRepository;
        parent::__construct($context);
    }
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Faq::delete';

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $faqId = $this->getRequest()->getParam('faq_id');

        /**
         * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
         */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($faqId) {
            try {
                $this->faqRepository->deleteById($faqId);
                $this->messageManager->addSuccess(__('FAQ has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['faq_id' => $faqId]);
            }
        }
        $this->messageManager->addError(__('We can\'t find FAQ to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
    /**
     * Check delete Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
