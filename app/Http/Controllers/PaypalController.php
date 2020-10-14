<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

use App\Bank;
use App\Banks_User;
use App\Pago;
use App\Order;
use Carbon\Carbon;

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


        //pago completado
    	if($result->getState() === 'approved'){

            $user = auth()->user();
            $orden = Order::latest('id')->where('user_id', $user->id)->where('status', 'ACTIVO')->first();


            $banco = Bank::where('title', 'Otros')->first();
            $cuenta = Banks_User::where('title', 'PayPal')->first();

            // Identidad comprador
            $nombre = $result->payer->payer_info->first_name;
            $apellido = $result->payer->payer_info->last_name;
            $nombreCompleto = $nombre." ".$apellido;

            if(!$banco)
            {
                $banco = Bank::create([
                    'title' => 'Otros'
                ]); 
            }

            if(!$cuenta)
            {
                $cuenta = Banks_User::create([
                    'title' => 'PayPal',
                    'number_account' => 0000,
                    'titular' => 'Admin',
                ]);
            }


            Pago::create([
                'user_id' => $user->id,
                'orden_id' => $orden->id,
                'monto' => $orden->total_amount,
                'fecha' => Carbon::now(),
                'id_banco_emisor' => $banco->id,
                'id_banco_receptor' => $cuenta->id,
                'referencia' => $result->id,
                'titular_cuenta' => $nombreCompleto,
                'documento_identidad_titular' => $result->payer->payer_info->payer_id,
            ]);

            $orden->status = 'COMPLETADO';
            $orden->save();

    		return redirect('/home')->with('message', 'Pago realizado con éxito, su orden está en proceso!');
    	}
    	
    	return redirect('/home')->with('error', 'Lamentablemente ocurrió un fallo a través del pago de PayPal, pago no efectuado');
    }
}
