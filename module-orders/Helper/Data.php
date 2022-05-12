<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */
namespace HP\Orders\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\RequestInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    private const CLINICALAPP_AUTH_URL = 'hp_authorization/general/clinicalapp_url';

    private const WEBAPP_AUTH_URL = 'hp_authorization/general/webapp_url';

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     *
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $jsonSerializer;

    /**
     * Request object.
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param Context $context
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param Json $jsonSerializer
     * @param RequestInterface $httpRequest
     */
    public function __construct(
        Context $context,
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        Json $jsonSerializer,
        RequestInterface $httpRequest
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->request = $httpRequest;
        parent::__construct($context);
    }

    /**
     * Fetch authorization data from API
     *
     * @return bool
     */
    public function webAppAuthorization()
    {
        $response = false;
        $bearerToken = $this->getAuthToken();
        if (! $bearerToken) {
            return $response;
        }
        $uriEndpoint = $this->scopeConfig->getValue(
            self::WEBAPP_AUTH_URL,
            ScopeInterface::SCOPE_STORE
        );
        if ($uriEndpoint) {
            $response = $this->doRequest($uriEndpoint, $bearerToken);
        }
        return $response;
    }

    /**
     * Fetch authorization data from API
     *
     * @return bool
     */
    public function clinicalAppAuthorization()
    {
        $response = false;

        $bearerToken = $this->getAuthToken();
        if (! $bearerToken) {
            return $response;
        }

        $uriEndpoint = $this->scopeConfig->getValue(
            self::CLINICALAPP_AUTH_URL,
            ScopeInterface::SCOPE_STORE
        );
        if ($uriEndpoint) {
            $response = $this->doRequest($uriEndpoint, $bearerToken);
        }
        return $response;
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param string $bearerToken
     * @param string $requestMethod
     *
     * @return bool
     */
    private function doRequest(
        string $uriEndpoint,
        string $bearerToken,
        string $requestMethod = Request::HTTP_METHOD_GET
    ) {
        /** @var Client $client */
        $client = $this->clientFactory->create();
        $authorized = false;
        try {

            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                ['headers'   => ['Authorization'  => 'Bearer '.$bearerToken]]
            );

            if ($response->getStatusCode() == 200) {

                $responseBody = $response->getBody();
                $responseContent = $this->jsonSerializer->unserialize($responseBody->getContents());
                if (isset($responseContent['isValid'])) {
                    if ($responseContent['isValid']) {
                        $authorized = true;
                    }
                }
            }
        } catch (GuzzleException $exception) {
            $authorized = false;
        }
        return $authorized;
    }

    /**
     * @inheritdoc
     */
    private function getAuthToken()
    {
        $token = false;

        $authorizationBearer = '';
        if ($this->request->getServer('HTTP_AUTHORIZATION')) {
            $authorizationBearer = $this->request->getServer('HTTP_AUTHORIZATION');
        }
    
        $authorizationBearerArr = explode(' ', $authorizationBearer);
        if (isset($authorizationBearerArr[0]) &&
            trim($authorizationBearerArr[0]) == 'Bearer' &&
            isset($authorizationBearerArr[1])
        ) {
            $token = $authorizationBearerArr[1];
        }
    
        return $token;
    }
}
