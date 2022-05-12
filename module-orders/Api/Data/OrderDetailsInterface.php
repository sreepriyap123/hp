<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface OrderDetailsInterface
 *
 * @api
 */
interface OrderDetailsInterface extends ExtensibleDataInterface
{
    /**
     * Gets the Id.
     *
     * @api
     * @return int
     */
    public function getId();
    /**
     * Sets the id.
     *
     * @param  int $id
     * @return int
     */
    public function setId($id);
    /**
     * Gets the orderId.
     *
     * @api
     * @return int
     */
    public function getOrderId();
    /**
     * Sets the order id.
     *
     * @param  int $orderId
     * @return int
     */
    public function setOrderId($orderId);
    /**
     * Gets the nickname.
     *
     * @api
     * @return string
     */
    public function getNickname();
    /**
     * Sets the nickanme.
     *
     * @param  text $nickname
     * @return string
     */
    public function setNickname($nickname);
    /**
     * Gets the title.
     *
     * @api
     * @return string
     */
    public function getTitle();
    /**
     * Sets the title.
     *
     * @param  string $title
     * @return string
     */
    public function setTitle($title);
    /**
     * Gets the Department.
     *
     * @api
     * @return string
     */
    public function getDepartment();
    /**
     * Sets the Department.
     *
     * @param  string $department
     * @return string
     */
    public function setDepartment($department);
    /**
     * Gets the ExtensionNumber.
     *
     * @api
     * @return string
     */
    public function getExtensionNumber();
    /**
     * Sets the ExtensionNumber.
     *
     * @param  string $extensionNumber
     * @return string
     */
    public function setExtensionNumber($extensionNumber);

    /**
     * Gets the PagerNumber.
     *
     * @api
     * @return string
     */
    public function getPagerNumber();
    /**
     * Sets the PagerNumber.
     *
     * @param  string $pagerNumber
     * @return string
     */
    public function setPagerNumber($pagerNumber);

    /**
     * Gets the MobilePhoneNumber.
     *
     * @api
     * @return string
     */
    public function getMobilePhoneNumber();
    /**
     * Sets the MobilePhoneNumber.
     *
     * @param  string $mobilePhoneNumber
     * @return string
     */
    public function setMobilePhoneNumber($mobilePhoneNumber);

    /**
     * Gets the VerifiedFlag.
     *
     * @api
     * @return string
     */
    public function getVerifiedFlag();
    /**
     * Sets the VerifiedFlag.
     *
     * @param  string $verifiedFlag
     * @return string
     */
    public function setVerifiedFlag($verifiedFlag);

    /**
     * Gets the AcceptedFlag.
     *
     * @api
     * @return string
     */
    public function getAcceptedFlag();
    /**
     * Sets the AcceptedFlag.
     *
     * @param  string $acceptedFlag
     * @return string
     */
    public function setAcceptedFlag($acceptedFlag);

    /**
     * Gets the ValidFlag.
     *
     * @api
     * @return string
     */
    public function getValidFlag();
    /**
     * Sets the ValidFlag.
     *
     * @param  string $validFlag
     * @return string
     */
    public function setValidFlag($validFlag);

    /**
     * Gets the ResidentialFlag.
     *
     * @api
     * @return string
     */
    public function getResidentialFlag();
    /**
     * Sets the ResidentialFlag.
     *
     * @param  string $ResidentialFlag
     * @return string
     */
    public function setResidentialFlag($ResidentialFlag);

    /**
     * Gets the CustomsIdEin.
     *
     * @api
     * @return string
     */
    public function getCustomsIdEin();
    /**
     * Sets the CustomsIdEin.
     *
     * @param  string $customsIdEin
     * @return string
     */
    public function setCustomsIdEin($customsIdEin);

