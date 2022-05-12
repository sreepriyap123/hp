<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Helper;

use Magento\Store\Model\ScopeInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Email helper
 */
class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private $authSession;

    /**
     * @var \Magento\User\Model\UserFactory
     */
    private $userFactory;

    /**
     * @param Magento\Framework\App\Helper\Context $context
     * @param ClientFactory $clientFactory
     * @param Magento\User\Model\UserFactory $userFactory
     * @param Magento\Backend\Model\Auth\Session $authSession
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        ClientFactory $clientFactory,
        \Magento\User\Model\UserFactory $userFactory,
        \Magento\Backend\Model\Auth\Session $authSession
    ) {
        $this->authSession = $authSession;
        $this->clientFactory = $clientFactory;
        parent::__construct($context);
        $this->userFactory = $userFactory;
    }

    /**
     * Send Email
     *
     * @param  Mixed $emailTemplateVariables
     * @return void
     */
    public function sendMail($emailTemplateVariables)
    {
        $uriEndpoint = $this->scopeConfig->getValue(
            'hp_authorization/hp_email_notification/email_api_url',
            ScopeInterface::SCOPE_STORE
        );
        $key = $this->scopeConfig->getValue(
            'hp_authorization/hp_email_notification/email_api_key',
            ScopeInterface::SCOPE_STORE
        );

        /** @var Client $client */
        $client = $this->clientFactory->create();
        try {

            $response = $client->request(
                'POST',
                $uriEndpoint,
                [
                    'headers'   => ['Webapp'  => $key,'Content-Type'=>'application/json'],
                    'body'=>json_encode($emailTemplateVariables)
                ]
            );
            
        } catch (GuzzleException $exception) {
            return null;
        }
    }
}
