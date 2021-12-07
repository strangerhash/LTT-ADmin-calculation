<?php

namespace App\Http\Controllers;

use App\Earning;
use App\EarningHistory;
use App\Wallet;
use App\Http\Controllers\WalletController;
use App\MatrixTransaction;
use App\TransactionHistory;


class EarningController extends Controller
{
    //
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
     *
     * @param $user User model instance
     */
    public function doSTTEarnings($user, $days)
    {
        // Pay
        if ($days == 30) {
            $amount = 5000.0;
        } elseif ($days == 90) {
            $amount = 4200.0;
        } else {
            return;
         }


        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Short Term Thrift completed.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /**
     *
     * @param $user User model instance
     */
    public function doQ0Earnings($user)
    {
        // At the End of Q0, User gets paid #4000 as PIE and 1000 as cash
        // Sponsor gets #1000 ONLY as PIE
        // Pay User
        $amount = 1000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Intro to Quorum 1 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ1Earnings($user)
    {
        // At the End of Q1, User gets paid #10000
        $amount = 10000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 1 to Quorum 2 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ2Earnings($user)
    {
        // At the End of Q2, User gets paid #10000 at PIE and 1200 as cash
        $amount = 20000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 2 to Quorum 3 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ3Earnings($user)
    {
        // At the End of Q3, User gets paid #10000 at PIE and 1200 as cash
        $amount = 40000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 3 to Quorum 4 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ4Earnings($user)
    {
        // At the End of Q1, User gets paid #10000 at PIE and 1200 as cash
        $amount = 80000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 4 to Quorum 5 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ5_1Earnings($user)
    {
        // At the End of Q1, User gets paid #10000 at PIE and 1200 as cash
        $amount = 1000000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 5 Level 2 earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }

    /** */
    public function doQ5_2Earnings($user)
    {
        // At the End of Q1, User gets paid #10000 at PIE and 1200 as cash
        $amount = 1500000.0;

        // Log Matrix Transaction
        MatrixTransaction::create([
            "user_id" => $user->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $amount,
            'comment' => 'Quorum 5 complete earning.'
        ]);

        $wallet = new WalletController();
        $wallet->increase($user->id, $amount);
    }
}