    /**
     * Gets the ReferenceDescription.
     *
     * @api
     * @return string
     */
    public function getReferenceDescription();
    /**
     * Sets the ReferenceDescription.
     *
     * @param  string $referenceDescription
     * @return string
     */
    public function setReferenceDescription($referenceDescription);
    /**
     * Gets the serviceTypeCode.
     *
     * @api
     * @return string
     */
    public function getServiceTypeCode();
    /**
     * Sets the serviceTypeCode.
     *
     * @param  string $serviceTypeCode
     * @return string
     */
    public function setServiceTypeCode($serviceTypeCode);
    /**
     * Gets the PackageTypeCode.
     *
     * @api
     * @return string
     */
    public function getPackageTypeCode();
    /**
     * Sets the PackageTypeCode.
     *
     * @param  string $packageTypeCode
     * @return string
     */
    public function setPackageTypeCode($packageTypeCode);
    /**
     * Gets the collectionMethodCode.
     *
     * @api
     * @return string
     */
    public function getCollectionMethodCode();
    /**
     * Sets the collectionMethodCode.
     *
     * @param  string $collectionMethodCode
     * @return string
     */
    public function setCollectionMethodCode($collectionMethodCode);

    /**
     * Gets the BillCode.
     *
     * @api
     * @return string
     */
    public function getBillCode();
    /**
     * Sets the BillCode.
     *
     * @param  string $billCode
     * @return string
     */
    public function setBillCode($billCode);

    /**
     * Gets the BillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getBillAccountNumber();
    /**
     * Sets the BillAccountNumber.
     *
     * @param  string $billAccountNumber
     * @return string
     */
    public function setBillAccountNumber($billAccountNumber);

    /**
     * Gets the DutyBillCode.
     *
     * @api
     * @return string
     */
    public function getDutyBillCode();
    /**
     * Sets the DutyBillCode.
     *
     * @param  string $dutyBillCode
     * @return string
     */
    public function setDutyBillCode($dutyBillCode);

    /**
     * Gets the DutyBillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getDutyBillAccountNumber();
    /**
     * Sets the DutyBillAccountNumber.
     *
     * @param  string $dutyBillAccountNumber
     * @return string
     */
    public function setDutyBillAccountNumber($dutyBillAccountNumber);
    /**
     * Gets the InsightIdNumber.
     *
     * @api
     * @return string
     */
    public function getInsightIdNumber();
    /**
     * Sets the InsightIdNumber.
     *
     * @param  string $insightIdNumber
     * @return string
     */
    public function setInsightIdNumber($insightIdNumber);

    /**
     * Gets the GroundReferenceDescription.
     *
     * @api
     * @return string
     */
    public function getGroundReferenceDescription();
    /**
     * Sets the GroundReferenceDescription.
     *
     * @param  string $groundReferenceDescription
     * @return string
     */
    public function setGroundReferenceDescription($groundReferenceDescription);

    /**
     * Gets the ShipmentNotificationRecipientEmail.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationRecipientEmail();
    /**
     * Sets the ShipmentNotificationRecipientEmail.
     *
     * @param  string $shipmentNotificationRecipientEmail
     * @return string
     */
    public function setShipmentNotificationRecipientEmail($shipmentNotificationRecipientEmail);

    /**
     * Gets the RecipientEmailLanguage.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailLanguage();
    /**
     * Sets the RecipientEmailLanguage.
     *
     * @param  string $recipientEmailLanguage
     * @return string
     */
    public function setRecipientEmailLanguage($recipientEmailLanguage);

    /**
     * Gets the RecipientEmailShipmentNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailShipmentNotification();
    /**
     * Sets the RecipientEmailShipmentNotification.
     *
     * @param  string $recipientEmailShipmentNotification
     * @return string
     */
    public function setRecipientEmailShipmentNotification($recipientEmailShipmentNotification);

    /**
     * Gets the RecipientEmailExceptionNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailExceptionNotification();
    /**
     * Sets the RecipientEmailExceptionNotification.
     *
     * @param  string $recipientEmailExceptionNotification
     * @return string
     */
    public function setRecipientEmailExceptionNotification($recipientEmailExceptionNotification);

    /**
     * Gets the RecipientEmailDeliveryNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailDeliveryNotification();
    /**
     * Sets the RecipientEmailDeliveryNotification.
     *
     * @param  string $recipientEmailDeliveryNotification
     * @return string
     */
    public function setRecipientEmailDeliveryNotification($recipientEmailDeliveryNotification);

