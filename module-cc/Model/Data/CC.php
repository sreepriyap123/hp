<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\CC\Model\Data;

use HP\CC\Api\Data\CCInterface;
use Magento\Framework\Model\AbstractModel;

class CC extends \HP\CC\Model\CC implements CCInterface
{

    /**
     * Get the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::CC_ID);
    }

    /**
     * Set the Id
     *
     * @param  int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::CC_ID, $id);
    }

     /**
      * Get the IncrementId.
      *
      * @return string
      */
    public function getIncrementId()
    {
        return $this->_getData(self::INCREMENT_ID);
    }

     /**
      * Set the IncrementId.
      *
      * @param string $incrementId
      * @return $this
      */
    public function setIncrementId($incrementId)
    {
        return $this->setData(self::INCREMENT_ID, $incrementId);
    }

     /**
      * Get the OrderId.
      *
      * @return string
      */
    public function getOrderId()
    {
        return $this->_getData(self::ORDER_ID);
    }

    /**
     * Set the OrderId.
     *
     * @param string $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get the PymentPlanItem.
     *
     * @return string
     */
    public function getPaymentPlanItem()
    {
        return $this->_getData(self::PAYMENT_PLAN_ITEM);
    }

     /**
      * Set the PymentPlanItem.
      *
      * @param string $pymentPlanItem
      * @return $this
      */
    public function setPaymentPlanItem($pymentPlanItem)
    {
        return $this->setData(self::PAYMENT_PLAN_ITEM, $pymentPlanItem);
    }

    /**
     * Get the EpaymentType.
     *
     * @return string|null
     */
    public function getEpaymentType()
    {
        return $this->_getData(self::EPAYMENT_TYPE);
    }

   /**
    * Set the EpaymentType.
    *
    * @param string $epaymentType
    * @return $this
    */
    public function setEpaymentType($epaymentType)
    {
        return $this->setData(self::EPAYMENT_TYPE, $epaymentType);
    }

     /**
      * Get the Epayment.
      *
      * @return string|null
      */
    public function getEpayment()
    {
        return $this->_getData(self::EPAYMENT);
    }

    /**
     * Sets the Epayment.
     *
     * @param string $epayment
     * @return $this
     */
    public function setEpayment($epayment)
    {
        return $this->setData(self::EPAYMENT, $epayment);
    }
    
    /**
     * Retrieve EpaymentValidityStartdate date and time.
     *
     * @return string|null
     */
    public function getEpaymentValidityStartdate()
    {
        return $this->_getData(self::EPAYMENT_VALIDITY_STARTDATE);
    }

    /**
     * Set EpaymentValidityStartdate date and time.
     *
     * @param string $epaymentValidityStartdate
     * @return $this
     */
    public function setEpaymentValidityStartdate($epaymentValidityStartdate)
    {
        return $this->setData(self::EPAYMENT_VALIDITY_STARTDATE, $epaymentValidityStartdate);
    }

    /**
     * Retrieve EpaymentValidityEnddate date and time.
     *
     * @return string|null
     */
    public function getEpaymentValidityEnddate()
    {
        return $this->_getData(self::EPAYMENT_VALIDITY_ENDDATE);
    }

    /**
     * Set EpaymentValidityEnddate date and time.
     *
     * @param string $epaymentValidityEnddate
     * @return $this
     */
    public function setEpaymentValidityEnddate($epaymentValidityEnddate)
    {
        return $this->setData(self::EPAYMENT_VALIDITY_ENDDATE, $epaymentValidityEnddate);
    }

    /**
     * Get the EpaymentHolderName.
     *
     * @return string
     */
    public function getEpaymentHolderName()
    {
        return $this->_getData(self::EPAYMENT_HOLDER_NAME);
    }

    /**
     * Sets the EpaymentHolderName.
     *
     * @param string $epaymentHolderName
     * @return $this
     */
    public function setEpaymentHolderName($epaymentHolderName)
    {
        return $this->setData(self::EPAYMENT_HOLDER_NAME, $epaymentHolderName);
    }

