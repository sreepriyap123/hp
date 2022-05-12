<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\CC\Model;

use HP\CC\Api\CCRepositoryInterface;
use HP\CC\Api\CCManagementInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\InputException;
use Magento\Sales\Api\Data\OrderInterface;
use HP\Orders\Helper\Data;

class CCManagement implements CCManagementInterface
{
    /**
     * @var HP\CC\Api\CCRepositoryInterface $ccRepository
     */
    private $ccRepository;

    /**
     * @var Magento\Sales\Api\Data\OrderInterface
     */
    private $order;

    /**
     * @var Data
     */
    private $helper;

    /**
     *  Initialize service
     *
     * @param CCRepositoryInterface $ccRepository
     * @param OrderInterface $order
     * @param Data $helper
     */
    public function __construct(
        CCRepositoryInterface $ccRepository,
        OrderInterface $order,
        Data $helper
    ) {
        $this->ccRepository = $ccRepository;
        $this->order = $order;
        $this->helper = $helper;
    }

    /**
     * Save the  data
     *
     * @param string $incrementId
     * @param \HP\CC\Api\Data\CCInterface $ccInterface
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function updatePaymentInfo($incrementId, \HP\CC\Api\Data\CCInterface $ccInterface)
    {
        if (! $this->helper->webAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        /** var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        $orderId = $order->getEntityId();
        try {
            $ccInterface->setOrderId($orderId);
            $ccData = $this->ccRepository->save($ccInterface);
        } catch (\Exception $exception) {
            throw new LocalizedException(
                __('Could not save the details %1', $exception->getMessage()),
                $exception
            );
        }
        return 'success';
    }
}
