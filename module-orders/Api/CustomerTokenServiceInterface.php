<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Api;

/**
 * Interface CustomerTokenServiceInterface
 *
 * @api
 */
interface CustomerTokenServiceInterface
{
    /**
     * Create access token for customer given customer details.
     *
     * @param string $email
     * @param string $fname
     * @param string $lname
     * @return string Token created
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createCustomerAccessToken($email, $fname = '', $lname = '');
}
