<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\Model;

use HP\Orders\Api\OrderDetailsRepositoryInterface;
use HP\Orders\Model\ResourceModel\OrderDetails as ResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use HP\Orders\Helper\Data;

/**
 * Add order details to the database
 */
class OrderDetailsRepository implements OrderDetailsRepositoryInterface
{

    /**
     * @var \ResourceModel\OrderDetails
     */
    private $resourceModel;
    /**
     * @var OrderDetailsFactory $orderDetailsFactory
     */
    private $orderDetailsFactory;

    /**
     * @var OrderInterface $order
     */
    private $order;
    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;

    /**
     * @var Data
     */
    private $helper;

    /**
     * OrderDetailsRepository Constructor
     *
     * @param OrderInterface $order
     * @param \HP\Orders\Api\Data\OrderDetailsInterfaceFactory $orderDataFactory
     * @param OrderDetailsFactory $orderDetailsFactory
     * @param ResourceModel $resourceModel
     * @param \Magento\Framework\Api\ExtensibleDataObjectConverter $dataObjectConverter
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param Data $helper
     */
    public function __construct(
        \Magento\Sales\Api\Data\OrderInterface $order,
        \HP\Orders\Api\Data\OrderDetailsInterfaceFactory $orderDataFactory,
        \HP\Orders\Model\OrderDetailsFactory $orderDetailsFactory,
        ResourceModel $resourceModel,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $dataObjectConverter,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        Data $helper
    ) {
        $this->order = $order;
        $this->orderDataFactory = $orderDataFactory;
        $this->orderDetailsFactory = $orderDetailsFactory;
        $this->resourceModel = $resourceModel;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->helper = $helper;
    }

    /**
     * Saves the order details
     *
     * @param  string $incrementId
     * @param  \HP\Orders\Api\Data\OrderDetailsInterface $items
     * @return string
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function save($incrementId, \HP\Orders\Api\Data\OrderDetailsInterface $items)
    {
        if (! $this->helper->clinicalAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        $orderData = $this->order->loadByIncrementId($incrementId);

        $orderId = $orderData->getEntityId();

        if (!$orderData->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }

        $fedexData = $this->dataObjectConverter->toNestedArray(
            $items,
            [],
            \HP\Orders\Api\Data\OrderDetailsInterface::class
        );
        $itemModel = $this->orderDetailsFactory->create(['data'=>$fedexData]);

        try {
            $itemModel->setOrderId($orderId);
            $itemModel->setId($items->getId());
            $this->resourceModel->save($itemModel);
            if ($items->getId()) {
                $items = $this->getById($items->getId());
            } else {
                $items->setId($itemModel->getId());
            }
            return "success";
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Unable to save order fedex details', $exception->getMessage()));
        }
    }

    /**
     * Gets the order fedex details by Id
     *
     * @param  int $id
     * @return \HP\Orders\Api\Data\OrderDetailsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id)
    {
        $fedexObj = $this->orderDetailsFactory->create()->load($id);
        // $this->resourceModel->load($fedexObj, $id);
        if (!$fedexObj->getId()) {
            throw new NoSuchEntityException(__('item with id "%1" does not exist.', $id));
        }
        $data = $this->orderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $fedexObj->getData(),
            \HP\Orders\Api\Data\OrderDetailsInterface::class
        );
        $data->setId($fedexObj->getId());
        return $data;
    }
}
