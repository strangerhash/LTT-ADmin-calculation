<?php

namespace App\Http\Controllers\Recharge;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Recharge\ReferralSystemController;
use App\Recharge\Airtime;
use App\Recharge\Transaction;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Helpers;
use App\MatrixTransaction;
use App\PIETransaction;
use Unicodeveloper\Paystack\Facades\Paystack;

class AirtimeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Class can only be accessed by the auth middleware
        $this->middleware('auth');
    }


    public function purchase(Request $request)
    {
        // User
        $user = Auth::user();

        // Disable Recharge
        $disable_recharge =  Helpers::settings('disable_recharge');
        if ($disable_recharge == 0) {
            return back()
                ->with('message', '<b>Recharge has been disabled!<b><br/>Please try again.')
                ->with('alert', 'danger');
        }

        // Validate Input
        $data = $request->validate(
            [
                "paymentmethod" => ['integer', 'required'],
                "mobilenetwork" => ['integer', 'required'],
                "amount" => ['integer', 'required'],
                "phone" => ['required'],
                "password" => ['required'],
            ],
            [
                'mobilenetwork.integer' => 'You have to select a mobile network provider.',
                'paymentmethod.integer' => 'You have to select a payment method.',
                'amount.integer' => 'Amount has to be in numbers.',

            ]
        );

        // Confirm Password
        if (!Hash::check($data["password"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Account Balance
        $balance = 0.0;

        if ($data["paymentmethod"] == 11 || $data["paymentmethod"] == 12 || $data["paymentmethod"] == 13) {

            // Check If User Referral Is Compelete
            $no_of_referrals = User::where('sponsor_id', $user->id)->where('is_upgraded', 1)->count();

            // Charge Wallet
            if ($data["paymentmethod"] == 12) {
                // Matrix Account

                // Check if User has met the expected number of referrals
                if (WalletController::canWithdraw($user->current_matrix, $no_of_referrals) == false) {
                    if ($no_of_referrals < 3) {
                        return back()
                            ->with('message', 'You must have referred 3 people directly before your purse can be active!')
                            ->with('alert', 'danger')
                            ->withInput();
                    }

                    if ($no_of_referrals < 6) {
                        return back()
                            ->with('message', 'At Quorum 3, You are required to refer 3 more people directy to re-activate your purse!')
                            ->with('alert', 'danger')
                            ->withInput();
                    }
                }
                // User can withdraw from his matrix wallet
                $balance = $user->wallet->balance;
            } elseif ($data["paymentmethod"] == 11) {
                // PIE Account
                $balance = $user->wallet->pie;
            } elseif ($data["paymentmethod"] == 13) {
                // Iscube Recharge Account
                $balance = $user->recharge->wallet;
            } else {
                return back()
                    ->with('message', 'Payment method should be either via youe wallets or online!')
                    ->with('alert', 'danger')
                    ->withInput();
            }


            // Check if user has enough money
            $amount = $data["amount"];

            if ($balance >= $amount) {

                // Log Transaction
                if ($data["paymentmethod"] == 11) {
                    $wallet = new WalletController();
                    $wallet->decreasePIE($user->id, $amount);

                    // Log PIE Transaction
                    PIETransaction::create([
                        "user_id" => $user->id,
                        "pie_id" => null,
                        "entry" => "debit",
                        "paymentmethod" => $data["paymentmethod"],
                        "amount" => $data["amount"],
                        'comment' => 'Purchase of ' . json_decode(Helpers::settings('recharge_airtime_code'), true)[$data["mobilenetwork"]] . ' airtime for ' . $data["phone"]
                    ]);
                } elseif ($data["paymentmethod"] == 12) {
                    $wallet = new WalletController();
                    $wallet->decrease($user->id, $amount);

                    // Log Matrix Transaction
                    MatrixTransaction::create([
                        "user_id" => $user->id,
                        "entry" => "debit",
                        "paymentmethod" => $data["paymentmethod"],
                        "is_commission" => null,
                        "amount" => $data["amount"],
                        'comment' => 'Purchase of ' . json_decode(Helpers::settings('recharge_airtime_code'), true)[$data["mobilenetwork"]] . ' airtime for ' . $data["phone"]
                    ]);
                } elseif ($data["paymentmethod"] == 13) {
                    $wallet = new WalletController();
                    $wallet->decreaseRecharge($user->id, $amount);

                    // Log Transactions
                    Transaction::create([
                        'user_id' => $user->id,
                        'entry' => 'debit',
                        'paymentmethod' => $data["paymentmethod"],
                        'amount' => $data["amount"],
                        'comment' => 'Purchase of ' . json_decode(Helpers::settings('recharge_airtime_code'), true)[$data["mobilenetwork"]] . ' airtime for ' . $data["phone"]
                    ]);
                }

                $this->handleAirtimePurchase($data, $user);

                return back()->with("message", $amount . " airtime purchased successfully.")->with("alert", "success");
            } else {
                return back()->with("message", "You do not have enough money in your wallet!")->with("alert", "danger");
            }
        } else {
            // Online Payment
            return Paystack::getAuthorizationUrl()->redirectNow();
        }
    }

    public function handleAirtimePurchase($data, $user)
    {
        // Create Record
        Airtime::create([
            'user_id' => $user->id,
            'wallet' => $data["paymentmethod"],
            'amount' => $data["amount"],
            'provider' => $data["mobilenetwork"],
            'phone_number' => $data["phone"]
        ]);

        // Pay airtime commissions
        $referral = new ReferralSystemController();
        $referral->handleAirtimeCommission($user, $data);
    }

    //
}
