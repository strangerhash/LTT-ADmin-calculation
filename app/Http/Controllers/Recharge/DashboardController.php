<?php

namespace App\Http\Controllers\Recharge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Recharge\Airtime;
use App\Recharge\Commission;
use App\Recharge\Data;
use App\Recharge\FundWallet;
use App\Recharge\Recharge;
use App\Recharge\Withdrawal;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $referrals = ReferralSystemController::geneologyListForDashboard();
        $commissions = Commission::where('user_id', Auth::id())->latest('date_created')->paginate(5);
        return view('recharge.frontend.dashboard', ['commissions' => $commissions, 'referrals' => $referrals]);
    }

    public function airtime(Request $request)
    {
        return view('recharge.frontend.airtime');
    }

    public function subscription(Request $request)
    {
        return view('recharge.frontend.subscription');
    }

    public function utility(Request $request)
    {
        return view('recharge.frontend.utility');
    }

    public function upgradeVTU(Request $request)
    {
        return view('recharge.frontend.upgrade-vtu');
    }

    public function refreshAccount(Request $request)
    {
        // Credit
        $commission = (float)Commission::where('user_id', Auth::id())->select(DB::raw('SUM(commission) as total'))->first()->total;
        $fund_wallet = (float) FundWallet::where('user_id', Auth::id())->select(DB::raw('SUM(amount) as total'))->first()->total;

        // Debit
        $airtime = (float) Airtime::where('user_id', Auth::id())->where('wallet', 13)->select(DB::raw('SUM(amount) as total'))->first()->total;
        $data = (float) Data::where('user_id', Auth::id())->where('wallet', 13)->select(DB::raw('SUM(amount) as total'))->first()->total;
        $withdrawal = (float) Withdrawal::where('user_id', Auth::id())->where('status', 1)->select(DB::raw('SUM(amount) as total'))->first()->total;

        $new_balance = round((float)(($commission + $fund_wallet) - ($airtime + $data + $withdrawal)), 2, PHP_ROUND_HALF_UP);

        // Update wallet
        $wallet = new WalletController();
        $wallet->updateRecharge(Auth::id(), $new_balance);
        $referralsCount = ReferralSystemController::referrals();

        return response()->json([
            'referrals' => $referralsCount, 'transactions' => '',
            'commission' => (is_null($commission)) ? 0.0 : $commission, 'downlines' => '', 'balance' => $new_balance
        ]);
    }
}
