<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use HP\Faq\Api\Data\FaqInterface;

interface FaqRepositoryInterface
{
    /**
     * Save the FAQ details to the database.
     *
     * @param  \HP\Faq\Api\Data\FaqInterface $faqInterface
     * @return \HP\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function save(\HP\Faq\Api\Data\FaqInterface $faqInterface);
    /**
     * Get info about FAQ by faq id
     *
     * @param  int $faqId
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($faqId);

    /**
     * Delete FAQ
     *
     * @param  \HP\Faq\Api\Data\FaqInterface $faqInterface
     * @return FaqInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\HP\Faq\Api\Data\FaqInterface $faqInterface);

    /**
     * Delete FAQ by id
     *
     * @param  int $faqId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);

    /**
     * Load data collection by given search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \HP\Faq\Api\Data\FaqSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
