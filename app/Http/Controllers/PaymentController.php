<?php



namespace App\Http\Controllers;



use App\FundWallet as AppFundWallet;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Paystack;

use App\PaystackTransaction;

use Illuminate\Support\Facades\Auth;

use App\Helpers;

use App\Http\Controllers\Recharge\ReferralSystemController;

use App\Http\Traits\WalletTrait;

use App\MatrixTransaction;

use App\Traits\PaystackTrait;



class PaymentController extends Controller

{

    use WalletTrait, PaystackTrait;



    /**

     * Redirect the User to Paystack Payment Page

     * @return Url

     */

    public function redirectToGateway()

    {

        return Paystack::getAuthorizationUrl()->redirectNow();

    }



    /**

     * Obtain Paystack payment information

     * @return void

     */

    public function handleGatewayCallback(Request $request)

    {

        $user = Auth::user();

        $paymentDetails = Paystack::getPaymentData();

        $sender = $paymentDetails["data"]["metadata"]["sender"];

        $transaction_id = $paymentDetails["data"]["reference"];

        $amount = (float) $paymentDetails["data"]["amount"] / 100;



        try {

            PaystackTransaction::create(['transaction_id' => $transaction_id]);



            // Fund Wallet

            if ($sender == 0) {



                // User's amount

                $amount =  $paymentDetails["data"]["metadata"]["amount"];



                // Fund Wallet

                $this->increaseIncoming($user->id, $amount);



                // Create record

                AppFundWallet::create([

                    'user_id' => $user->id,

                    'amount' => $amount,

                    'file_name' => null,

                    'depositor_name' => null,

                    'verified' => 1, // 1 - Verified

                    'payment_method' => 2, // 2 - Paystack

                    'date_created' => now(), // 2 - Paystack

                ]);





                // Credit wallet and debit wallet

                MatrixTransaction::create([

                    "user_id" => $user->id,

                    "entry" => "credit",

                    "paymentmethod" => 4,

                    "is_commission" => null,

                    "amount" => $amount,

                    'comment' => 'Wallet Funding'

                ]);

                return redirect('dashboard')->with("message", "Your wallet has been funded with ₦" . $amount)->with("alert", "success");

                //return redirect('/public/wallet/fund')->with("message", "Your wallet has been funded with ₦" . $amount)->with("alert", "success");

            }



            // Upgrade Account

            if ($sender == 1) {

                // Deduct paystack charges.

                $amount = $amount - (float) $this->getPaystackCharge((float) Helpers::settings('matrix_upgrade_amount'));



                // Account Upgrade

                $userController = new UserController();

                $userController->startUpgrade();



                // Credit wallet and debit wallet

                MatrixTransaction::create([

                    "user_id" => $user->id,

                    "entry" => "credit",

                    "paymentmethod" => 4,

                    "is_commission" => null,

                    "amount" => $amount,

                    'comment' => 'Account Upgrade'

                ]);



                MatrixTransaction::create([

                    "user_id" => $user->id,

                    "entry" => "debit",

                    "is_commission" => null,

                    "paymentmethod" => 4, //debit from wallet account

                    "amount" => $amount,

                    'comment' => 'Account Upgrade'

                ]);



                // Return back to user

                return redirect()->route('user_upgrade')

                    ->with('message', 'User account has been upgraded!')

                    ->with('alert', 'success');

            }



            // Upgrade VTU

            if ($sender == 2) { // Upgrade to VTU

                // Upgrade to VTU

                $referralController = new ReferralSystemController();

                $referralController->handleUpgradeVTU($user);

                return back()->with("message", "Upgrade successful!")->with("alert", "success");

            } else {

                abort(401, 'Unauthorized action.');

            }

        } catch (\Illuminate\Database\QueryException $ex) {

            abort(401, 'Unauthorized action.');

        }

    }

}

