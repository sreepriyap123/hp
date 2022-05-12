<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Model\Data;

use Magento\Framework\Model\AbstractModel;
use HP\Orders\Model\ResourceModel\OrderDetails as ResourceModel;
use HP\Orders\Api\Data\OrderDetailsInterface;

/**
 * Class OrderDetails defines the model class
 */
class OrderDetails extends AbstractModel implements OrderDetailsInterface
{
    private const ID = 'id';
    private const ORDER_ID = 'order_id';
    private const NICKNAME = 'nickname';
    private const TITLE = 'title';
    private const DEPARTMENT = 'department';
    private const EXTENSION_NUMBER = 'extension_number';
    private const PAGER_NUMBER = 'pager_number';
    private const MOBILE_PHONE_NUMBER = 'mobile_phone_number';
    private const VERIFIED_FLAG= 'verified_flag';
    private const ACCEPTED_FLAG = 'accepted_flag';
    private const VALID_FLAG = 'valid_flag';
    private const RESIDENTIAL_FLAG = 'residential_flag';
    private const CUSTOMS_ID_EIN = 'customs_id_ein';
    private const REFERENCE_DESCRIPTION = 'reference_description';
    private const SERVICE_TYPE_CODE = 'service_type_code';
    private const PACKAGE_TYPE_CODE = 'package_type_code';
    private const COLLECTION_METHOD_CODE = 'collection_method_code';
    private const BILL_CODE = 'bill_code';
    private const BILL_ACCOUNT_NUMBER = 'bill_account_number';
    private const DUTY_BILL_CODE = 'duty_bill_code';
    private const DUTY_BILL_ACCOUNT_NUMBER = 'duty_bill_account_number';
    private const INSIGHT_ID_NUMBER = 'insight_id_number' ;
    private const GROUND_REFERENCE_DESCRIPTION = 'ground_reference_description';
    private const SHIPMENT_NOTIFICATION_RECIPIENT_EMAIL = 'shipment_notification_recipient_email';
    private const RECIPIENT_EMAIL_LANGUAGE = 'recipient_email_language';
    private const RECIPIENT_EMAIL_SHIPMENT_NOTIFICATION = 'recipient_email_shipment_notification';
    private const RECIPIENT_EMAIL_EXCEPTION_NOTIFICATION = 'recipient_email_exception_notification';
    private const RECIPIENT_EMAIL_DELIVERY_NOTIFICATION = 'recipient_email_delivery_notification';
    private const PARTNER_TYPE_CODES = 'partner_type_codes';
    private const NET_RETURN_BILL_ACCOUNT_NUMBER = 'net_return_bill_account_number';
    private const CUSTOMS_ID_TYPE_CODE = 'customs_id_type_code';
    private const ADDRESS_TYPE_CODE = 'address_type_code';
    private const SHIPMENT_NOTIFICATION_SENDER_EMAIL = 'shipment_notification_sender_email';
    private const SENDER_EMAIL_LANGUAGE ='sender_email_language';
    private const SENDER_EMAIL_SHIPMENT_NOTIFICATION = 'sender_email_shipment_notification';
    private const SENDER_EMAIL_EXCEPTION_NOTIFICATION = 'sender_email_exception_notification';
    private const SENDER_EMAIL_DELIVERY_NOTIFICATION = 'sender_email_delivery_notification';
    private const RECIPIENT_EMAIL_PICKUP_NOTIFICATION = 'recipient_email_pickup_notification';
    private const SENDER_EMAIL_PICKUP_NOTIFICATION = 'sender_email_pickup_notification';
    private const OP_CO_TYPE_CD = 'op_co_type_cd';
    private const BROKER_ACCOUNT_ID = 'broker_account_id';
    private const BROKER_TAX_ID = 'broker_tax_id';
    private const DEFAULT_BROKER_ID = 'default_broker_id';
    private const RECIPIENT_EMAIL_TENDERED_NOTIFICATION = 'recipient_email_tendered_notification ';
    private const SENDER_EMAIL_TENDERED_NOTIFICATION = 'sender_email_tendered_notification';
    private const USER_ACCOUNT_NUMBER = 'user_account_number';
    private const DELIVERY_INSTRUCTIONS = 'delivery_instructions';
    private const ESTIMATED_DELIVERY_FLAG = 'estimated_delivery_flag';
    private const SENDER_ESTIMATED_DELIVERY_FLAG = 'sender_estimated_delivery_flag';
    private const SHIPMENT_NOTIFICATION_SENDER_DELIVERY_CHANNEL = 'shipment_notification_sender_delivery_channel';
    private const SHIPMENT_NOTIFICATION_SENDER_MOBILENO = 'shipment_notification_sender_mobile_no';
    private const SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_COUNTRY = 'shipment_notification_sender_mobile_no_country';
    private const SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_LANGUAGE = 'shipment_notification_sender_mobile_no_language';

