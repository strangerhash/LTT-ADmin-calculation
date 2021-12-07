<?php

namespace App\Http\Controllers;

use App\GraphData;
use App\PIESystem;
use App\TransactionHistory;
use App\Wallet;
use App\Http\Controllers\PIESystemController;
use App\Http\Traits\WalletTrait;
use App\Recharge\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Withdrawal;

class WalletController extends Controller
{
    use WalletTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->graph = new GraphData();
        if (!$this->graph->isConnected()) {
            dd("DB is not running or connection cannot be made.");
        }
    }

    /**
     *
     */
    public function withdrawalRequest(Request $request)
    {
        // Create a User Object
        $user = Auth::user();

        // Validate Input
        $data = $request->validate(
            [
                'amount' => 'bail|required|min:100|numeric',
                'password' => 'bail|required|min:1',
                'pie_account' => 'bail|nullable|integer|exists:p_i_e_system,id|gt:0',
            ],
            [
                'pie_account.exists' => 'PIE account doesn\'t exist!',
                'amount.min' => 'Minimum withdrawal amount is ₦100'
            ]
        );

        // Confirm Password
        if (!Hash::check($data["password"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Confirm Amount
        if ($user->total_wallet_balance < $data["amount"]) {
            return back()
                ->with('message', 'You do not have sufficient money in your wallet!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Create Withdrawal Record
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $data["amount"],
            'status' => 0,
            'account' => 0, //1 for PIE, 0 for Matrix
            'date_created' => now()
        ]);

        return back()
            ->with('message', '<b>Transaction Processing!</b> <br> Withdrawal Request Processing!')
            ->with('alert', 'success')
            ->withInput();
    }

    /**
     * This increases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param float $amount - Amount increase
     */
    public function increase($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->balance = $wallet->balance + $amount;
        $wallet->save();
    }


    /**
     * This decreases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param float $amount - Amount increase
     */
    public function decrease($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->balance = $wallet->balance - $amount;
        $wallet->save();
    }

    /**
     * This increases user PIE wallet
     * @param User $user - User id
     * @param float $amount - Amount increase
     */
    public function increasePIE($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->pie = $wallet->pie + $amount;
        $wallet->save();
    }

    /**
     * This decreases user PIE wallet
     * @param User $user - Instance of User model
     * @param float $amount - Amount increase
     */
    public function decreasePIE($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->pie = $wallet->pie - $amount;
        $wallet->save();
    }

    /**
     * This increases user Recharge wallet
     * @param User $user - User id
     * @param float $amount - Amount increase
     */
    public function increaseRecharge($user_id, $amount)
    {
        $recharge = Recharge::findOrFail($user_id);
        $recharge->wallet = $recharge->wallet + $amount;
        $recharge->save();
    }

    /**
     * This decreases user Recharge wallet
     * @param User $user - Instance of User model
     * @param float $amount - Amount increase
     */
    public function decreaseRecharge($user_id, $amount)
    {
        $recharge = Recharge::findOrFail($user_id);
        $recharge->wallet = $recharge->wallet - $amount;
        $recharge->save();
    }

    /**
     * This update user Recharge wallet
     * @param User $user - Instance of User model
     * @param float $amount - Amount increase
     */
    public function updateRecharge($user_id, $amount)
    {
        $recharge = Recharge::findOrFail($user_id);
        $recharge->wallet = $amount;
        $recharge->save();
    }

    /**
     * Check if this user can make withdrawals
     *
     */
    public static function canWithdraw($current_matrix, $no_of_referrals)
    {
        // Check for Q0 Users
        if ($current_matrix < 3 && $no_of_referrals < 3) {
            return false;
        }

        // Check for Q3 Users
        if ($current_matrix >= 3 && $no_of_referrals < 6) {
            return false;
        }
    }

    /**
     * This increases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param float $amount - Amount increase
     */
    public function increaseIncoming($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->incoming = $wallet->incoming + $amount;
        $wallet->save();
    }


    /**
     * This decreases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param float $amount - Amount increase
     */
    public function decreaseIncoming($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->incoming = $wallet->incoming - $amount;
        $wallet->save();
    }
}
