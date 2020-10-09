<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
class PaypalController extends Controller
{
	private $apiContext;

    public function __construct()
    {
    	$payPalConfig = Config::get('paypal');

    	$this->apiContext = new \PayPal\Rest\ApiContext(
    	        new \PayPal\Auth\OAuthTokenCredential(
    	            $payPalConfig['client_id'],     // ClientID
    	            $payPalConfig['secret']      // ClientSecret
    	        )
    	);
    }

    public function pagarConPaypal(Request $request)
    {
    	$payer = new \PayPal\Api\Payer();
    	$payer->setPaymentMethod('paypal');

    	$amount = new \PayPal\Api\Amount();
    	$amount->setTotal($request->total_pay);
    	$amount->setCurrency('USD');

    	$transaction = new \PayPal\Api\Transaction();
    	$transaction->setAmount($amount);


    	$callbackUrl = url('/paypal/status');
    	$redirectUrls = new \PayPal\Api\RedirectUrls();
    	$redirectUrls->setReturnUrl($callbackUrl)
    	    ->setCancelUrl($callbackUrl);

    	$payment = new \PayPal\Api\Payment();
    	$payment->setIntent('sale')
    	    ->setPayer($payer)
    	    ->setTransactions(array($transaction))
    	    ->setRedirectUrls($redirectUrls);	
    

    	try {
    	    $payment->create($this->apiContext);
    	    //echo $payment;

    	    return redirect()->away($payment->getApprovalLink());
    	}
    	catch (\PayPal\Exception\PayPalConnectionException $ex) {
    	    //REALLY HELPFUL FOR DEBUGGING
    	    echo $ex->getData();
    	}
    }

    public function paypalStatus(Request $request)
    {
    	$paymentId = $request->input('paymentId');
    	$payerId = $request->input('PayerID');
    	$token = $request->input('token');

    	if(!$paymentId || !$payerId || !$token){
    		return redirect('/home')->with('error', 'No se pudo efectuar el pago');
    	}

    	$payment = Payment::get($paymentId, $this->apiContext);

    	$execution = new PaymentExecution();
    	$execution->setPayerId($payerId);

    	$result = $payment->execute($execution, $this->apiContext);

    	if($result->getState() === 'approved'){
    		return redirect('/home')->with('message', 'Pago realizado con éxito, su orden está en proceso!');
    	}
    	
    	return redirect('/home')->with('error', 'Lamentablemente ocurrió un fallo a través del pago de PayPal, pago no efectuado');
    }
}
