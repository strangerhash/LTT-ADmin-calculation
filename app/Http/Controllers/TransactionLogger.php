<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHistory;

class TransactionLogger extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * This log matrix credit
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */

    public static function logMatrixCredit($user, $pie_id, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 12,
            'amount' => $amount,
            'entry' => 1,
            'ref' => 0,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }


    /**
     * This log martix debit
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */
    public static function logMatrixDebit($user, $pie_id, $amount, $purpose, $entry = 0)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 12,
            'amount' => $amount,
            'entry' => $entry,
            'ref' => 0,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }


    /**
     * This log PIE credit
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */

     public static function logPIECredit($user, $pie_id, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 11,
            'amount' => $amount,
            'entry' => 1,
            'ref' => 0,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }


    /**
     * This log PIE debit
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */
    public static function logPIEDebit($user, $pie_id, $amount, $purpose, $entry = 0)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 11,
            'amount' => $amount,
            'entry' => $entry,
            'ref' => 0,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }

    public static function logPaystackCredit($user, $pie_id, $ref, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 13,
            'amount' => $amount,
            'entry' => 1,
            'ref' => $ref,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }


    /**
     * This log PIE debit
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */
    public static function logPaystackDebit($user, $pie_id, $ref, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user,
            'pie_id' => $pie_id,
            'wallet' => 13,
            'amount' => $amount,
            'entry' => 0,
            'ref' => $ref,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }
}
