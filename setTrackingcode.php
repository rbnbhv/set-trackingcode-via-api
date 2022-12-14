<?php

include 'MyApiClient.php';
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$orderDeliveryId = '2f41a90c2fe943f6829cab2e8d6e0b42';
$client = new Client();
$apiClient = new MyApiClient($client);
$apiClient->setTrackingcode($orderDeliveryId, ['123456789']);
$apiClient->markOrderAsShipped($orderDeliveryId);