    /**
     * Gets the PartnerTypeCodes.
     *
     * @api
     * @return string
     */
    public function getPartnerTypeCodes();
    /**
     * Sets the PartnerTypeCodes.
     *
     * @param  string $partnerTypeCodes
     * @return string
     */
    public function setPartnerTypeCodes($partnerTypeCodes);

    /**
     * Gets the NetReturnBillAccountNumber.
     *
     * @api
     * @return string
     */
    public function getNetReturnBillAccountNumber();
    /**
     * Sets the NetReturnBillAccountNumber.
     *
     * @param  string $netReturnBillAccountNumber
     * @return string
     */
    public function setNetReturnBillAccountNumber($netReturnBillAccountNumber);

    /**
     * Gets the CustomsIdTypeCode.
     *
     * @api
     * @return string
     */
    public function getCustomsIdTypeCode();
    /**
     * Sets the CustomsIdTypeCode.
     *
     * @param  string $customsIdTypeCode
     * @return string
     */
    public function setCustomsIdTypeCode($customsIdTypeCode);

    /**
     * Gets the AddressTypeCode.
     *
     * @api
     * @return string
     */
    public function getAddressTypeCode();
    /**
     * Sets the AddressTypeCode.
     *
     * @param  string $addressTypeCode
     * @return string
     */
    public function setAddressTypeCode($addressTypeCode);

    /**
     * Gets the ShipmentNotificationSenderEmail.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderEmail();
    /**
     * Sets the ShipmentNotificationSenderEmail.
     *
     * @param  string $shipmentNotificationSenderEmail
     * @return string
     */
    public function setShipmentNotificationSenderEmail($shipmentNotificationSenderEmail);

    /**
     * Gets the SenderEmailLanguage.
     *
     * @api
     * @return string
     */
    public function getSenderEmailLanguage();
    /**
     * Sets the SenderEmailLanguage.
     *
     * @param  string $senderEmailLanguage
     * @return string
     */
    public function setSenderEmailLanguage($senderEmailLanguage);

    /**
     * Gets the senderEmailShipmentNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailShipmentNotification();
    /**
     * Sets the senderEmailShipmentNotification.
     *
     * @param  string $senderEmailShipmentNotification
     * @return string
     */
    public function setSenderEmailShipmentNotification($senderEmailShipmentNotification);

    /**
     * Gets the SenderEmailExceptionNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailExceptionNotification();
    /**
     * Sets the SenderEmailExceptionNotification.
     *
     * @param  string $senderEmailExceptionNotification
     * @return string
     */
    public function setSenderEmailExceptionNotification($senderEmailExceptionNotification);

    /**
     * Gets the SenderEmailDeliveryNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailDeliveryNotification();
    /**
     * Sets the SenderEmailDeliveryNotification.
     *
     * @param  string $senderEmailDeliveryNotification
     * @return string
     */
    public function setSenderEmailDeliveryNotification($senderEmailDeliveryNotification);

    /**
     * Gets the RecipientEmailPickupNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailPickupNotification();
    /**
     * Sets the RecipientEmailPickupNotification.
     *
     * @param  string $recipientEmailPickupNotification
     * @return string
     */
    public function setRecipientEmailPickupNotification($recipientEmailPickupNotification);

    /**
     * Gets the SenderEmailPickupNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailPickupNotification();
    /**
     * Sets the SenderEmailPickupNotification.
     *
     * @param  string $senderEmailPickupNotification
     * @return string
     */
    public function setSenderEmailPickupNotification($senderEmailPickupNotification);

    /**
     * Gets the OpCoTypeCd.
     *
     * @api
     * @return string
     */
    public function getOpCoTypeCd();
    /**
     * Sets the OpCoTypeCd.
     *
     * @param  string $opCoTypeCd
     * @return string
     */
    public function setOpCoTypeCd($opCoTypeCd);

    /**
     * Gets the BrokerAccountId.
     *
     * @api
     * @return string
     */
    public function getBrokerAccountId();
    /**
     * Sets the BrokerAccountId.
     *
     * @param  string $brokerAccountId
     * @return string
     */
    public function setBrokerAccountId($brokerAccountId);

    /**
     * Gets the BrokerTaxId.
     *
     * @api
     * @return string
     */
    public function getBrokerTaxId();
    /**
     * Sets the BrokerTaxId.
     *
     * @param  string $brokerTaxId
     * @return string
     */
    public function setBrokerTaxId($brokerTaxId);

