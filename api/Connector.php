<?php
namespace dreamwhiteAPI;

use GuzzleHttp\Promise;
use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class Connector
{


  const MS_BASE_URL = "https://online.moysklad.ru/api/remap/1.1/entity/";
  const MS_POST_URL = "https://online.moysklad.ru/api/remap/1.1/entity/counterparty/";
  var $HEADERS = [];
  var $client;

  function __construct()
  {
    $this->HEADERS = [
      'auth' => [Auth::login, Auth::password],

      'headers' => ['Content-Type' => 'application/json',
        'Authorization' => 'Basic '. base64_encode(Auth::login.':'.Auth::password),],
      'stream_context' => [
        'ssl' => [
          'allow_self_signed' => true
        ],
      ],
      'verify' => false,
    ];
    $this->client = new Client($this->HEADERS);
  }

}
