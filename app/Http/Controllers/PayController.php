<?php

namespace App\Http\Controllers;

// use App\Models\Payment;
// use Exception;
// use Illuminate\Http\Request;
// use Omnipay\Omnipay;

class PayController extends Controller
{
    // private $gateway;

    // public function __construct()
    // {
    //     $this->gateway = Omnipay::create('PayPal_Rest');
    //     $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
    //     $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
    //     $this->gateway->setTestMode(true);
    // }

    // public function index()
    // {
    //     return view('');
    // }

    // public function charge(Request $request)
    // {
    //     if ($request->input('submit')) {
    //         try {
    //             $response = $this->gateway->purchase(array(
    //                 'amount' => session()->get('cart')->totalPrice / 100,
    //                 'currency' => env('PAYPAL_CURRENCY'),
    //                 'returnUrl' => url('paypal/success'),
    //                 'cancelUrl' => url('paypal/error'),
    //             ))->send();

    //             if ($response->isRedirect()) {
    //                 $response->redirect();
    //             } else {
    //                 return $response->getMessage();
    //             }
    //         } catch (Exception $e) {
    //             return $e->getMessage();
    //         }
    //     }
    // }

    // public function success(Request $request)
    // {
    //     if ($request->input('paymentId') && $request->input('PayerID')) {
    //         $transaction = $this->gateway->completePurchase(array(
    //             'payer_id' => $request->input('PayerID'),
    //             'transactionReference' => $request->input('paymentId')
    //         ));

    //         $response = $transaction->send();

    //         if ($response->isSuccessful()) {
    //             $arr_body = $response->getData();

    //             $payment = new Payment();
    //             $payment->payment_id = $arr_body['id'];
    //             $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
    //             $payment->payer_email = $arr_body['payer']['payer_info']['email'];
    //             $payment->amount = $arr_body['transactions'][0]['amount']['total'];
    //             $payment->currency = env('PAYPAL_CURRENCY');
    //             $payment->payment_status = $arr_body['state'];
    //             $payment->save();

    //             return  'Užsakymas priimtas sėkmingai, užsakymo Nr. ' . $arr_body['id'];
    //         } else {
    //             return $response->getMessage();
    //         }
    //     } else {
    //         return 'Mokėjimas atmestas';
    //     }

    //     return redirect()->route('products.index');
    // }

    // public function error()
    // {
    //     return 'error';
    // }
}
