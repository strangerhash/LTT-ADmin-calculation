<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FundWallet;
use App\Helpers;
use App\MatrixTransaction;
use App\Wallet;
use App\Withdrawal;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class AdminWalletController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function incomingFunds()
    {
        $incomingFunds = DB::table('fund_wallet')->latest('date_created')->paginate();
        return view('administrator.wallet.incoming', ['records' => $incomingFunds]);
    }
     public function addTransaction()
    {
        // die("dfdfdfd");
       // $incomingFunds = DB::table('fund_wallet')->latest('date_created')->paginate();

        return view('administrator.wallet.add_transaction'); 
    }
    public function outgoingFunds()
    {
        $incomingFunds = Withdrawal::all()->latest('date_created')->paginate();
        return view('administrator.wallet.incoming', ['records' => $incomingFunds]);
    }

    public function incomingFundsApprove($user_id, $id)
    {
        try {
            // Decrypt ID
            $id = Helpers::decodeId($id);
            $user_id = Helpers::decodeId($user_id);

            $user = Auth::guard('admin')->user();

            // Get Fund Request
            $fund_wallet = FundWallet::where('verified', 0)->where('id', $id)->where('payment_method', 1)->where('user_id', $user_id)->first();

            // Fetch User's Wallet
            $wallet = Wallet::findOrFail($fund_wallet->user_id);
            $wallet->incoming = $wallet->incoming + $fund_wallet->amount;
            $wallet->updated_at = now();
            $wallet->save();

            $fund_wallet->verified = 1;
            $fund_wallet->date_updated = now();
            $fund_wallet->save();


            // Credit wallet and debit wallet
            MatrixTransaction::create([
                "user_id" => $fund_wallet->user_id,
                "entry" => "credit",
                "paymentmethod" => 5,
                "is_commission" => null,
                "amount" => $fund_wallet->amount,
                'comment' => 'Wallet Funding'
            ]);

            $incomingFunds = DB::table('fund_wallet')->latest('date_created')->paginate();
            return view('administrator.wallet.incoming', ['records' => $incomingFunds]);
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function incomingFundsDecline($id)
    {
        // Decrypt ID
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $ex) {
            $incomingFunds = DB::table('fund_wallet')->latest('date_created')->paginate();
            return view('administrator.wallet.incoming', ['records' => $incomingFunds]);
        }

        $user = Auth::guard('admin')->user();

        // Get Fund Request
        $fund_wallet = FundWallet::where('verified', 0)->where('id', $id)->where('payment_method', 1)->where('user_id', $user->id)->first();

        $fund_wallet->verified = 2;
        $fund_wallet->date_updated = now();
        $fund_wallet->save();

        $incomingFunds = DB::table('fund_wallet')->latest('date_created')->paginate();
        return view('administrator.wallet.incoming', ['records' => $incomingFunds]);
    }
}
