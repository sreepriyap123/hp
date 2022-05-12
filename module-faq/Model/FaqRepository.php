<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Model;

use HP\Faq\Api\Data\FaqInterfaceFactory;
use HP\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use HP\Faq\Model\FaqFactory as FaqFactory;
use HP\Faq\Model\ResourceModel\Faq as ResourceModel;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;
use HP\Faq\Api\Data\FaqSearchResultsInterfaceFactory;

class FaqRepository implements FaqRepositoryInterface
{
    /**
     * @var HP\Faq\Model\ResourceModel\Faq $resourceModel
     */
    private $resourceModel;
    /**
     * @var Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     */
    private $dataObjectProcessor;
    /**
     * @var HP\Faq\Api\Data\FaqInterface $dataFaqFactory
     */
    private $dataFaqFactory;
    /**
     * @var HP\Faq\Model\FaqFactory $faqFactory
     */
    private $faqFactory;

    /**
     * @var HP\Faq\Api\Data\FaqInterfaceFactory
     */
    private $faqInterface;
    /**
     * @var HP\Faq\Api\Data\FaqSearchResultsInterfaceFactor
     */
    private $searchResultFactory;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param FaqFactory $faqFactory
     * @param ResourceModel $resourceModel
     * @param FaqInterfaceFactory $faqInterface
     * @param FaqSearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        FaqFactory $faqFactory,
        ResourceModel $resourceModel,
        FaqInterfaceFactory $faqInterface,
        FaqSearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->faqFactory = $faqFactory;
        $this->resourceModel = $resourceModel;
        $this->faqInterface = $faqInterface;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * Saves the data to database
     *
     * @param  \HP\Faq\Api\Data\FaqInterface $faqInterface
     * @return mixed
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\HP\Faq\Api\Data\FaqInterface $faqInterface)
    {
        try {
            $this->resourceModel->save($faqInterface);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the FAQ %1', $exception->getMessage()),
                $exception
            );
        }
        return $faqInterface;
    }
    /**
     * Gets the FAQ data by Id
     *
     * @param  int $faqId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($faqId)
    {
        return $this->faqFactory->create()->load($faqId, 'faq_id');
    }
    /**
     * Delete the FAQ data
     *
     * @param  \HP\Faq\Api\Data\FaqInterface $faqInterface
     * @return FaqInterface
     * @throws CouldNotDeleteException
     */
    public function delete(\HP\Faq\Api\Data\FaqInterface $faqInterface)
    {
        try {
            $this->resourceModel->delete($faqInterface);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return $this;
    }
    /**
     * Delete the FAQ by FAQ id
     *
     * @param  int $faqId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId)
    {
        $faqData = $this->faqFactory->create();
        $this->resourceModel->load($faqData, $faqId);
        $this->resourceModel->delete($faqData);
        if ($faqData->isDeleted()) {
            return true;
        }
        return false;
    }

    /**
     * Load data collection by given search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \HP\Faq\Api\Data\FaqSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $collection = $this->faqFactory->create()->getCollection();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                /** if no condition is set then it will take eq condition by default */
                $condition = $filter->getConditionType() ?:'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $faqs = [];

        foreach ($collection as $faqModel) {
            $faqData = $this->faqInterface->create();
            $this->dataObjectHelper->populateWithArray(
                $faqData,
                $faqModel->getData(),
                \HP\Faq\Api\Data\FaqInterface::class
            );
            $faqs[] = $this->dataObjectProcessor->buildOutputDataArray(
                $faqData,
                \HP\Faq\Api\Data\FaqInterface::class
            );
        }
        $searchResults->setItems($faqs);
        return $searchResults;
    }
}