    /**
     * Order Details constructor
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Gets the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * Sets the Id
     *
     * @param  int $id
     * @return int
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Gets the OrderId
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->_getData(self::ORDER_ID);
    }

    /**
     * Sets the OrderId
     *
     * @param  int $orderId
     * @return int
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Gets the Nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->_getData(self::NICKNAME);
    }

    /**
     * Sets the Nickname
     *
     * @param  string $nickname
     * @return string
     */
    public function setNickname($nickname)
    {
        return $this->setData(self::NICKNAME, $nickname);
    }

    /**
     * Gets the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_getData(self::TITLE);
    }

    /**
     * Sets the title
     *
     * @param  string $title
     * @return string
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Gets the Department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->_getData(self::DEPARTMENT);
    }
    /**
     * Sets the Department
     *
     * @param  string $department
     * @return string
     */
    public function setDepartment($department)
    {
        return $this->setData(self::DEPARTMENT, $department);
    }
    /**
     * Gets the ExtensionNumber
     *
     * @return string
     */
    public function getExtensionNumber()
    {
        return $this->_getData(self::EXTENSION_NUMBER);
    }
    /**
     * Sets the ExtensionNumber
     *
     * @param  string $extensionNumber
     * @return string
     */
    public function setExtensionNumber($extensionNumber)
    {
        return $this->setData(self::EXTENSION_NUMBER, $extensionNumber);
    }

    /**
     * Gets the Pagernumber
     *
     * @return string
     */
    public function getPagerNumber()
    {
        return $this->_getData(self::PAGER_NUMBER);
    }
    /**
     * Sets the pagernumber
     *
     * @param  string $pagerNumber
     * @return string
     */
    public function setPagerNumber($pagerNumber)
    {
        return $this->setData(self::PAGER_NUMBER, $pagerNumber);
    }

    /**
     * Gets the mobilephone number
     *
     * @return string
     */
    public function getMobilePhoneNumber()
    {
        return $this->_getData(self::MOBILE_PHONE_NUMBER);
    }
    /**
     * Sets the mobilephone number
     *
     * @param  string $mobilePhoneNumber
     * @return string
     */
    public function setMobilePhoneNumber($mobilePhoneNumber)
    {
        return $this->setData(self::MOBILE_PHONE_NUMBER, $mobilePhoneNumber);
    }

    /**
     * Gets the verifiedFlag
     *
     * @return string
     */
    public function getVerifiedFlag()
    {
        return $this->_getData(self::VERIFIED_FLAG);
    }
    /**
     * Sets the verifiedFlag
     *
     * @param  string $verifiedFlag
     * @return string
     */
    public function setVerifiedFlag($verifiedFlag)
    {
        return $this->setData(self::VERIFIED_FLAG, $verifiedFlag);
    }

    /**
     * Gets the AcceptedFlag
     *
     * @return string
     */
    public function getAcceptedFlag()
    {
        return $this->_getData(self::ACCEPTED_FLAG);
    }
    /**
     * Sets the AcceptedFlag
     *
     * @param  string $acceptedFlag
     * @return string
     */
    public function setAcceptedFlag($acceptedFlag)
    {
        return $this->setData(self::ACCEPTED_FLAG, $acceptedFlag);
    }

    /**
     * Gets the ValidFlag.
     *
     * @api
     * @return string
     */
    public function getValidFlag()
    {
        return $this->_getData(self::VALID_FLAG);
    }
    /**
     * Sets the validFlag.
     *
     * @param  string $validFlag
     * @return string
     */
    public function setValidFlag($validFlag)
    {
        return $this->setData(self::VALID_FLAG, $validFlag);
    }

