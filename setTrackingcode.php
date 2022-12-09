<?php


include 'Credentials.php';
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

const HOST = 'http://shopware.p574147.webspaceconfig.de';

$client = new Client();
$accessToken = getAccessToken($client);

$request = new Request(
    'GET',
    HOST . '/api/order/6e96bb30203e4355b6a10caeec40c1b3',
    [
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ]
);
$response = $client->send($request);
$body = json_decode($response->getBody()->getContents(), true);

function getAccessToken($client)
{
    $body = json_encode([
        'client_id' => 'administration',
        'grant_type' => 'password',
        'scopes' => '',
        'username' => USERNAME,
        'password' => PASSWORD
    ]);
    $request = new Request(
        'POST',
        'http://shopware.p574147.webspaceconfig.de/api/oauth/token',
        ['Content-Type' => 'application/json'],
        $body
    );
    $response = $client->send($request);
    $body = json_decode($response->getBody()->getContents(), true);
    $accessToken = $body['access_token'];
    $refreshToken = $body['refresh_token'];
    return $accessToken;
}

$request = new Request(
    'PATCH',
    HOST . '/api/order-delivery/2f41a90c2fe943f6829cab2e8d6e0b42',
    [
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ],
    json_encode([
        'id' => '2f41a90c2fe943f6829cab2e8d6e0b42',
        'trackingCodes' => ['123456789']
    ])
);
$response = $client->send($request);
var_dump($body['data']);
$body = json_decode($response->getBody()->getContents(), true);

