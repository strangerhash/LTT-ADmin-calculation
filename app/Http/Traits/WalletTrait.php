<?php

namespace App\Http\Traits;

use App\Wallet;
use Illuminate\Support\Facades\Auth;

trait WalletTrait
{
    public function handeDeduction($amount)
    {
        // Load user model
        $user = Auth::user();

        // Is amount greater than incoming balance
        if ($amount <= $user->wallet->incoming) {
            // amount is less than incoming wallet, deduct from incoming wallet
            $this->decreaseIncoming($user->id, $amount);
        } else {
            // amount is greater than incoming, empty incoming and deduct balance from commission
            $this->decreaseIncoming($user->id, $user->wallet->incoming);
            // calculate balance
            $balance = $amount - $user->wallet->incoming;
            // deduct balance from commission wallet
            $this->decreaseCommission($user->id, $balance);
        }
    }

    /**
     * This increases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param float $amount - Amount increase
     */
    protected function increaseCommission($user_id, $amount)
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
    protected function decreaseCommission($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->balance = $wallet->balance - $amount;
        $wallet->save();
    }

    /**
     * This increases user wallet
     */
    protected function increaseIncoming($user_id, $amount)
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
    protected function decreaseIncoming($user_id, $amount)
    {
        $wallet = Wallet::findOrFail($user_id);
        $wallet->incoming = $wallet->incoming - $amount;
        $wallet->save();
    }
}