    /**
     * Gets the ResidentialFlag.
     *
     * @api
     * @return string
     */
    public function getResidentialFlag()
    {
        return $this->_getData(self::RESIDENTIAL_FLAG);
    }
    /**
     * Sets the Residential Flag
     *
     * @param  string $residentialFlag
     * @return string
     */
    public function setResidentialFlag($residentialFlag)
    {
        return $this->setData(self::RESIDENTIAL_FLAG, $residentialFlag);
    }
    /**
     * Gets the CustomsIdEin.
     *
     * @api
     * @return string
     */
    public function getCustomsIdEin()
    {
        return $this->_getData(self::CUSTOMS_ID_EIN);
    }
    /**
     * Sets the  CustomsIdEin
     *
     * @param  string $customsIdEin
     * @return string
     */
    public function setCustomsIdEin($customsIdEin)
    {
        return $this->setData(self::CUSTOMS_ID_EIN, $customsIdEin);
    }

    /**
     * Gets the Reference Description
     *
     * @return string
     */
    public function getReferenceDescription()
    {
        return $this->_getData(self::REFERENCE_DESCRIPTION);
    }
    /**
     * Sets the Reference Description
     *
     * @param  string $referenceDescription
     * @return string
     */
    public function setReferenceDescription($referenceDescription)
    {
        return $this->setData(self::REFERENCE_DESCRIPTION, $referenceDescription);
    }
    /**
     * Gets the serviceTypeCode.
     *
     * @api
     * @return string
     */
    public function getServiceTypeCode()
    {
        return $this->_getData(self::SERVICE_TYPE_CODE);
    }
    /**
     * Sets the serviceTypeCode.
     *
     * @param  string $serviceTypeCode
     * @return string
     */
    public function setServiceTypeCode($serviceTypeCode)
    {
        return $this->setData(self::SERVICE_TYPE_CODE, $serviceTypeCode);
    }

    /**
     * Gets the PackageTypeCode.
     *
     * @api
     * @return string
     */
    public function getPackageTypeCode()
    {
        return $this->_getData(self::PACKAGE_TYPE_CODE);
    }
    /**
     * Sets the packageTypeCode.
     *
     * @param  string $packageTypeCode
     * @return string
     */
    public function setPackageTypeCode($packageTypeCode)
    {
        return $this->setData(self::PACKAGE_TYPE_CODE, $packageTypeCode);
    }

    /**
     * Gets the collectionMethodCode.
     *
     * @api
     * @return string
     */
    public function getCollectionMethodCode()
    {
        return $this->_getData(self::COLLECTION_METHOD_CODE);
    }
    /**
     * Sets the collectionMethodCode.
     *
     * @param  string $collectionMethodCode
     * @return string
     */
    public function setCollectionMethodCode($collectionMethodCode)
    {
        return $this->setData(self::COLLECTION_METHOD_CODE, $collectionMethodCode);
    }

    /**
     * Gets the BillCode.
     *
     * @api
     * @return string
     */
    public function getBillCode()
    {
        return $this->_getData(self::BILL_CODE);
    }
    /**
     * Sets the BillCode.
     *
     * @param  string $billCode
     * @return string
     */
    public function setBillCode($billCode)
    {
        return $this->setData(self::BILL_CODE, $billCode);
    }

    /**
     * Gets the BillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getBillAccountNumber()
    {
        return $this->_getData(self::BILL_ACCOUNT_NUMBER);
    }
    /**
     * Sets the BillAccountNumber.
     *
     * @param  string $billAccountNumber
     * @return string
     */
    public function setBillAccountNumber($billAccountNumber)
    {
        return $this->setData(self::BILL_ACCOUNT_NUMBER, $billAccountNumber);
    }

    /**
     * Gets the DutyBillCode.
     *
     * @api
     * @return string
     */
    public function getDutyBillCode()
    {
        return $this->_getData(self::DUTY_BILL_CODE);
    }
    /**
     * Sets the DutyBillCode.
     *
     * @param  string $dutyBillCode
     * @return string
     */
    public function setDutyBillCode($dutyBillCode)
    {
        return $this->setData(self::DUTY_BILL_CODE, $dutyBillCode);
    }

    /**
     * Gets the DutyBillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getDutyBillAccountNumber()
    {
        return $this->_getData(self::DUTY_BILL_ACCOUNT_NUMBER);
    }
    /**
     * Sets the DutyBillAccountNumber.
     *
     * @param  string $dutyBillAccountNumber
     * @return string
     */
    public function setDutyBillAccountNumber($dutyBillAccountNumber)
    {
        return $this->setData(self::DUTY_BILL_ACCOUNT_NUMBER, $dutyBillAccountNumber);
    }

