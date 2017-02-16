<?php  

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require "app/start.php";
if(!isset($_GET["success"] , $_GET["paymentId"] , $_GET["PayerID"])){
	die();
}

if((bool) $_GET["success"] === false){
	die();
}

$paymentId = $_GET["paymentId"];
$payerId = $_GET["PayerID"];

$payment = Payment::get($paymentId,$apiContext );
$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
	$result = $payment->execute($execute , $apiContext );
}
catch(Exception $e){
	$data = json_decode($e->getData());
	var_dump($data->message);
	die();
}
/* var_dump($result); */
print "Thanks for Payment";