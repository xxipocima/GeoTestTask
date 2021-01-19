<?php


namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class Services
{
    private $url;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(LoggerInterface $logger, HttpClientInterface $httpClient, ParameterBagInterface $params, string $url){

        $this->url = $url;

        $this->logger = $logger;

        $this->httpClient = $httpClient;

        $this->params = $params;
    }

    public function call($service, $method, $requestName, $requestParams){
        $response = $this->httpClient->request($method, $this->url . $requestName . $requestParams);

        if ($response->getStatusCode() == 404) {
            throw new HttpException('404', 'Remote error: ' . implode($response->getInfo()));
        }

        if ($response->getStatusCode() == 401) {
            throw new HttpException('401', 'Remote error: ' . implode($response->getInfo()));
        }

        if (200 !== $response->getStatusCode()) {
            return $response->getInfo();
        } else {
            return Response::create($response->toArray())->getData();
        }
    }
}
