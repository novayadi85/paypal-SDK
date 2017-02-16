<?php  
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$item = new Item();
$item->setName('Product Name')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("sku")
    ->setPrice(200);
	

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setShipping()
    ->setTax()
    ->setSubtotal();
	
$amount = new Amount();
$amount->setCurrency()
    ->setTotal()
    ->setDetails($details);
	
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription()
    ->setInvoiceNumber(uniqid());
	
$baseUrl = SITE_URL;
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/success.php?success=true")
    ->setCancelUrl("$baseUrl/success.php?success=false");
	
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));
	
	
$request = clone $payment;


try {
    $payment->create($apiContext);
}catch (Exception $ex) {
	
	exit(1);
}

$approvalUrl = $payment->getApprovalLink();

header("location:".$approvalUrl);
