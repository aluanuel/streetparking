<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MomoPayController extends Controller
{
    //

    protected function createApiUser(){
    	<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://sandbox.momodeveloper.mtn.com/v1_0/apiuser');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'X-Reference-Id' => '0b22fd8a-e47e-11ea-87d0-0242ac130003',
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => '{873ce3e0c4bd41fe939ea527546f1185}',
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
$request->setBody("{ "providerCallbackHost": "localhost:8000"
}");

try
{
    $response = $request->send();
    echo $response->getBody();
}
catch (HttpException $ex)
{
    echo $ex;
}

?>
    }
}