    /**
     * Gets the DefaultBrokerId.
     *
     * @api
     * @return string
     */
    public function getDefaultBrokerId();
    /**
     * Sets the DefaultBrokerId.
     *
     * @param  string $defaultBrokerId
     * @return string
     */
    public function setDefaultBrokerId($defaultBrokerId);

    /**
     * Gets the RecipientEmailTenderedNotification.
     *
     * @api
     * @return string
     */
    public function getRecipientEmailTenderedNotification();
    /**
     * Sets the RecipientEmailTenderedNotification.
     *
     * @param  string $recipientEmailTenderedNotification
     * @return string
     */
    public function setRecipientEmailTenderedNotification($recipientEmailTenderedNotification);

    /**
     * Gets the SenderEmailTenderedNotification.
     *
     * @api
     * @return string
     */
    public function getSenderEmailTenderedNotification();
    /**
     * Sets the SenderEmailTenderedNotification.
     *
     * @param  string $senderEmailTenderedNotification
     * @return string
     */
    public function setSenderEmailTenderedNotification($senderEmailTenderedNotification);
    /**
     * Gets the user account number
     *
     * @api
     * @return string
     */
    public function getUserAccountNumber();

    /**
     * Sets the user account number
     *
     * @param  string $userAccountNumber
     * @return string
     */
    public function setUserAccountNumber($userAccountNumber);

    /**
     * Gets the DeliveryInstructions.
     *
     * @api
     * @return string
     */
    public function getDeliveryInstructions();
    /**
     * Sets the DeliveryInstructions.
     *
     * @param  string $deliveryInstructions
     * @return string
     */
    public function setDeliveryInstructions($deliveryInstructions);

    /**
     * Gets the EstimatedDeliveryFlag.
     *
     * @api
     * @return string
     */
    public function getEstimatedDeliveryFlag();
    /**
     * Sets the EstimatedDeliveryFlag.
     *
     * @param  string $estimatedDeliveryFlag
     * @return string
     */
    public function setEstimatedDeliveryFlag($estimatedDeliveryFlag);

    /**
     * Gets the SenderEstimatedDeliveryFlag.
     *
     * @api
     * @return string
     */
    public function getSenderEstimatedDeliveryFlag();
    /**
     * Sets the SenderEstimatedDeliveryFlag.
     *
     * @param  string $senderEstimatedDeliveryFlag
     * @return string
     */
    public function setSenderEstimatedDeliveryFlag($senderEstimatedDeliveryFlag);

    /**
     * Gets the ShipmentNotificationSenderDeliveryChannel.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderDeliveryChannel();
    /**
     * Sets the ShipmentNotificationSenderDeliveryChannel.
     *
     * @param  string $shipmentNotificationSenderDeliveryChannel
     * @return string
     */
    public function setShipmentNotificationSenderDeliveryChannel($shipmentNotificationSenderDeliveryChannel);

    /**
     * Gets the ShipmentNotificationSenderMobileNo.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNo();
    /**
     * Sets the ShipmentNotificationSenderMobileNo.
     *
     * @param  string $shipmentNotificationSenderMobileNo
     * @return string
     */
    public function setShipmentNotificationSenderMobileNo($shipmentNotificationSenderMobileNo);

    /**
     * Gets the ShipmentNotificationSenderMobileNoCountry.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNoCountry();
    /**
     * Sets the ShipmentNotificationSenderMobileNoCountry.
     *
     * @param  string $shipmentNotificationSenderMobileNoCountry
     * @return string
     */
    public function setShipmentNotificationSenderMobileNoCountry($shipmentNotificationSenderMobileNoCountry);

    /**
     * Gets the ShipmentNotificationSenderMobileNoLanguage.
     *
     * @api
     * @return string
     */
    public function getShipmentNotificationSenderMobileNoLanguage();
    /**
     * Sets the ShipmentNotificationSenderMobileNoLanguage.
     *
     * @param  string $shipmentNotificationSenderMobileNoLanguage
     * @return string
     */
    public function setShipmentNotificationSenderMobileNoLanguage($shipmentNotificationSenderMobileNoLanguage);
}
