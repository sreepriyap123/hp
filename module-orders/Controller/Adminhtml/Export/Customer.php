<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
 */

namespace HP\Orders\Controller\Adminhtml\Export;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Sales\Api\OrderRepositoryInterface;
use HP\Orders\Model\ResourceModel\OrderDetails\CollectionFactory;

class Customer extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    private $fileFactory;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    private $directory;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * DeviceOrder constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param OrderRepositoryInterface $orderRepository
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem $filesystem,
        OrderRepositoryInterface $orderRepository,
        \Magento\Ui\Component\MassAction\Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->fileFactory = $fileFactory;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->orderRepository = $orderRepository;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Returns CSV file
     *
     * @return array
     * @throws LocalizedException
     */
    public function execute()
    {
        $component = $this->filter->getComponent();

        $name = hash('sha256', microtime());
        $file = 'export/'.  $name . '.csv';
        $this->pageSize = 200;
        $this->filter->prepareComponent($component);
        $this->filter->applySelectionOnTargetProvider();
        $dataProvider = $component->getContext()->getDataProvider();
   
        $this->directory->create('export');
        $stream = $this->directory->openFile($file, 'w+');
        $stream->lock();
        $columns = ['Increment ID', 'Nickname','FullName','FirstName',
        'LastName','Title','Company','Department', 'AddressOne','AddressTwo','City','State','Zip',
        'PhoneNumber','ExtensionNumber','FAXNumber','PagerNumber','MobilePhoneNumber','CountryCode','EmailAddress',
        'VerifiedFlag','AcceptedFlag','ValidFlag','ResidentialFlag','CustomsIDEIN','ReferenceDescription',
        'ServiceTypeCode','PackageTypeCode','CollectionMethodCode','BillCode','BillAccountNumber','DutyBillCode',
        'DutyBillAccountNumber','CurrencyTypeCode','InsightIDNumber','GroundReferenceDescription',
        'ShipmentNotificationRecipientEmail','RecipientEmailLanguage','RecipientEmailShipmentnotification',
        'RecipientEmailExceptionnotification','RecipientEmailDeliverynotification','PartnerTypeCodes',
        'NetReturnBillAccountNumber','CustomsIDTypeCode','AddressTypeCode',
        'ShipmentNotificationSenderEmail','SenderEmailLanguage','SenderEmailShipmentnotification',
        'SenderEmailExceptionnotification','SenderEmailDeliverynotification','RecipientEmailPickupnotification',
        'SenderEmailPickupnotification','OpCoTypeCd','BrokerAccountID','BrokerTaxID','DefaultBrokerID',
        'RecipientEmailTenderednotification','SenderEmailTenderednotification','UserAccountNumber',
        'DeliveryInstructions','EstimatedDeliveryFlag','SenderEstimatedDeliveryFlag',
        'ShipmentNotificationSenderDeliveryChannel','ShipmentNotificationSenderMobileNo',
        'ShipmentNotificationSenderMobileNoCountry','ShipmentNotificationSenderMobileNoLanguage'];
        $header = [];
        foreach ($columns as $column) {
            $header[] = $column;
        }

        $stream->writeCsv($header);
        $i = 1;
        $searchCriteria = $dataProvider->getSearchCriteria()
            ->setCurrentPage($i)
            ->setPageSize($this->pageSize);
        $totalCount = (int) $dataProvider->getSearchResult()->getTotalCount();

        while ($totalCount > 0) {
            $items = $dataProvider->getSearchResult()->getItems();
            foreach ($items as $item) {
                
                $order = $this->orderRepository->get($item->getEntityId());
                $shippingAddress = $order->getShippingAddress();
                $street = $shippingAddress->getStreet();
                if ($order->getStatus() == 'approved') {

                    $fedexData = $this->collectionFactory->create()
                    ->addFieldToFilter('order_id', $item->getEntityId())
                    ->getFirstItem();
                    $info = [
                        $item->getIncrementId(),
                        $fedexData->getNickname() != null ? $fedexData->getNickname(): '',
                        $item->getShippingName(),
                        $shippingAddress->getFirstname(),
                        $shippingAddress->getLastname(),
                        $fedexData->getTitle() != null ? $fedexData->getTitle(): '',
                        $shippingAddress->getCompany(),
                        $fedexData->getDepartment() != null ? $fedexData->getDepartment(): '',
                        isset($street[0])? $street[0]: '',
                        isset($street[1])? $street[1]: '',
                        $shippingAddress->getCity(),
                        $shippingAddress->getRegion(),
                        $shippingAddress->getPostcode(),
                        $shippingAddress->getTelephone(),
                        $fedexData->getExtensionNumber() != null ? $fedexData->getExtensionNumber(): '',
                        $shippingAddress->getFax(),
                        $fedexData->getPagerNumber() != null ? $fedexData->getPagerNumber(): '',
                        $fedexData->getMobilePhoneNumber() != null ? $fedexData->getMobilePhoneNumber(): '',
                        $shippingAddress->getCountryId(),
                        $item->getCustomerEmail(),
                        $fedexData->getVerifiedFlag() != null ? $fedexData->getVerifiedFlag(): '',
                        $fedexData->getAcceptedFlag() != null ? $fedexData->getAcceptedFlag(): '',
                        $fedexData->getValidFlag() != null ? $fedexData->getValidFlag(): '',
                        $fedexData->getResidentialFlag() != null ? $fedexData->getResidentialFlag(): '',
                        $fedexData->getCustomsIdEin() != null ? $fedexData->getCustomsIdEin(): '',
                        $fedexData->getReferenceDescription() != null ? $fedexData->getReferenceDescription(): '',
                        $fedexData->getServiceTypeCode() != null ? $fedexData->getServiceTypeCode(): '',
                        $fedexData->getPackageTypeCode() != null ? $fedexData->getPackageTypeCode(): '',
                        $fedexData->getCollectionMethodCode() != null ? $fedexData->getCollectionMethodCode(): '',
                        $fedexData->getBillCode() != null ? $fedexData->getBillCode(): '',
                        $fedexData->getBillAccountnumber() != null ? $fedexData->getBillAccountnumber(): '',
                        $fedexData->getDutyBillCode() != null ? $fedexData->getDutyBillCode(): '',
                        $fedexData->getDutyBillAccountNumber() != null ? $fedexData->getDutyBillAccountNumber(): '',
                        $item->getOrderCurrencyCode(),
                        $fedexData->getInsightIdNumber() != null ? $fedexData->getInsightIdNumber(): '',
                        $fedexData->getGroundReferenceDescription() != null ?
                        $fedexData->getGroundReferenceDescription(): '',
                        $fedexData->getShipmentNotificationRecipientEmail() != null ?
                        $fedexData->getShipmentNotificationRecipientEmail(): '',
                        $fedexData->getRecipientEmailLanguage() != null ? $fedexData->getRecipientEmailLanguage(): '',
                        $fedexData->getRecipientEmailShipmentNotification() != null ?
                        $fedexData->getRecipientEmailShipmentNotification(): '',
                        $fedexData->getRecipientEmailExceptionNotification() != null ?
                        $fedexData->getRecipientEmailExceptionNotification(): '',
                        $fedexData->getRecipientEmailDeliveryNotification() != null ?
                        $fedexData->getRecipientEmailDeliveryNotification(): '',
                        $fedexData->getPartnerTypeCodes() != null ? $fedexData->getPartnerTypeCodes(): '',
                        $fedexData->getNetReturnBillAccountNumber() != null ?
                        $fedexData->getNetReturnBillAccountNumber(): '',
                        $fedexData->getCustomsIdTypeCode() != null ? $fedexData->getCustomsIdTypeCode(): '',
                        $fedexData->getAddressTypeCode() != null ?
                        $fedexData->getAddressTypeCode(): '',
                        $fedexData->getShipmentNotificationSenderEmail() != null ?
                        $fedexData->getShipmentNotificationSenderEmail(): '',
                        $fedexData->getSenderEmailLanguage() != null ? $fedexData->getSenderEmailLanguage(): '',
                        $fedexData->getSenderEmailShipmentNotification() != null ?
                        $fedexData->getSenderEmailShipmentNotification(): '',
                        $fedexData->getSenderEmailExceptionNotification() != null ?
                        $fedexData->getSenderEmailExceptionNotification(): '',
                        $fedexData->getSenderEmailDeliveryNotification() != null ?
                        $fedexData->getSenderEmailDeliveryNotification(): '',
                        $fedexData->getRecipientEmailPickupNotification() != null ?
                        $fedexData->getRecipientEmailPickupNotification(): '',
                        $fedexData->getSenderEmailPickupNotification() != null ?
                        $fedexData->getSenderEmailPickupNotification(): '',
                        $fedexData->getOpCoTypeCd() != null ? $fedexData->getOpCoTypeCd(): '',
                        $fedexData->getBrokerAccountId() != null ? $fedexData->getBrokerAccountId(): '',
                        $fedexData->getBrokerTaxId() != null ? $fedexData->getBrokerTaxId(): '',
                        $fedexData->getDefaultBrokerId() != null ? $fedexData->getDefaultBrokerId(): '',
                        $fedexData->getRecipientEmailTenderedNotification() != null ?
                        $fedexData->getRecipientEmailTenderedNotification(): '',
                        $fedexData->getSenderEmailTenderedNotification() != null ?
                        $fedexData->getSenderEmailTenderedNotification(): '',
                        $fedexData->getUserAccountNumber() != null ? $fedexData->getUserAccountNumber(): '',
                        $fedexData->getDeliveryInstructions() != null ? $fedexData->getDeliveryInstructions(): '',
                        $fedexData->getEstimatedDeliveryFlag() != null ? $fedexData->getEstimatedDeliveryFlag(): '',
                        $fedexData->getSenderEstimatedDeliveryFlag() != null ?
                        $fedexData->getSenderEstimatedDeliveryFlag(): '',
                        $fedexData->getShipmentNotificationSenderDeliveryChannel() != null ?
                        $fedexData->getShipmentNotificationSenderDeliveryChannel(): '',
                        $fedexData->getShipmentNotificationSenderMobileNo() != null ?
                        $fedexData->getShipmentNotificationSenderMobileNo(): '',
                        $fedexData->getShipmentNotificationSenderMobileNoCountry() != null ?
                        $fedexData->getShipmentNotificationSenderMobileNoCountry(): '',
                        $fedexData->getShipmentNotificationSenderMobileNoLanguage() != null ?
                        $fedexData->getShipmentNotificationSenderMobileNoLanguage(): '',
                    ];
                    $stream->writeCsv($info);
                }
            }
            $searchCriteria->setCurrentPage(++$i);
            $totalCount = $totalCount - $this->pageSize;
        }

        $stream->unlock();
        $stream->close();

        $content = [
                'type' => 'filename',
                'value' => $file,
                'rm' => true
            ];

        $csvFileName = 'export_customer_info.csv';
        return $this->fileFactory->create($csvFileName, $content, DirectoryList::VAR_DIR);
    }
}
