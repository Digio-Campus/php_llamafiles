<?php
require 'vendor/autoload.php';

use AmazonScraper\Client;

function fetchProduct($asin)
{
    $amazonClient = new Client(
        [
            'rapidapi_key' => 'b00fbee5b3msh65cb9f2e73da16ap1d2172jsn40a9d9536c64'
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
            'rapidapi_key' => 'b00fbee5b3msh65cb9f2e73da16ap1d2172jsn40a9d9536c64'
        ]
    );

    // for ($i = 1; $i < 5; $i++) {
    //     $response = $amazonClient->getProductReviews([
    //         'asin' => $asin,
    //         'country' => 'ES',
    //         'page' => $i, // pagination starts from page#1
    //         // 'sort_by' => 'recent', // 'recent' or 'helpful'
    //     ]);
    // }

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