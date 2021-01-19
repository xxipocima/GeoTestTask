<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoService extends Services
{
    const SERVICE = 'Geo';

    public function __construct(LoggerInterface $logger, HttpClientInterface $httpClient, ParameterBagInterface $params, string $url){

        parent::__construct($logger, $httpClient, $params, $url);
    }
}
