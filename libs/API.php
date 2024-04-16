<?php
require 'vendor/autoload.php';

use AmazonScraper\Client;

function fetchProduct($asin)
{
    $amazonClient = new Client(
        [
            'rapidapi_key' => '4d74d39b80mshccfb9299397f0fap1a92b8jsnacd9be75fad7'
        ]
    );

    $response = $amazonClient->getProductDetails([
        'asin' => $asin,
        'country' => 'ES'
    ]);

    // echo json_encode($response);

    // echo $response['result'][0]['title'];
    // print_r($response);

    return $response;
}

function fetchProductReviews($asin)
{
    $amazonClient = new Client(
        [
            'rapidapi_key' => '4d74d39b80mshccfb9299397f0fap1a92b8jsnacd9be75fad7'
        ]
    );

    $response = $amazonClient->getProductReviews([
        'asin' => $asin,
        'country' => 'ES',
        'page' => 1, // pagination starts from page#1
        // 'sort_by' => 'recent', // 'recent' or 'helpful'
    ]);

    // echo json_encode($response);

    // return json_encode($response);
    return $response;
}