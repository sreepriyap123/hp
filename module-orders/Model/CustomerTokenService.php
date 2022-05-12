<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Model;

use Magento\Integration\Model\Oauth\TokenFactory as TokenModelFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Event\ManagerInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Store\Model\StoreManagerInterface;
use HP\Orders\Helper\Data;
use HP\Orders\Helper\Email;

class CustomerTokenService implements \HP\Orders\Api\CustomerTokenServiceInterface
{
    /**
     * Token Model
     *
     * @var TokenModelFactory
     */
    private $tokenModelFactory;

    /**
     * @var Magento\Framework\Event\ManagerInterface
     */
    private $eventManager;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Data
     */
    private $helper;

    /**
     * @var Email
     */
    private $emailHelper;

    /**
     * Initialize service
     *
     * @param TokenModelFactory $tokenModelFactory
     * @param CustomerFactory $customerFactory
     * @param StoreManagerInterface $storeManager
     * @param Data $helper
     * @param Email $emailHelper
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     */
    public function __construct(
        TokenModelFactory $tokenModelFactory,
        CustomerFactory $customerFactory,
        StoreManagerInterface $storeManager,
        Data $helper,
        Email $emailHelper,
        ManagerInterface $eventManager = null
    ) {
        $this->tokenModelFactory = $tokenModelFactory;
        $this->customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
        $this->emailHelper = $emailHelper;
        $this->eventManager = $eventManager ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(ManagerInterface::class);
    }

    /**
     * @inheritdoc
     */
    public function createCustomerAccessToken($email, $fname = '', $lname = '')
    {
        if (! $this->helper->webAppAuthorization()) {
            throw new LocalizedException(
                __(
                    "The consumer isn't authorized to access the url."
                )
            );
        }
        $store = $this->storeManager->getStore();
        $storeId = $store->getStoreId();
        $websiteId = $this->storeManager->getStore()->getWebsiteId();
        $customer = $this->customerFactory->create();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($email);
        if (! $customer->getId()) {
            if (! $fname || ! $lname) {
                throw new LocalizedException(
                    __(
                        'First name and last name are required fields.'
                    )
                );
            }
            try {
                $customer->setWebsiteId($websiteId)
                ->setStore($store)
                ->setFirstname($fname)
                ->setLastname($lname)
                ->setEmail($email)
                ->setPassword($fname.'@12345');
                $customer->save();
                $emailTemplateVariables['template'] = 1;
                $emailTemplateVariables['emails'] [] = [
                    "email"=> $customer->getEmail(),
                    "data"=> [
                        "CUSTOMER_NAME"=> $customer->getFirstname().' '. $customer->getLastname()
                        
                    ]
                ];
                $this->emailHelper->sendMail($emailTemplateVariables);
            } catch (LocalizedException $e) {
                throw new LocalizedException(
                    __(
                        'Unable to save customer: '.$e->getMessage()
                    ),
                    $e
                );
            }
        }
        $this->eventManager->dispatch('customer_login', ['customer' => $customer]);
        return $this->tokenModelFactory->create()->createCustomerToken($customer->getId())->getToken();
    }
}
