<?php
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\Api;

/**
 * Interface OrderDetailsRepositoryInterface
 *
 * @api
 */
interface OrderDetailsRepositoryInterface
{
    /**
     * Save Fedex OrderDetails
     *
     * @api
     * @param  string $incrementId
     * @param  \HP\Orders\Api\Data\OrderDetailsInterface $items
     * @return string
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function save($incrementId, \HP\Orders\Api\Data\OrderDetailsInterface $items);
}
