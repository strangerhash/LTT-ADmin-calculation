<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\GraphData;
use App\User;
use App\Http\Controllers\UserController;

class ResetController extends Controller
{
    private $gDB;

    function __construct()
    {
        $this->gDB = new GraphData();
    }

    public function resetFirstUser()
    {
        DB::table('digital_thrift_transactions')->truncate();
        DB::table('earnings')->truncate();
        DB::table('earning_histories')->truncate();
        DB::table('matrices_')->truncate();
        DB::table('matrix_details')->truncate();
        DB::table('matrix_incentives')->truncate();
        DB::table('matrix_transactions')->truncate();
        DB::table('paystack_transactions')->truncate();
        DB::table('pie_system')->truncate();
        DB::table('pie_transactions')->truncate();
        DB::table('pie_withdrawals')->truncate();
        DB::table('pins')->truncate();
        DB::table('pins')->insert(['batch_number' => 'shdfsfysdf6sdfs6df6sd3sfsdf', 'pin' => 'ISC001', 'pin_unique_value' => 'ISC001']);
        DB::table('recharge')->truncate();
        DB::table('recharge_airtime')->truncate();
        DB::table('recharge_commissions')->truncate();
        DB::table('recharge_data')->truncate();
        DB::table('recharge_fund_wallet')->truncate();
        DB::table('recharge_transactions')->truncate();
        DB::table('recharge_withdrawal')->truncate();
        DB::table('transaction_histories')->truncate();
        DB::table('users')->truncate();
        DB::table('wallets')->truncate();
        DB::table('withdrawals')->truncate();
        DB::table('fund_wallet')->truncate();

        $this->gDB->truncate();
    }
}