    /**
     * Gets the InsightIdNumber.
     *
     * @api
     * @return string
     */
    public function getInsightIdNumber()
    {
        return $this->_getData(self::INSIGHT_ID_NUMBER);
    }
    /**
     * Sets the InsightIdNumber.
     *
     * @param  string $insightIdNumber
     * @return string
     */
    public function setInsightIdNumber($insightIdNumber)
    {
        return $this->setData(self::INSIGHT_ID_NUMBER, $insightIdNumber);
    }

    /**
     * Gets the GroundReferenceDescription.
     *
     * @api
     * @return string
     */
    public function getGroundReferenceDescription()
    {
        return $this->_getData(self::GROUND_REFERENCE_DESCRIPTION);
    }
    /**
     * Sets the GroundReferenceDescription.
     *
     * @param  string $groundReferenceDescription
     * @return string
     */
    public function setGroundReferenceDescription($groundReferenceDescription)
    {
        return $this->setData(self::GROUND_REFERENCE_DESCRIPTION, $groundReferenceDescription);
    }

    /**
     * Gets the ShipmentNotificationRecipientEmail.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationRecipientEmail()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_RECIPIENT_EMAIL);
    }
    /**
     * Sets the ShipmentNotificationRecipientEmail.
     *
     * @param  string $shipmentNotificationRecipientEmail
     * @return string
     */
    public function setShipmentNotificationRecipientEmail($shipmentNotificationRecipientEmail)
    {
        return $this->setData(self::SHIPMENT_NOTIFICATION_RECIPIENT_EMAIL, $shipmentNotificationRecipientEmail);
    }

    /**
     * Gets the RecipientEmailLanguage.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailLanguage()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_LANGUAGE);
    }
    /**
     * Sets the RecipientEmailLanguage.
     *
     * @param  string $recipientEmailLanguage
     * @return string
     */
    public function setRecipientEmailLanguage($recipientEmailLanguage)
    {
        return $this->setData(self::RECIPIENT_EMAIL_LANGUAGE, $recipientEmailLanguage);
    }

    /**
     * Gets the RecipientEmailShipmentNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailShipmentNotification()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_SHIPMENT_NOTIFICATION);
    }
    /**
     * Sets the RecipientEmailShipmentNotification.
     *
     * @param  string $recipientEmailShipmentNotification
     * @return string
     */
    public function setRecipientEmailShipmentNotification($recipientEmailShipmentNotification)
    {
        return $this->setData(self::RECIPIENT_EMAIL_SHIPMENT_NOTIFICATION, $recipientEmailShipmentNotification);
    }

    /**
     * Gets the RecipientEmailExceptionNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailExceptionNotification()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_EXCEPTION_NOTIFICATION);
    }
    /**
     * Sets the RecipientEmailExceptionNotification.
     *
     * @param  string $recipientEmailExceptionNotification
     * @return string
     */
    public function setRecipientEmailExceptionNotification($recipientEmailExceptionNotification)
    {
        return $this->setData(self::RECIPIENT_EMAIL_EXCEPTION_NOTIFICATION, $recipientEmailExceptionNotification);
    }

    /**
     * Gets the RecipientEmailDeliveryNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailDeliveryNotification()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_DELIVERY_NOTIFICATION);
    }
    /**
     * Sets the RecipientEmailDeliveryNotification.
     *
     * @param  string $recipientEmailDeliveryNotification
     * @return string
     */
    public function setRecipientEmailDeliveryNotification($recipientEmailDeliveryNotification)
    {
        return $this->setData(self::RECIPIENT_EMAIL_DELIVERY_NOTIFICATION, $recipientEmailDeliveryNotification);
    }

    /**
     * Gets the PartnerTypeCodes.
     *
     * @api
     * @return string
     */
    public function getPartnerTypeCodes()
    {
        return $this->_getData(self::PARTNER_TYPE_CODES);
    }
    /**
     * Sets the PartnerTypeCodes.
     *
     * @param  string $partnerTypeCodes
     * @return string
     */
    public function setPartnerTypeCodes($partnerTypeCodes)
    {
        return $this->setData(self::PARTNER_TYPE_CODES, $partnerTypeCodes);
    }

