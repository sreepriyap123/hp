<?php
declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\CC\Model;
 
/**
 * Pay In Store payment method model
 */
class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod
{
   
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'hp_cc';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;
}
