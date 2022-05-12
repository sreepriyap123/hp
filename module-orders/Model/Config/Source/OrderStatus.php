<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

 namespace HP\Orders\Model\Config\Source;

/**
 * Order Statuses source model
 */
class OrderStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    private $orderConfig;

    /**
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     */
    public function __construct(\Magento\Sales\Model\Order\Config $orderConfig)
    {
        $this->orderConfig = $orderConfig;
    }

    /**
     * Return available Order statuses
     *
     * @return array
     */
    public function toOptionArray()
    {
        $statuses = $this->orderConfig->getStatuses();

        $options = [];
        foreach ($statuses as $code => $label) {
            $options[] = ['value' => $code, 'label' => $label];
        }
        return $options;
    }
}