    /**
     * Gets the NetReturnBillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getNetReturnBillAccountNumber()
    {
        return $this->_getData(self::NET_RETURN_BILL_ACCOUNT_NUMBER);
    }
    /**
     * Sets the NetReturnBillAccountNumber.
     *
     * @param  string $netReturnBillAccountNumber
     * @return string
     */
    public function setNetReturnBillAccountNumber($netReturnBillAccountNumber)
    {
        return $this->setData(self::NET_RETURN_BILL_ACCOUNT_NUMBER, $netReturnBillAccountNumber);
    }

    /**
     * Gets the CustomsIdTypeCode.
     *
     * @api
     * @return string
     */
    public function getCustomsIdTypeCode()
    {
        return $this->_getData(self::CUSTOMS_ID_TYPE_CODE);
    }
    /**
     * Sets the CustomsIdTypeCode.
     *
     * @param  string $customsIdTypeCode
     * @return string
     */
    public function setCustomsIdTypeCode($customsIdTypeCode)
    {
        return $this->setData(self::CUSTOMS_ID_TYPE_CODE, $customsIdTypeCode);
    }

    /**
     * Gets the AddressTypeCode.
     *
     * @api
     * @return string
     */
    public function getAddressTypeCode()
    {
        return $this->_getData(self::ADDRESS_TYPE_CODE);
    }
    /**
     * Sets the AddressTypeCode.
     *
     * @param  string $addressTypeCode
     * @return string
     */
    public function setAddressTypeCode($addressTypeCode)
    {
        return $this->setData(self::ADDRESS_TYPE_CODE, $addressTypeCode);
    }

    /**
     * Gets the ShipmentNotificationSenderEmail.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderEmail()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_SENDER_EMAIL);
    }
    /**
     * Sets the ShipmentNotificationSenderEmail.
     *
     * @param  string $shipmentNotificationSenderEmail
     * @return string
     */
    public function setShipmentNotificationSenderEmail($shipmentNotificationSenderEmail)
    {
        return $this->setData(self::SHIPMENT_NOTIFICATION_SENDER_EMAIL, $shipmentNotificationSenderEmail);
    }

    /**
     * Gets the SenderEmailLanguage.
     *
     * @api
     * @return string
     */
    public function getSenderEmailLanguage()
    {
        return $this->_getData(self::SENDER_EMAIL_LANGUAGE);
    }
    /**
     * Sets the SenderEmailLanguage.
     *
     * @param  string $senderEmailLanguage
     * @return string
     */
    public function setSenderEmailLanguage($senderEmailLanguage)
    {
        return $this->setData(self::SENDER_EMAIL_LANGUAGE, $senderEmailLanguage);
    }

    /**
     * Gets the senderEmailShipmentNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailShipmentNotification()
    {
        return $this->_getData(self::SENDER_EMAIL_SHIPMENT_NOTIFICATION);
    }
    /**
     * Sets the senderEmailShipmentNotification.
     *
     * @param  string $senderEmailShipmentNotification
     * @return string
     */
    public function setSenderEmailShipmentNotification($senderEmailShipmentNotification)
    {
        return $this->setData(self::SENDER_EMAIL_SHIPMENT_NOTIFICATION, $senderEmailShipmentNotification);
    }

    /**
     * Gets the SenderEmailExceptionNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailExceptionNotification()
    {
        return $this->_getData(self::SENDER_EMAIL_EXCEPTION_NOTIFICATION);
    }
    /**
     * Sets the SenderEmailExceptionNotification.
     *
     * @param  string $senderEmailExceptionNotification
     * @return string
     */
    public function setSenderEmailExceptionNotification($senderEmailExceptionNotification)
    {
        return $this->setData(self::SENDER_EMAIL_EXCEPTION_NOTIFICATION, $senderEmailExceptionNotification);
    }

    /**
     * Gets the SenderEmailDeliveryNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailDeliveryNotification()
    {
        return $this->_getData(self::SENDER_EMAIL_DELIVERY_NOTIFICATION);
    }
    /**
     * Sets the SenderEmailDeliveryNotification.
     *
     * @param  string $senderEmailDeliveryNotification
     * @return string
     */
    public function setSenderEmailDeliveryNotification($senderEmailDeliveryNotification)
    {
        return $this->setData(self::SENDER_EMAIL_DELIVERY_NOTIFICATION, $senderEmailDeliveryNotification);
    }

