<?php
require   'vendor/autoload.php';

define("SITE_URL" , "http://localhost/paypal-sdk");
//Sesuaikan dengan URL anda...

$apiContext  = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        '', // ClientID
        ''  // ClientSecret
    )
);


