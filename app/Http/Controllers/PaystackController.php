<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

class PaystackController extends Controller
{
    private $sk = '';

    function __construct()
    {
        $this->middleware('auth');
        $this->sk = env('PAYSTACK_SECRET_KEY');
    }

    public function index(Request $request)
    {
        $this->verify($request);
    }

    /**
     * Verify the status of the payment
     * @param string $reference
     * @return
     */
    public function verify($reference)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer " . $this->sk,
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            dd('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response);

        if (!$tranx->status) {
            // there was an error from the API
            dd('API returned error: ' . $tranx->message);
        }

        if ('success' == $tranx->data->status) {
            return $tranx->data;
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
        }
    }

    /** */
    public function doTransaction(Request $request)
    {
        $curl = curl_init();

        $email = 'sample@sample.com';
        $amount = 1000.0;  //the amount in kobo. This value is actually NGN 300

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . $this->sk, //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);

        if (!$tranx->status) {
            // there was an error from the API
            print_r('API returned error: ' . $tranx['message']);
        }

        // comment out this line if you want to redirect the user to the payment page
        print_r($tranx);


        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        //header('Location: ' . $tranx['data']['authorization_url']);
    }

    public function bvnResolve($bvn)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve_bvn/" . rawurlencode($bvn),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer " . $this->sk,
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            dd('Curl returned error: ' . $err);
        }

        $res = json_decode($response);

        if (!$res->status) {
            // there was an error from the API
            dd('API returned error: ' . $res->message);
        }

        if ('true' == $res->status) {
            return $res->data;
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
        }
    }

    /**
     * Confirm if user's account number matches with his bank name
     *
     */
    public function resolveAccountNumber($account_number, $bank_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . rawurlencode($account_number) . '&bank_code=' . rawurlencode($bank_code),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer " . $this->sk,
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $res = json_decode($response);

        if ('true' == $res->status) {
            return $res->data;
        }
    }
}