    /**
     * Gets the RecipientEmailPickupNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailPickupNotification()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_PICKUP_NOTIFICATION);
    }
    /**
     * Sets the RecipientEmailPickupNotification.
     *
     * @param  string $recipientEmailPickupNotification
     * @return string
     */
    public function setRecipientEmailPickupNotification($recipientEmailPickupNotification)
    {
        return $this->setData(self::RECIPIENT_EMAIL_PICKUP_NOTIFICATION, $recipientEmailPickupNotification);
    }

    /**
     * Gets the SenderEmailPickupNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailPickupNotification()
    {
        return $this->_getData(self::SENDER_EMAIL_PICKUP_NOTIFICATION);
    }
    /**
     * Sets the SenderEmailPickupNotification.
     *
     * @param  string $senderEmailPickupNotification
     * @return string
     */
    public function setSenderEmailPickupNotification($senderEmailPickupNotification)
    {
        return $this->setData(self::SENDER_EMAIL_PICKUP_NOTIFICATION, $senderEmailPickupNotification);
    }

    /**
     * Gets the OpCoTypeCd.
     *
     * @api
     * @return string
     */
    public function getOpCoTypeCd()
    {
        return $this->_getData(self::OP_CO_TYPE_CD);
    }
    /**
     * Sets the OpCoTypeCd.
     *
     * @param  string $opCoTypeCd
     * @return string
     */
    public function setOpCoTypeCd($opCoTypeCd)
    {
        return $this->setData(self::OP_CO_TYPE_CD, $opCoTypeCd);
    }

    /**
     * Gets the BrokerAccountId.
     *
     * @api
     * @return string
     */
    public function getBrokerAccountId()
    {
        return $this->_getData(self::BROKER_ACCOUNT_ID);
    }
    /**
     * Sets the BrokerAccountId.
     *
     * @param  string $brokerAccountId
     * @return string
     */
    public function setBrokerAccountId($brokerAccountId)
    {
        return $this->setData(self::BROKER_ACCOUNT_ID, $brokerAccountId);
    }

    /**
     * Gets the BrokerTaxId.
     *
     * @api
     * @return string
     */
    public function getBrokerTaxId()
    {
        return $this->_getData(self::BROKER_TAX_ID);
    }
    /**
     * Sets the BrokerTaxId.
     *
     * @param  string $brokerTaxId
     * @return string
     */
    public function setBrokerTaxId($brokerTaxId)
    {
        return $this->setData(self::BROKER_TAX_ID, $brokerTaxId);
    }

    /**
     * Gets the DefaultBrokerId.
     *
     * @api
     * @return string
     */
    public function getDefaultBrokerId()
    {
        return $this->_getData(self::DEFAULT_BROKER_ID);
    }
    /**
     * Sets the DefaultBrokerId.
     *
     * @param  string $defaultBrokerId
     * @return string
     */
    public function setDefaultBrokerId($defaultBrokerId)
    {
        return $this->setData(self::DEFAULT_BROKER_ID, $defaultBrokerId);
    }

    /**
     * Gets the RecipientEmailTenderedNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailTenderedNotification()
    {
        return $this->_getData(self::RECIPIENT_EMAIL_TENDERED_NOTIFICATION);
    }
    /**
     * Sets the RecipientEmailTenderedNotification.
     *
     * @param  string $recipientEmailTenderedNotification
     * @return string
     */
    public function setRecipientEmailTenderedNotification($recipientEmailTenderedNotification)
    {
        return $this->setData(self::RECIPIENT_EMAIL_TENDERED_NOTIFICATION, $recipientEmailTenderedNotification);
    }

    /**
     * Gets the SenderEmailTenderedNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailTenderedNotification()
    {
        return $this->_getData(self::SENDER_EMAIL_TENDERED_NOTIFICATION);
    }
    /**
     * Sets the SenderEmailTenderedNotification.
     *
     * @param  string $senderEmailTenderedNotification
     * @return string
     */
    public function setSenderEmailTenderedNotification($senderEmailTenderedNotification)
    {
        return $this->setData(self::SENDER_EMAIL_TENDERED_NOTIFICATION, $senderEmailTenderedNotification);
    }

    /**
     * Gets the user account number
     *
     * @api
     * @return string
     */
    public function getUserAccountNumber()
    {
        return $this->_getData(self::USER_ACCOUNT_NUMBER);
    }
    /**
     * Sets the user account number
     *
     * @param  string $userAccountNumber
     * @return string
     */
    public function setUserAccountNumber($userAccountNumber)
    {
        return $this->setData(self::USER_ACCOUNT_NUMBER, $userAccountNumber);
    }

