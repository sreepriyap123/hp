<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\CC\Api;

use HP\CC\Api\Data\CCInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CCManagementInterface
 *
 * @api
 */
interface CCManagementInterface
{
    /**
     * Save Payment Details Data
     *
     * @param string $incrementId
     * @param \HP\CC\Api\Data\CCInterface $paymentplanItemDetails
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function updatePaymentInfo($incrementId, CCInterface $paymentplanItemDetails);
}
