<?php

/**
 * Copyright © 2021 HP. All rights reserved.
 */

namespace HP\Orders\Api;

/**
 * Interface OrderRepositoryInterface
 *
 * @api
 */
interface OrderRepositoryInterface
{
    /**
     * Save the tracking info
     *
     * @api
     * @param string $incrementId
     * @param string $sku
     * @param string $omsId
     * @param string $omsStatus
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function saveTrackingInfo($incrementId, $sku, $omsId = '', $omsStatus = '');

    /**
     * Update the order status
     *
     * @api
     * @param string $incrementId
     * @param string $status
     * @param string $comment
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function updateStatus($incrementId, $status, $comment = '');

    /**
     * Get Customer Orders
     *
     * @api
     * @param  int $pageSize
     * @param  int $currentPage
     * @param  string $condition
     * @param  string $status
     * @param  string $incrementId
     * @param  string $email
     * @param  string $fname
     * @param  string $lname
     * @param  string $fromDate
     * @param  string $toDate
     * @return mixed
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrders(
        $pageSize = 20,
        $currentPage = 1,
        $condition = 'and',
        $status = '',
        $incrementId = '',
        $email = '',
        $fname = '',
        $lname = '',
        $fromDate = '',
        $toDate = ''
    );

    /**
     * Update the order status
     *
     * @api
     * @param string $incrementId
     * @param string $status
     * @param string $comment
     * @param mixed $oms
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function changeStatus($incrementId, $status, $comment = '', $oms = null);

    /**
     * Save the tracking info
     *
     * @api
     * @param string $incrementId
     * @param string $omsId
     * @param string $omsStatus
     * @param string $deliveryCompany
     * @param string $shippingNumber
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function saveTracking($incrementId, $omsId, $omsStatus, $deliveryCompany = '', $shippingNumber = '');

    /**
     * Get Order By Id
     *
     * @api
     * @param  string $incrementId
     * @return mixed
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrder($incrementId);
}