    /**
     * Gets the DeliveryInstructions.
     *
     * @api
     * @return string
     */
    public function getDeliveryInstructions()
    {
        return $this->_getData(self::DELIVERY_INSTRUCTIONS);
    }
    /**
     * Sets the DeliveryInstructions.
     *
     * @param  string $deliveryInstructions
     * @return string
     */
    public function setDeliveryInstructions($deliveryInstructions)
    {
        return $this->setData(self::DELIVERY_INSTRUCTIONS, $deliveryInstructions);
    }

    /**
     * Gets the EstimatedDeliveryFlag.
     *
     * @api
     * @return string
     */
    public function getEstimatedDeliveryFlag()
    {
        return $this->_getData(self::ESTIMATED_DELIVERY_FLAG);
    }
    /**
     * Sets the EstimatedDeliveryFlag.
     *
     * @param  string $estimatedDeliveryFlag
     * @return string
     */
    public function setEstimatedDeliveryFlag($estimatedDeliveryFlag)
    {
        return $this->setData(self::ESTIMATED_DELIVERY_FLAG, $estimatedDeliveryFlag);
    }

    /**
     * Gets the SenderEstimatedDeliveryFlag.
     *
     * @api
     * @return string
     */
    public function getSenderEstimatedDeliveryFlag()
    {
        return $this->_getData(self::SENDER_ESTIMATED_DELIVERY_FLAG);
    }
    /**
     * Sets the SenderEstimatedDeliveryFlag.
     *
     * @param  string $senderEstimatedDeliveryFlag
     * @return string
     */
    public function setSenderEstimatedDeliveryFlag($senderEstimatedDeliveryFlag)
    {
        return $this->setData(self::SENDER_ESTIMATED_DELIVERY_FLAG, $senderEstimatedDeliveryFlag);
    }

    /**
     * Gets the ShipmentNotificationSenderDeliveryChannel.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderDeliveryChannel()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_SENDER_DELIVERY_CHANNEL);
    }
    /**
     * Sets the ShipmentNotificationSenderDeliveryChannel.
     *
     * @param  string $shipmentNotificationSenderDeliveryChannel
     * @return string
     */

    public function setShipmentNotificationSenderDeliveryChannel($shipmentNotificationSenderDeliveryChannel)
    {
        return $this->setData(
            self::SHIPMENT_NOTIFICATION_SENDER_DELIVERY_CHANNEL,
            $shipmentNotificationSenderDeliveryChannel
        );
    }
    /**
     * Gets the ShipmentNotificationSenderMobileNo.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNo()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_SENDER_MOBILENO);
    }
    /**
     * Sets the ShipmentNotificationSenderMobileNo.
     *
     * @param  string $shipmentNotificationSenderMobileNo
     * @return string
     */
    public function setShipmentNotificationSenderMobileNo($shipmentNotificationSenderMobileNo)
    {
        return $this->setData(self::SHIPMENT_NOTIFICATION_SENDER_MOBILENO, $shipmentNotificationSenderMobileNo);
    }

    /**
     * Gets the ShipmentNotificationSenderMobileNoCountry.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNoCountry()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_COUNTRY);
    }
    /**
     * Sets the ShipmentNotificationSenderMobileNoCountry.
     *
     * @param  string $shipmentNotificationSenderMobileNoCountry
     * @return string
     */
    public function setShipmentNotificationSenderMobileNoCountry($shipmentNotificationSenderMobileNoCountry)
    {
        return $this->setData(
            self::SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_COUNTRY,
            $shipmentNotificationSenderMobileNoCountry
        );
    }
    /**
     * Gets the ShipmentNotificationSenderMobileNoLanguage.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNoLanguage()
    {
        return $this->_getData(self::SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_LANGUAGE);
    }
    /**
     * Sets the ShipmentNotificationSenderMobileNoLanguage.
     *
     * @param  string $shipmentNotificationSenderMobileNoLanguage
     * @return string
     */
    public function setShipmentNotificationSenderMobileNoLanguage($shipmentNotificationSenderMobileNoLanguage)
    {
        return $this->setData(
            self::SHIPMENT_NOTIFICATION_SENDER_MOBILE_NO_LANGUAGE,
            $shipmentNotificationSenderMobileNoLanguage
        );
    }
}
