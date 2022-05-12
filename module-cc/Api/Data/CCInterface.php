<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\CC\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface CCInterface
 *
 * @api
 */
interface CCInterface extends ExtensibleDataInterface
{
    public const CC_ID                        = 'cc_id';
    public const INCREMENT_ID                 = 'increment_id';
    public const ORDER_ID                     = 'order_id';
    public const PAYMENT_PLAN_ITEM            = 'payment_plan_item';
    public const EPAYMENT_TYPE                = 'epayment_type';
    public const EPAYMENT                     = 'epayment';
    public const EPAYMENT_VALIDITY_STARTDATE  = 'epayment_validity_startdate';
    public const EPAYMENT_VALIDITY_ENDDATE    = 'epayment_validity_enddate';
    public const EPAYMENT_HOLDER_NAME         = 'epayment_holder_name';
    public const AUTHORIZED_AMOUNT            = 'authorized_amount';
    public const DIGITAL_PAYMENT_SERVICE      = 'digital_payment_service';
    public const AUTHORIZATION_ACQUIRER       = 'authorization_acquirer';
    public const AUTHORIZATION_CURRENCY       = 'authorization_currency';
    public const AUTHORIZATION_DATE           = 'authorization_date';
    public const AUTHORIZATION_TIME           = 'authorization_time';
    public const EPAYMENT_DIGITAL_SERVICE     = 'epayment_digital_service';
    public const PAYMENT_SERVICE_PROVIDER     = 'payment_service_provider';
    public const PAYMENT_SERVICE_PROVIDER_CURRENCY = 'payment_service_provider_currency';
    public const TRANSACTION_SERVICE_PROVIDER      = 'transaction_service_provider';
    public const MERCHANT_CLEARING_HOUSE      = 'merchant_clearing_house';
    public const MAX_AUTHORIZED_AMOUNT        = 'max_authorized_amount';
    public const ZZ_PGSTOKEN                  = 'zz_pgstoken';
    public const ZZ_LASTFOUR                  = 'zz_lastfour';
    public const ZZ_FIRSTSIX                  = 'zz_firstsix';
    public const ZZ_CCSIGN                    = 'zz_ccsign';
    
    /**
     * Get the Id.
     *
     * @return int
     */
    public function getId();
    
    /**
     * Set the id.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);
   
    /**
     * Get the IncrementId.
     *
     * @return string
     */
    public function getIncrementId();

    /**
     * Set the IncrementId.
     *
     * @param string $incrementId
     * @return $this
     */
    public function setIncrementId($incrementId);

    /**
     * Get the OrderId.
     *
     * @return string
     */
    public function getOrderId();

    /**
     * Set the OrderId.
     *
     * @param string $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * Get the PymentPlanItem.
     *
     * @return string
     */
    public function getPaymentPlanItem();

    /**
     * Set the PymentPlanItem.
     *
     * @param string $pymentPlanItem
     * @return $this
     */
    public function setPaymentPlanItem($pymentPlanItem);

    /**
     * Get the EpaymentType.
     *
     * @return string|null
     */
    public function getEpaymentType();

    /**
     * Set the EpaymentType.
     *
     * @param string $epaymentType
     * @return $this
     */
    public function setEpaymentType($epaymentType);

    /**
     * Get the Epayment.
     *
     * @return string|null
     */
    public function getEpayment();

    /**
     * Sets the Epayment.
     *
     * @param string $epayment
     * @return $this
     */
    public function setEpayment($epayment);

    /**
     * Retrieve EpaymentValidityStartdate date and time.
     *
     * @return string|null
     */
    public function getEpaymentValidityStartdate();

    /**
     * Set EpaymentValidityStartdate date and time.
     *
     * @param string $epaymentValidityStartdate
     * @return $this
     */
    public function setEpaymentValidityStartdate($epaymentValidityStartdate);

     /**
      * Retrieve EpaymentValidityEnddate date and time.
      *
      * @return string|null
      */
    public function getEpaymentValidityEnddate();

    /**
     * Set EpaymentValidityEnddate date and time.
     *
     * @param string $epaymentValidityEnddate
     * @return $this
     */
    public function setEpaymentValidityEnddate($epaymentValidityEnddate);

    /**
     * Get the EpaymentHolderName.
     *
     * @return string
     */
    public function getEpaymentHolderName();

    /**
     * Sets the EpaymentHolderName.
     *
     * @param string $epaymentHolderName
     * @return $this
     */
    public function setEpaymentHolderName($epaymentHolderName);

    /**
     * Get the AuthorizedAmount.
     *
     * @return string
     */
    public function getAuthorizedAmount();

