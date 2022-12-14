<?php

include 'Credentials.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class MyApiClient
{
    private Client $client;
    private string $accessToken;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->getAccessToken();
    }

    public function getAccessToken() : void
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
            HOST.'/api/oauth/token',
            ['Content-Type' => 'application/json'],
            $body
        );
        $response = $this->sendRequest($request);

        $body = json_decode($response->getBody()->getContents(), true);
        $this->accessToken = $body['access_token'];
    }

    public function setTrackingcode(string $orderDeliveryId, array $trackingCodes) : void
    {
        $request = new Request(
            'PATCH',
            HOST . '/api/order-delivery/' . $orderDeliveryId,
            [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            json_encode([
                'id' => $orderDeliveryId,
                'trackingCodes' => $trackingCodes
            ])
        );
        $this->sendRequest($request);
    }

    public function markOrderAsShipped(string $orderDeliveryId) : void
    {
        $request = new Request(
            'POST',
            HOST . '/api/_action/order_delivery/' . $orderDeliveryId . '/state/ship',
            [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            json_encode([
                'sendMail' => false,
                'documentIds' => [
                ],
                'mediaIds' => [
                ],
                'stateFieldName' => 'stateId'
            ])
        );
        $this->sendRequest($request);
    }
    private function sendRequest($request) : Response | null  {
        $response = null;
        try {
            $response = $this->client->send($request);
        }
        catch(GuzzleException $exception){
            echo $exception->getMessage();
        }
        return $response;
    }
}
