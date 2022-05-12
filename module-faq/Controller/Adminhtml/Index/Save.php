<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var FaqDataFactory $faqDataFactory
     */
    private $faqDataFactory;
    /**
     * @var FaqRepository $faqRepository
     */
    private $faqRepository;
    /**
     * @var @DataObjectHelper $dataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var Context $context
     */
    private $context;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param \HP\Faq\Api\Data\FaqInterfaceFactory $faqDataFactory
     * @param \HP\Faq\Api\FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \HP\Faq\Api\Data\FaqInterfaceFactory $faqDataFactory,
        \HP\Faq\Api\FaqRepositoryInterface $faqRepository
    ) {
        $this->faqRepository = $faqRepository;
        $this->faqDataFactory = $faqDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context);
    }
    /**
     * Execute method will Save the FAQ
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (isset($data['faq_id'])) {
                $faqId = $data['faq_id'];
                $faqRepository = $this->faqRepository->getById($faqId);
                $dataArray['faq_id'] = $faqId;

                if (!$faqRepository->getFaqId() && $faqId) {
                    $this->messageManager->addError(__('This FAQ no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $dataArray['question'] = $data['question'];
            $dataArray['answer'] = $data['answer'];
            $dataArray['sort_order'] = $data['sort_order'];

            $faqInterface = $this->faqDataFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $faqInterface,
                $dataArray,
                FaqInterface::class
            );
            try {
                $faqData = $this->faqRepository->save($faqInterface);
                $this->_getSession()->setFormData(false);
                $this->messageManager->addSuccess(__('You saved the FAQ.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faq_id' => $faqInterface->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_getSession()->setFormData($data);
                return $resultRedirect->setPath(
                    '*/*/edit',
                    ['faq_id' => $faqInterface->getId()]
                );
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
    /**
     * Check save Permission.
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