    /**
     * Get the AuthorizedAmount.
     *
     * @return string
     */
    public function getAuthorizedAmount()
    {
        return $this->_getData(self::AUTHORIZED_AMOUNT);
    }

    /**
     * Sets the AuthorizedAmount.
     *
     * @param string $authorizedAmount
     * @return $this
     */
    public function setAuthorizedAmount($authorizedAmount)
    {
        return $this->setData(self::AUTHORIZED_AMOUNT, $authorizedAmount);
    }

    /**
     * Get the DigitalPaymentService.
     *
     * @return string
     */
    public function getDigitalPaymentService()
    {
        return $this->_getData(self::DIGITAL_PAYMENT_SERVICE);
    }

    /**
     * Sets the DigitalPaymentService.
     *
     * @param string $digitalPaymentService
     * @return $this
     */
    public function setDigitalPaymentService($digitalPaymentService)
    {
        return $this->setData(self::DIGITAL_PAYMENT_SERVICE, $digitalPaymentService);
    }

    /**
     * Get the AuthorizationAcquirer.
     *
     * @return string
     */
    public function getAuthorizationAcquirer()
    {
        return $this->_getData(self::AUTHORIZATION_ACQUIRER);
    }

    /**
     * Sets the AuthorizationAcquirer.
     *
     * @param string $authorizationAcquirer
     * @return $this
     */
    public function setAuthorizationAcquirer($authorizationAcquirer)
    {
        return $this->setData(self::AUTHORIZATION_ACQUIRER, $authorizationAcquirer);
    }

     /**
      * Get the AuthorizationCurrency.
      *
      * @return string
      */
    public function getAuthorizationCurrency()
    {
        return $this->_getData(self::AUTHORIZATION_CURRENCY);
    }

    /**
     * Sets the AuthorizationCurrency.
     *
     * @param string $authorizationCurrency
     * @return $this
     */
    public function setAuthorizationCurrency($authorizationCurrency)
    {
        return $this->setData(self::AUTHORIZATION_CURRENCY, $authorizationCurrency);
    }

    /**
     * Get the AuthorizationDate.
     *
     * @return string|null
     */
    public function getAuthorizationDate()
    {
        return $this->_getData(self::AUTHORIZATION_DATE);
    }

    /**
     * Sets the AuthorizationDate.
     *
     * @param string $authorizationDate
     * @return $this
     */
    public function setAuthorizationDate($authorizationDate)
    {
        return $this->setData(self::AUTHORIZATION_DATE, $authorizationDate);
    }

    /**
     * Get the AuthorizationTime.
     *
     * @return string|null
     */
    public function getAuthorizationTime()
    {
        return $this->_getData(self::AUTHORIZATION_TIME);
    }

    /**
     * Sets the AuthorizationTime.
     *
     * @param string $authorizationTime
     * @return $this
     */
    public function setAuthorizationTime($authorizationTime)
    {
        return $this->setData(self::AUTHORIZATION_TIME, $authorizationTime);
    }

   /**
    * Get the EpaymentDigitalService.
    *
    * @return string
    */
    public function getEpaymentDigitalService()
    {
        return $this->_getData(self::EPAYMENT_DIGITAL_SERVICE);
    }

    /**
     * Sets the EpaymentDigitalService.
     *
     * @param string $epaymentDigitalService
     * @return $this
     */
    public function setEpaymentDigitalService($epaymentDigitalService)
    {
        return $this->setData(self::EPAYMENT_DIGITAL_SERVICE, $epaymentDigitalService);
    }

    /**
     * Get the PaymentServiceProvider.
     *
     * @return string
     */
    public function getPaymentServiceProvider()
    {
        return $this->_getData(self::PAYMENT_SERVICE_PROVIDER);
    }

    /**
     * Sets the PaymentServiceProvider.
     *
     * @param string $paymentServiceProvider
     * @return $this
     */
    public function setPaymentServiceProvider($paymentServiceProvider)
    {
        return $this->setData(self::PAYMENT_SERVICE_PROVIDER, $paymentServiceProvider);
    }

