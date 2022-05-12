<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
 */
namespace HP\Orders\ViewModel;

use Magento\Sales\Model\OrderFactory;

class AdditionalInfo implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     *
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     *
     * @var OrderRespository
     */
    private $orderRepository;
   
    /**
     * @param OrderFactory $orderFactory
     * @param LoggerInterface $logger
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderFactory $orderFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->orderFactory = $orderFactory;
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
    }

    /**
     * Return the Diagnosis Result
     *
     * @param string $incrementId
     * @return string
     */
    public function getDiagnosisResult($incrementId)
    {
        $order = $this->orderFactory->create()->loadByIncrementId($incrementId);
        return $order->getDiagnosisResult();
    }
}
