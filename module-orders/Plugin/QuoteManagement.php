<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
*/

namespace HP\Orders\Plugin;

use Magento\Quote\Model\QuoteManagement as Subject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Quote\Api\Data\PaymentInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Sales\Api\Data\OrderInterface;

class QuoteManagement
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var CollectionFactory
     */
    private $orderCollectionFactory;

    /**
     * @var CartRepositoryInterface
     */
    private $quoteRepository;

    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param CollectionFactory $orderCollectionFactory
     * @param CartRepositoryInterface $quoteRepository
     * @param OrderInterface $order
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CollectionFactory $orderCollectionFactory,
        CartRepositoryInterface $quoteRepository,
        OrderInterface $order
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->quoteRepository = $quoteRepository;
        $this->order = $order;
    }
    
    /**
     * @inheritdoc
     */
    public function beforePlaceOrder(Subject $subject, $cartId, PaymentInterface $paymentMethod = null)
    {
        $restrictCart = $this->scopeConfig->getValue(
            'checkout/hp_restrictions/enable_cartrestrictions',
            ScopeInterface::SCOPE_STORE
        );
        if ($restrictCart) {
            $quote = $this->quoteRepository->getActive($cartId);
            if ($quote->getItemsCount()>1) {
                throw new LocalizedException(
                    __("Only 1 product is allowed to Purchase at a time.")
                );
            }
        }
        $enable = $this->scopeConfig->getValue(
            'checkout/hp_restrictions/enable_orderrestrictions',
            ScopeInterface::SCOPE_STORE
        );

        if ($enable) {
            $quote = $this->quoteRepository->getActive($cartId);
            $customerId = $quote->getCustomerId();
            if ($customerId) {
                $status = $this->scopeConfig->getValue(
                    'checkout/hp_restrictions/order_allowedsstatus',
                    ScopeInterface::SCOPE_STORE
                );
                if (! $status) {
                    $status = "pending,denied";
                }
                $collection = $this->orderCollectionFactory->create()
                            ->addFieldToSelect('entity_id')
                            ->addFieldToFilter('customer_id', ['eq' => $customerId])
                            ->addFieldToFilter('status', ['nin' => explode(",", $status)]);
                if ($collection ->getSize()) {
                    $errorMessage = $this->scopeConfig->getValue(
                        'checkout/hp_restrictions/orderrestriction_message',
                        ScopeInterface::SCOPE_STORE
                    );
                    if (! $errorMessage) {
                        $errorMessage = "You can't place new Order";
                    }
                    throw new LocalizedException(
                        __($errorMessage)
                    );
                }
            }
        }
        return [$cartId, $paymentMethod];
    }

    /**
     * @inheritdoc
     */
    public function afterPlaceOrder(Subject $subject, $result)
    {
        if ($result) {
            $order = $this->order->load($result);
            if (!$order->getEntityId()) {
                throw new NoSuchEntityException(
                    __("The order that was requested doesn't exist. Verify the order and try again.")
                );
            }
            $items = $order->getAllVisibleItems();
            $diagnosisResult = '';
            foreach ($items as $item) {
                $options = $item->getProductOptions();
                if (isset($options['options']) && !empty($options['options'])) {
                    foreach ($options['options'] as $option) {
                        if ($option['label'] == 'Pain Relief') {
                            $diagnosisResult = $option['value'];
                        }
                    }
                }
            }
            if ($diagnosisResult) {
                $order->setDiagnosisResult($diagnosisResult);
                $this->order->save($order);
            }
        }
        return $result;
    }
}
