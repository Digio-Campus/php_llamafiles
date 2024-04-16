<?php
require 'vendor/autoload.php';

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use OpenAI\Client;


// echo 'dentro de AI.php';
// AI();

function AI($reviews, $quantity) {

    $client = OpenAI::factory()
        ->withApiKey('sk-no-key-required')
        // ->withOrganization('your-organization') // default: null
        ->withBaseUri('http://172.29.240.1:8080/v1') // default: api.openai.com/v1
        ->withHttpClient($client = new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client Discovery
        ->withHttpHeader('Content-Type', 'application/json') // Agregar el encabezado Content-Type
        ->withHttpHeader('Authorization', 'Bearer no-key') // Agregar el encabezado Authorization
        // ->withHttpHeader('X-My-Header', 'foo')
        // ->withQueryParam('prompt', 'Hello')
        // ->withQueryParam('n-predict', '128')
        ->withStreamHandler(function (RequestInterface $request) use ($client): ResponseInterface {
            return $client->send($request, [
                'stream' => true // Allows to provide a custom stream handler for the http client.
            ]);
        })
        ->make();


        // $result = $client->chat()->create([
        //     'model' => 'LLaMA_CPP-4',
        //     'messages' => [
        //         ['role' => 'user', 'content' => 'Hello!'],
        //     ],
        // ]);
        
        // echo $result->choices[0]->message->content; // Hello! How can I assist you today?

    // $reviews = [];
    $analisis = [];
    $result = [];


    // var_dump($analisis);

    // Comprobamos que existan reviews y si existen realizamos el analisis
    if ($reviews) {

        // Recorremos la cantidad de preguntas seleccionadas por el usuario
        for ($i = 0; $i < $quantity; $i++) {

            // Ejecutamos el modelo de IA para que analice las reviews

            $result = $client->chat()->create([
                'model' => 'LLaMA_CPP',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an expert in charge of analyzing the reviews of the products on Amazon, you must analyze each review and decide whether it is a positive or negative review so that another user who wants to buy the product can get an idea of the quality of it.'],
                    // ['role' => 'system', 'content' => 'You are an expert in charge of analyzing the reviews of Amazon products, you must analyze each review and decide whether it is a positive or negative review so that another user who wants to buy the product can get an idea of the quality of it, then I will provide the review and you must generate two answers, one saying if the review is positive or negative and another answer briefly explaining why you thought it was a positive or negative review.'],
                    // ['role' => 'system', 'content' => 'You are an expert in charge of analyzing the reviews of amazon products, you must analyze each review and decide if it is a positive or negative review so that another user wants to buy the product or not when he sees this message, it is totally forbidden that the answer is "Positive" or "Negative", the answer must contain some development on why it was thought to be positive or negative, also, no matter the language in which the review you analyze is, your answer must always be in English.'],
                    // ['role' => 'system', 'content' => 'You are an expert in charge of analyzing the reviews of amazon products, you must analyze each review and decide if it is a positive or negative review so that another user wants to buy the product or not when he sees this message, it is totally forbidden that the answer is "Positive" or "Negative", the answer must contain some development on why it was thought to be positive or negative.
                    // '],

                    ['role' => 'user', 'content' => $reviews[$i]['review']],
                    ['role' => 'user', 'content' => 'Justify why you answered that the previous question was a positive or negative review.'],
                ],
            ]);

            foreach ($result->choices as $response) {
                $response->index; // 0
                $response->message->role; // 'assistant'
                $response->message->content; // '\n\nHello there! How can I assist you today?'
                $response->finishReason; // 'stop'

                array_push($analisis, [
                    'product_id' => $reviews[$i]['product_id'],
                    'review' => $reviews[$i]['id'],
                    'analisis' => $response->message->content,
                ]);
            }

            // $stream = $client->chat()->createStreamed([
            //     'model' => 'LLaMA_CPP',
            //     'messages' => [
            //         ['role' => 'system', 'content' => 'You are an expert in charge of analyzing the reviews of the products on Amazon, you must analyze each review and decide whether it is a positive or negative review so that another user who wants to buy the product can get an idea of the quality of it.'],
            //         ['role' => 'user', 'content' => 'Hello!'],
            //     ],
            // ]);

            // foreach ($stream as $response) {
            //     $response->choices[0]->toArray();
            // }


            // var_dump($response->object['object']);


            // echo '<-----------------------  RESULT  ----------------------->';
            // var_dump($result);


            // array_push($analisis, [
            //     'product_id' => $reviews[$i]['product_id'],
            //     'review' => $reviews[$i]['id'],
            //     'analisis' => $result->choices[0]->message->content,
            // ]);

            // var_dump(json_encode($analisis));
            // var_dump($analisis);

            // Insercción del analisis de la review en la BD
            // setAnalisis($analisis);
        }
    }

    // echo 'DUMP RESULT';
    // var_dump($result);

    // echo 'DUMP choices';
    // var_dump($result->choices[0]);

    // echo 'DUMP choices message';
    // var_dump($result->choices[0]->message);

    // foreach ($variable as $key => $value) {
    //     # code...
    // }

    return $analisis;
}