     /**
      * Get the PaymentServiceProviderCurrency.
      *
      * @return string
      */
    public function getPaymentServiceProviderCurrency()
    {
        return $this->_getData(self::PAYMENT_SERVICE_PROVIDER_CURRENCY);
    }

    /**
     * Sets the PaymentServiceProvider.
     *
     * @param string $paymentServiceProviderCurrency
     * @return $this
     */
    public function setPaymentServiceProviderCurrency($paymentServiceProviderCurrency)
    {
        return $this->setData(self::PAYMENT_SERVICE_PROVIDER_CURRENCY, $paymentServiceProviderCurrency);
    }

     /**
      * Get the TransactionServiceProvider.
      *
      * @return string
      */
    public function getTransactionServiceProvider()
    {
        return $this->_getData(self::TRANSACTION_SERVICE_PROVIDER);
    }

     /**
      * Sets the TransactionServiceProvider.
      *
      * @param string $transactionServiceProvider
      * @return $this
      */
    public function setTransactionProvider($transactionServiceProvider)
    {
        return $this->setData(self::TRANSACTION_SERVICE_PROVIDER, $transactionServiceProvider);
    }

    /**
     * Get the MerchantClearingHouse.
     *
     * @return string
     */
    public function getMerchantClearingHouse()
    {
        return $this->_getData(self::MERCHANT_CLEARING_HOUSE);
    }

    /**
     * Sets the MerchantClearingHouse.
     *
     * @param string $merchantClearingHouse
     * @return $this
     */
    public function setMerchantClearingHouse($merchantClearingHouse)
    {
        return $this->setData(self::MERCHANT_CLEARING_HOUSE, $merchantClearingHouse);
    }

    /**
     * Get the MaxAuthorizedAmount.
     *
     * @return string
     */
    public function getMaxAuthorizedAmount()
    {
        return $this->_getData(self::MAX_AUTHORIZED_AMOUNT);
    }

    /**
     * Sets the MaxAuthorizedAmount.
     *
     * @param string $maxAuthorizedAmount
     * @return $this
     */
    public function setMaxAuthorizedAmount($maxAuthorizedAmount)
    {
        return $this->setData(self::MAX_AUTHORIZED_AMOUNT, $maxAuthorizedAmount);
    }

     /**
      * Get the ZzPgstoken.
      *
      * @return string
      */
    public function getZzPgstoken()
    {
        return $this->_getData(self::ZZ_PGSTOKEN);
    }

    /**
     * Sets the ZzPgstoken.
     *
     * @param string $zzPgstoken
     * @return $this
     */
    public function setZzPgstoken($zzPgstoken)
    {
        return $this->setData(self::ZZ_PGSTOKEN, $zzPgstoken);
    }

     /**
      * Get the ZzLastfour.
      *
      * @return string
      */
    public function getZzLastfour()
    {
        return $this->_getData(self::ZZ_LASTFOUR);
    }

    /**
     * Sets the ZzLastfour.
     *
     * @param string $zzLastfour
     * @return $this
     */
    public function setZzLastfour($zzLastfour)
    {
        return $this->setData(self::ZZ_LASTFOUR, $zzLastfour);
    }

    /**
     * Get the ZzFirstsix.
     *
     * @return string
     */
    public function getZzFirstsix()
    {
        return $this->_getData(self::ZZ_FIRSTSIX);
    }

    /**
     * Sets the ZzFirstsix.
     *
     * @param string $zzFirstsix
     * @return $this
     */
    public function setZzFirstsix($zzFirstsix)
    {
        return $this->setData(self::ZZ_FIRSTSIX, $zzFirstsix);
    }

    /**
     * Get the ZzCcsign.
     *
     * @return string
     */
    public function getZzCcsign()
    {
        return $this->_getData(self::ZZ_CCSIGN);
    }

    /**
     * Sets the ZzCcsign.
     *
     * @param string $zzCcsign
     * @return $this
     */
    public function setZzCcsign($zzCcsign)
    {
        return $this->setData(self::ZZ_CCSIGN, $zzCcsign);
    }
}
