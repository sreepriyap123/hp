<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
 */

namespace HP\Orders\Model;

use HP\Orders\Api\OrderRepositoryInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\SalesGraphQl\Model\Order\OrderAddress;
use HP\OrdersGraphQl\Model\OrderItem\DataProvider as OrderItemProvider;
use HP\Orders\Helper\Data;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItems;
use Magento\Sales\Model\Service\InvoiceService;
use Magento\Framework\DB\Transaction;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Magento\Sales\Api\Data\OrderInterface
     */
    private $order;
    
    /**
     * @var Magento\Sales\Model\Order
     */
    private $orderModel;

    /**
     * @var orderRepository
     */
    private $orderRepository;

    /**
     * @var OrderAddress
     */
    private $orderAddress;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var Data
     */
    private $helper;

    /**
     * @var CollectionFactory
     */
    private $addressCollection;

    /**
     * @var OrderItems
     */
    private $orderItems;

    /**
     * @var InvoiceService
     */
    private $invoiceService;

    /**
     * @var Transaction
     */
    private $invoiceSender;

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param \Magento\Sales\Model\Order $orderModel
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param OrderAddress $orderAddress
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param FilterBuilder $filterBuilder
     * @param OrderItemProvider $orderItemProvider
     * @param Data $helper
     * @param CollectionFactory $addressCollection
     * @param OrderItems $orderItems
     * @param InvoiceService $invoiceService
     * @param Transaction $transaction
     */
    public function __construct(
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Sales\Model\Order $orderModel,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        OrderAddress $orderAddress,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        FilterBuilder $filterBuilder,
        OrderItemProvider $orderItemProvider,
        Data $helper,
        CollectionFactory $addressCollection,
        OrderItems $orderItems,
        InvoiceService $invoiceService,
        Transaction $transaction
    ) {
        $this->order = $order;
        $this->orderModel = $orderModel;
        $this->orderRepository = $orderRepository;
        $this->orderAddress = $orderAddress;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->orderItemProvider = $orderItemProvider;
        $this->helper = $helper;
        $this->addressCollection = $addressCollection;
        $this->orderItems = $orderItems;
        $this->invoiceService = $invoiceService;
        $this->transaction = $transaction;
    }

    /**
     * @inheritDoc
     *
     * @param string $incrementId
     * @param string $sku
     * @param string $omsId
     * @param string $omsStatus
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function saveTrackingInfo($incrementId, $sku, $omsId = '', $omsStatus = '')
    {
        if (! $this->helper->clinicalAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        
        if (!$omsId && !$omsStatus) {
            throw new InputException(__('Missing required field. Set the values and try again.'));
        }

        /** var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        $orderItem = $this->orderItems->create()
                    ->addFieldToFilter('order_id', $order->getEntityId())
                    ->addFieldToFilter('sku', $sku)
                    ->getFirstItem();
        if (!$orderItem->getId()) {
            throw new NoSuchEntityException(
                __("The product that was requested doesn't exist. Verify the product and try again.")
            );
        }
        if ($omsId && $order->canInvoice()) {
            $this->createInvoice($order);
        }
        if (!$orderItem->getOmsOrderId() && ($order->getStatus() != 'approved')) {
            $orderModel = $this->orderModel->load($order->getEntityId());
            $orderModel->setState('processing')->setStatus('approved');
            $orderModel->addStatusHistoryComment('Order Approved. OMS Id: '.$omsId);
            $orderModel->save();
        }
        if ($omsId) {
            $orderItem->setOmsOrderId($omsId);
        }
        if ($omsStatus) {
            $orderItem->setOmsOrderStatus($omsStatus);
        }
        $orderItem->save();
        
        return "success";
    }

    /**
     * @inheritDoc
     *
     * @param string $incrementId
     * @param string $status
     * @param string $comment
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function updateStatus($incrementId, $status, $comment = '')
    {
        if (! $this->helper->clinicalAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        if (! $status) {
            throw new InputException(__('Status is needed. Set the status and try again.'));
        }
        /** var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        $order = $this->orderModel->load($order->getEntityId());
        if ($status == 'complete') {
            $state = 'complete';
        } elseif ($status == 'shipping' || $status == 'treatment' || $status == 'approved') {
            $state = 'processing';
        } else {
            $state = 'new';
        }
        $order->setState($state)->setStatus($status);

        $order->addStatusHistoryComment($comment);
        $order->save();
        return "success";
    }

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
    ) {
        if (! $this->helper->clinicalAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        if ($incrementId) {
            $args['filter']['increment_id'] = ['eq'=>$incrementId];
        }
        if ($email) {
            $args['filter']['customer_email'] = ['eq'=> $email] ;
        }
        if ($fname || $lname) {
            $orderIds = $this->getOrdersByName($condition, $fname, $lname);
            $args['filter']['entity_id'] = ['in'=>$orderIds];
        }
        if ($status) {
            $args['filter']['status'] = ['in'=> explode(',', $status)] ;
        } else {
            // if (! $incrementId) {
            $args['filter']['status'] = ['eq'=> 'pending'] ;
            // }
        }
        if ($fromDate && $toDate) {
            $args['filter']['created_at'] = ['from'=> $fromDate, 'to'=> $toDate] ;
        } elseif ($fromDate) {
            $args['filter']['created_at'] = ['from'=> $fromDate] ;
        } elseif ($toDate) {
            $args['filter']['created_at'] = ['to'=> $toDate] ;
        }

        $args['pageSize'] = $pageSize;
        $args['currentPage'] = $currentPage;
        $args['condition'] = $condition;

        $searchResult = $this->getSearchResult($args);
        $response[] = [
            'orders' => $this->formatOrdersArray($searchResult->getItems()),
            'total_count'=> $searchResult->getTotalCount()
        ];

        return $response;
    }

    /**
     * Get Order ids by name filter
     *
     * @param  string $condition
     * @param  string $fname
     * @param  string $lname
     * @return mixed
     */
    public function getOrdersByName($condition, $fname = '', $lname = '')
    {
        $addressCollection = $this->addressCollection->create()
                    ->addFieldToFilter('address_type', 'shipping');
        if ($condition == 'and') {
            if ($fname) {
                $addressCollection->addFieldToFilter('firstname', ['like'=>$fname]);
            }
            if ($lname) {
                $addressCollection->addFieldToFilter('lastname', ['like'=>$lname]);
            }
        } else {
            if ($fname && $lname) {
                $addressCollection->addFieldToFilter(
                    ['firstname', 'lastname'],
                    [
                        ['like' => $fname],
                        ['like' => $lname]
                    ]
                );
            } else {
                if ($fname) {
                    $addressCollection->addFieldToFilter('firstname', $fname);
                }
                if ($lname) {
                    $addressCollection->addFieldToFilter('lastname', $lname);
                }
            }
        }
        $addressCollection->addFieldToSelect('parent_id');
        $orderIds = [];
        if ($addressCollection->getSize()) {
            foreach ($addressCollection as $address) {
                $orderIds[] = $address->getParentId();
            }
        }
        return $orderIds;
    }
    
    /**
     * Format order collection for graphql schema.
     *
     * @param OrderInterface[] $orderCollection
     * @return array
     */
    private function formatOrdersArray($orderCollection)
    {
        $ordersArray = [];
        foreach ($orderCollection as $orderModel) {
            $payment = $orderModel->getPayment();
            $method = $payment->getMethodInstance();

            foreach ($orderModel->getItems() as $item) {
                if (!$item->getParentItemId()) {
                    $orderItemIds[] = (int)$item->getItemId();
                }
                $this->orderItemProvider->addOrderItemId((int)$item->getItemId());
            }
            $itemsList = [];
            foreach ($orderItemIds as $orderItemId) {
                $item = $this->orderItemProvider->getOrderItemById((int)$orderItemId);
                $item['id'] = $orderItemId;
                unset($item['associatedProduct']);
                unset($item['model']);
                $itemsList[] = $item;
            }

            $ordersArray[] = [
                'id' => $orderModel->getEntityId(),
                'email' => $orderModel->getCustomerEmail(),
                'increment_id' => $orderModel->getIncrementId(),
                'order_date' => $orderModel->getCreatedAt(),
                'diagnosis_result' => $orderModel->getDiagnosisResult(),
                'status' => $orderModel->getStatusLabel(),
                'shipping_address' => $this->orderAddress->getOrderShippingAddress($orderModel),
                'billing_address' => $this->orderAddress->getOrderBillingAddress($orderModel),
                'shipping_method' => $orderModel->getShippingDescription(),
                'payment_methods' => $method->getTitle(),
                'currency' => $orderModel->getOrderCurrencyCode(),
                'totals' =>[
                    'grand_total' => $orderModel->getGrandTotal(),
                    'subtotal' => $orderModel->getSubtotal(),
                    'taxes' => $orderModel->getTaxAmount(),
                    'total_shipping' => $orderModel->getShippingAmount(),
                    'discounts' => $orderModel->getDiscountAmount()
                ],
                'items' => $itemsList
            ];
        }
        return $ordersArray;
    }
    
    /**
     * Get search result from REST API arguments
     *
     * @param  array $args
     * @return \Magento\Sales\Api\Data\OrderSearchResultInterface
     * @throws InputException
     */
    private function getSearchResult(array $args)
    {
        $filterGroups = $this->createFilterGroups($args);
        $this->searchCriteriaBuilder->setFilterGroups($filterGroups);
        if (isset($args['currentPage'])) {
            $this->searchCriteriaBuilder->setCurrentPage($args['currentPage']);
        }
        if (isset($args['pageSize'])) {
            $this->searchCriteriaBuilder->setPageSize($args['pageSize']);
        }
        $sortOrder[] = $this->sortOrderBuilder->setField('created_at')->setDirection('DESC')->create();
        $sortOrder[] = $this->sortOrderBuilder->setField('entity_id')->setDirection('DESC')->create();

        $this->searchCriteriaBuilder->setSortOrders($sortOrder);

        return $this->orderRepository->getList($this->searchCriteriaBuilder->create());
    }

    /**
     * Create filter for filtering the orders.
     *
     * @param  array $args
     * @return FilterGroup[]
     */
    public function createFilterGroups(
        array $args
    ): array {
        $filterGroups = [];
       
        if (isset($args['filter'])) {
            $filters = [];
            foreach ($args['filter'] as $field => $cond) {
                foreach ($cond as $condType => $value) {
                    if ($args['condition'] == 'and') {
                        $filters = [];
                    }
                    if ($condType === 'match') {
                        if (is_array($value)) {
                            throw new InputException(__('Invalid match filter'));
                        }
                        $searchValue = str_replace('%', '', $value);
                        $filters[] = $this->filterBuilder->setField($field)
                            ->setValue("%{$searchValue}%")
                            ->setConditionType('like')
                            ->create();
                    } else {
                        $filters[] = $this->filterBuilder->setField($field)
                            ->setValue($value)
                            ->setConditionType($condType)
                            ->create();
                    }
                    if ($args['condition'] == 'and') {
                        $this->filterGroupBuilder->setFilters($filters);
                        $filterGroups[] = $this->filterGroupBuilder->create();
                    }
                }
            }
            if ($args['condition'] != 'and') {
                $this->filterGroupBuilder->setFilters($filters);
                $filterGroups[] = $this->filterGroupBuilder->create();
            }
        }
        return $filterGroups;
    }
    
    /**
     * Create Invoice
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     */
    private function createInvoice($order)
    {
        if ($order) {
            $invoice = $this->invoiceService->prepareInvoice($order);
            $invoice->register();
            $invoice->getOrder()->setIsInProcess(true);
            $invoice->save();
            $transactionSave =
                $this->transaction
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder());
            $transactionSave->save();
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $incrementId
     * @param string $status
     * @param string $comment
     * @param mixed $oms
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function changeStatus($incrementId, $status, $comment = '', $oms = null)
    {
        $statusArray = ['denied', 'approved', 'treatment', 'complete'];
        if (! $status) {
            throw new InputException(__('Status is needed. Set the status and try again.'));
        } elseif (! in_array($status, $statusArray)) {
            throw new InputException(__('Invalid status value.'));
        }

        /** var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        
        $order = $this->orderModel->load($order->getEntityId());
        if ($status == 'approved') {
            $state = 'processing';
            $this->createInvoice($order);
        } elseif ($status == 'complete') {
            $state = 'complete';
        } elseif ($status == 'treatment') {
            if ($order->getStatus() != 'shipping') {
                return "Can't change the status to treatment.";
            }
            $state = 'processing';
        } else {
            $state = 'new';
        }
        $order->setState($state)->setStatus($status);
        $order->addStatusHistoryComment($comment);
        $order->save();
        if (! empty($oms)) {
            if ($oms['sku']) {
                $orderItem = $this->orderItems->create()
                ->addFieldToFilter('order_id', $order->getEntityId())
                ->addFieldToFilter('sku', $oms['sku'])
                ->getFirstItem();
                if (!$orderItem->getId()) {
                    throw new NoSuchEntityException(
                        __("The product that was requested doesn't exist. Verify the product and try again.")
                    );
                }
                if ($oms['order_id']) {
                    $orderItem->setOmsOrderId($oms['order_id']);
                }
                if ($oms['order_status']) {
                    $orderItem->setOmsOrderStatus($oms['order_status']);
                }
                $orderItem->save();
            }
        }
        return "success";
    }

    /**
     * @inheritDoc
     *
     * @param string $incrementId
     * @param string $omsId
     * @param string $omsStatus
     * @param string $deliveryCompany
     * @param string $shippingNumber
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function saveTracking($incrementId, $omsId, $omsStatus, $deliveryCompany = '', $shippingNumber = '')
    {
        
        if (!$omsId && !$omsStatus) {
            throw new InputException(__('Missing required fields. Set the values and try again.'));
        }

        /** var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        $orderItem = $this->orderItems->create()
                    ->addFieldToFilter('order_id', $order->getEntityId())
                    ->addFieldToFilter('oms_order_id', $omsId)
                    ->getFirstItem();

        if (!$orderItem->getId()) {
            throw new NoSuchEntityException(
                __("The product that was requested doesn't exist. Verify the product and try again.")
            );
        }
        
        if (($omsStatus == 'shipping') && ($order->getStatus() == 'approved')) {
            $orderModel = $this->orderModel->load($order->getEntityId());
            $orderModel->setState('processing')->setStatus('shipping');
            $orderModel->addStatusHistoryComment('Order moved to shipping.');
            $orderModel->save();
        }
        if ($omsId) {
            $orderItem->setOmsOrderId($omsId);
        }
        if ($omsStatus) {
            $orderItem->setOmsOrderStatus($omsStatus);
        }
        if ($deliveryCompany) {
            $orderItem->setDeliveryCompany($deliveryCompany);
        }
        if ($shippingNumber) {
            $orderItem->setShippingNumber($shippingNumber);
        }
        $orderItem->save();
        
        return "success";
    }

    /**
     * Get Order By Id
     *
     * @api
     * @param  string $incrementId
     * @return mixed
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrder($incrementId)
    {
        $order = $this->order->loadByIncrementId($incrementId);
        if (!$order->getEntityId()) {
            throw new NoSuchEntityException(
                __("The entity that was requested doesn't exist. Verify the entity and try again.")
            );
        }
        $orderArray = [];
        $shippingAddress = $this->orderAddress->getOrderShippingAddress($order);
        $billingAddress = $this->orderAddress->getOrderBillingAddress($order);
        $itemsList = [];
        foreach ($order->getItems() as $item) {
            if (!$item->getParentItemId()) {
                $orderItemIds[] = (int)$item->getItemId();
            }
            $this->orderItemProvider->addOrderItemId((int)$item->getItemId());
        }
        foreach ($orderItemIds as $orderItemId) {
            $item = $this->orderItemProvider->getOrderItemById((int)$orderItemId);
            unset($item['associatedProduct']);
            unset($item['model']);
            $itemsList[] = [
                'itemname' => $item['product_name'],
                'itemSKU' => $item['product_sku'],
                'quantity' => $item['quantity_ordered'],
                'itemPrice' => $item['product_sale_price']['value']
            ];
        }
        $ip = $order->getXForwardedFor() ? ' (' . $order->getXForwardedFor() . ')' : '';
        $orderArray[] = [
            'incrementId' => $order->getIncrementId(),
            'totalAmount' => $order->getGrandTotal(),
            'currencyCode' => $order->getOrderCurrencyCode(),
            'customerInfo' =>[
            'firstName'=>$shippingAddress['firstname'],
            'lastName'=>$shippingAddress['lastname'],
            'email'=> $order->getCustomerEmail(),
            'phone'=>$shippingAddress['telephone'],
            'ipAddress'=>$order->getRemoteIp() . $ip
            ],
            'billingAddress' =>[
                'firstName'=> $billingAddress['firstname'],
                'lastName'=> $billingAddress['lastname'],
                'address1'=> implode(',', $billingAddress['street']),
                'city'=> $billingAddress['city'],
                'state'=> $billingAddress['region'],
                'zip'=> $billingAddress['postcode'],
                'country'=> $billingAddress['country_code'],
                'companyName'=> $billingAddress['company']
            ],
            'shippingAddress' =>[
                'firstName'=> $shippingAddress['firstname'],
                'lastName'=> $shippingAddress['lastname'],
                'address1'=> implode(',', $shippingAddress['street']),
                'city'=> $shippingAddress['city'],
                'state'=> $shippingAddress['region'],
                'zip'=> $shippingAddress['postcode'],
                'country'=> $shippingAddress['country_code'],
                'companyName'=> $shippingAddress['company']
            ],
            'itemDetails' => $itemsList
        ];
        return $orderArray;
    }
}