    /**
     * Sets the AuthorizedAmount.
     *
     * @param string $authorizedAmount
     * @return $this
     */
    public function setAuthorizedAmount($authorizedAmount);

    /**
     * Get the DigitalPaymentService.
     *
     * @return string
     */
    public function getDigitalPaymentService();

    /**
     * Sets the DigitalPaymentService.
     *
     * @param string $digitalPaymentService
     * @return $this
     */
    public function setDigitalPaymentService($digitalPaymentService);

     /**
      * Get the AuthorizationAcquirer.
      *
      * @return string
      */
    public function getAuthorizationAcquirer();

    /**
     * Sets the AuthorizationAcquirer.
     *
     * @param string $authorizationAcquirer
     * @return $this
     */
    public function setAuthorizationAcquirer($authorizationAcquirer);

     /**
      * Get the AuthorizationCurrency.
      *
      * @return string
      */
    public function getAuthorizationCurrency();

    /**
     * Sets the AuthorizationCurrency.
     *
     * @param string $authorizationCurrency
     * @return $this
     */
    public function setAuthorizationCurrency($authorizationCurrency);

     /**
      * Get the AuthorizationDate.
      *
      * @return string|null
      */
    public function getAuthorizationDate();

    /**
     * Sets the AuthorizationDate.
     *
     * @param string $authorizationDate
     * @return $this
     */
    public function setAuthorizationDate($authorizationDate);

    /**
     * Get the AuthorizationTime.
     *
     * @return string|null
     */
    public function getAuthorizationTime();

    /**
     * Sets the AuthorizationTime.
     *
     * @param string $authorizationTime
     * @return $this
     */
    public function setAuthorizationTime($authorizationTime);

    /**
     * Get the EpaymentDigitalService.
     *
     * @return string
     */
    public function getEpaymentDigitalService();

    /**
     * Sets the EpaymentDigitalService.
     *
     * @param string $epaymentDigitalService
     * @return $this
     */
    public function setEpaymentDigitalService($epaymentDigitalService);

    /**
     * Get the PaymentServiceProvider.
     *
     * @return string
     */
    public function getPaymentServiceProvider();

    /**
     * Sets the PaymentServiceProvider.
     *
     * @param string $paymentServiceProvider
     * @return $this
     */
    public function setPaymentServiceProvider($paymentServiceProvider);

     /**
      * Get the PaymentServiceProviderCurrency.
      *
      * @return string
      */
    public function getPaymentServiceProviderCurrency();

    /**
     * Sets the PaymentServiceProvider.
     *
     * @param string $paymentServiceProviderCurrency
     * @return $this
     */
    public function setPaymentServiceProviderCurrency($paymentServiceProviderCurrency);

    /**
     * Get the TransactionServiceProvider.
     *
     * @return string
     */
    public function getTransactionServiceProvider();

    /**
     * Sets the TransactionServiceProvider.
     *
     * @param string $transactionServiceProvider
     * @return $this
     */
    public function setTransactionProvider($transactionServiceProvider);

    /**
     * Get the MerchantClearingHouse.
     *
     * @return string
     */
    public function getMerchantClearingHouse();

    /**
     * Sets the MerchantClearingHouse.
     *
     * @param string $merchantClearingHouse
     * @return $this
     */
    public function setMerchantClearingHouse($merchantClearingHouse);

    /**
     * Get the MaxAuthorizedAmount.
     *
     * @return string
     */
    public function getMaxAuthorizedAmount();

    /**
     * Sets the MaxAuthorizedAmount.
     *
     * @param string $maxAuthorizedAmount
     * @return $this
     */
    public function setMaxAuthorizedAmount($maxAuthorizedAmount);

     /**
      * Get the ZzPgstoken.
      *
      * @return string
      */
    public function getZzPgstoken();

    /**
     * Sets the ZzPgstoken.
     *
     * @param string $zzPgstoken
     * @return $this
     */
    public function setZzPgstoken($zzPgstoken);

    /**
     * Get the ZzLastfour.
     *
     * @return string
     */
    public function getZzLastfour();

    /**
     * Sets the ZzLastfour.
     *
     * @param string $zzLastfour
     * @return $this
     */
    public function setZzLastfour($zzLastfour);

    /**
     * Get the ZzFirstsix.
     *
     * @return string
     */
    public function getZzFirstsix();

    /**
     * Sets the ZzFirstsix.
     *
     * @param string $zzFirstsix
     * @return $this
     */
    public function setZzFirstsix($zzFirstsix);

    /**
     * Get the ZzCcsign.
     *
     * @return string
     */
    public function getZzCcsign();

    /**
     * Sets the ZzCcsign.
     *
     * @param string $zzCcsign
     * @return $this
     */
    public function setZzCcsign($zzCcsign);
}
