<?php

namespace App\Http\Controllers\Recharge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GraphData;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Recharge\Commission;
use App\Recharge\Recharge;
use App\Helpers;
use App\Http\Controllers\WalletController;
use App\Mail\VtuUpgrade;
use App\MatrixTransaction;
use App\PIETransaction;
use App\Recharge\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ReferralSystemController extends Controller
{
    private $graph;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Class can only be accessed by the auth middleware
        $this->middleware('auth');
        $this->graph = new GraphData();
        if (!$this->graph->isConnected()) {
            dd("DB is not running or connection cannot be made.");
        }
    }

    public function upgradeVTU(Request $request)
    {
        // Initialize User
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
                "amount" => ['integer', 'required'],
                "password" => ['required'],
            ],
            [
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

        $recharge_account = Recharge::where('user_id', $user->id)->first();

        // Validate Amount
        $system_amount = (float) Helpers::settings('recharge_upgrade_amount');

        if ($request["amount"] != $system_amount) {
            return back()
                ->with('message', '<b>Something went wrong with your request.</b><br>Please try again later!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Check if account is upgraded
        if ($recharge_account->is_upgraded == 1) {
            return back()->with("message", "Account has already been upgraded")->with("alert", "info");
        }

        // Account Balance
        $balance = 0.0;

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

        // If user has enough money
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
                    'comment' => 'Upgrade to VTU'
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
                    'comment' => 'Upgrade to VTU'
                ]);

                // Log Wallet Transaction
            } elseif ($data["paymentmethod"] == 13) {
                $wallet = new WalletController();
                $wallet->decreaseRecharge($user->id, $amount);

                // Log Transactions
                Transaction::create([
                    'user_id' => $user->id,
                    'entry' => 'debit',
                    'paymentmethod' => $data["paymentmethod"],
                    'amount' => $data["amount"],
                    'comment' => 'Upgrade to VTU'
                ]);
            }

            // Perform Upgrade Operation
            $this->handleUpgradeVTU($user);

            return back()->with("message", "Upgrade to VTU successful")->with("alert", "success");
        } else {
            return back()->with("message", "You do not have enough money in your wallet!")->with("alert", "danger");
        }
    }

    public function handleUpgradeVTU($user)
    {
        $this->graph->referralCreateData(Auth::user());
        $this->graph->referralCreateRelationship(Auth::user());

        // Set user recharge account to upgraded
        Recharge::where('user_id', $user->id)->update(['is_upgraded' => 1]);

        // Handle Upgrade Commission
        $this->handleUpgradeCommission($user);

        // Send Mail
        Mail::to($user)->send(new VtuUpgrade($user));
    }

    public function handleAirtimeCommission($user, $data)
    {
        $uplines = [];
        $recharge_airtime_level_0 = Helpers::settings('recharge_airtime_level_0');
        $recharge_airtime_level_1 = Helpers::settings('recharge_airtime_level_1');
        $recharge_airtime_level_2 = Helpers::settings('recharge_airtime_level_2');
        $recharge_airtime_code = json_decode(Helpers::settings('recharge_airtime_code'), true);
        $recharge_airtime = [$recharge_airtime_level_1, $recharge_airtime_level_2];
        $recharge_amount = $data["amount"];
        $recharge_mobilenetwork = $data["mobilenetwork"];

        $records = $this->graph->referralGetUplines($user->id);

        foreach ($records as $record) {
            array_push($uplines, $record->value("user_id"));
        }

        //Pay Commission to this user
        Commission::create([
            'user_id' => $user->id,
            'from_id' => $user->id,
            'commission' => (float) (($recharge_airtime_level_0 / 100) * $recharge_amount),
            'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' airtime bought for ' . $data["phone"]
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'entry' => 'credit',
            'paymentmethod' => 13,
            'amount' => (float) (($recharge_airtime_level_0 / 100) * $recharge_amount),
            'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' airtime bought for ' . $data["phone"]
        ]);

        // Pay Uplines
        if (count($uplines) > 0) {
            for ($i = 0; $i < count($uplines); $i++) {
                //Pay Commission to Uplines
                Commission::create([
                    'user_id' => $uplines[$i],
                    'from_id' => $user->id,
                    'commission' => (float) (($recharge_airtime[$i] / 100) * $recharge_amount),
                    'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' airtime by ' . $user->username
                ]);

                Transaction::create([
                    'user_id' => $uplines[$i],
                    'entry' => 'credit',
                    'paymentmethod' => 13,
                    'amount' => (float) (($recharge_airtime[$i] / 100) * $recharge_amount),
                    'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' airtime by ' . $user->username,
                ]);
            }
        }
    }

    public function handleUpgradeCommission($user)
    {
        $uplines = [];
        $recharge_upgrade_amount = Helpers::settings('recharge_upgrade_amount');
        $recharge_upgrade_level_0 = Helpers::settings('recharge_upgrade_level_0');
        $recharge_upgrade_level_1 = Helpers::settings('recharge_upgrade_level_1');
        $recharge_upgrade_level_2 = Helpers::settings('recharge_upgrade_level_2');
        $recharge_upgrade = [$recharge_upgrade_level_1, $recharge_upgrade_level_2];

        $records = $this->graph->referralGetUplines($user->id);

        foreach ($records as $record) {
            array_push($uplines, $record->value("user_id"));
        }

        //Pay Commission to this user
        Commission::create([
            'user_id' => $user->id,
            'from_id' => $user->id,
            'commission' => (float) (($recharge_upgrade_level_0 / 100) * $recharge_upgrade_amount),
            'comment' => 'Commission for account upgrade to VTU',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'entry' => 'credit',
            'paymentmethod' => 13,
            'amount' => (float) (($recharge_upgrade_level_0 / 100) * $recharge_upgrade_amount),
            'comment' => 'Commission for account upgrade to VTU',
        ]);

        // Pay Uplines
        if (count($uplines) > 0) {
            for ($i = 0; $i < count($uplines); $i++) {
                //Pay Commission to Uplines
                Commission::create([
                    'user_id' => $uplines[$i],
                    'from_id' => $user->id,
                    'commission' => (float) (($recharge_upgrade[$i] / 100) * $recharge_upgrade_amount),
                    'comment' => 'Commission for account upgrade to VTU by ' . $user->username
                ]);

                Transaction::create([
                    'user_id' => $uplines[$i],
                    'entry' => 'credit',
                    'paymentmethod' => 13,
                    'amount' => (float) (($recharge_upgrade[$i] / 100) * $recharge_upgrade_amount),
                    'comment' => 'Commission for account upgrade to VTU by ' . $user->username,
                ]);
            }
        }
    }

    public function handleDataCommission($user, $data)
    {
        $uplines = [];
        $recharge_data_level_0 = Helpers::settings('recharge_data_level_0');
        $recharge_data_level_1 = Helpers::settings('recharge_data_level_1');
        $recharge_data_level_2 = Helpers::settings('recharge_data_level_2');
        $recharge_data = [$recharge_data_level_1, $recharge_data_level_2];
        $recharge_airtime_code = json_decode(Helpers::settings('recharge_airtime_code'), true);
        $recharge_amount = $data["amount"];
        $recharge_mobilenetwork = $data["mobilenetwork"];

        $records = $this->graph->referralGetUplines($user->id);

        foreach ($records as $record) {
            array_push($uplines, $record->value("user_id"));
        }

        //Pay Commission to this user
        Commission::create([
            'user_id' => $user->id,
            'from_id' => $user->id,
            'commission' => (float) (($recharge_data_level_0 / 100) * $recharge_amount),
            'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' ' . json_decode(Helpers::settings('recharge_data_plans'), true)[(int) $data["dataplan"] - 1]["desc"] . ' data bought for ' . $data["phone"]
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'entry' => 'credit',
            'paymentmethod' => 13,
            'amount' => (float) (($recharge_data_level_0 / 100) * $recharge_amount),
            'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' ' . json_decode(Helpers::settings('recharge_data_plans'), true)[(int) $data["dataplan"] - 1]["desc"] . ' data bought for ' . $data["phone"]
        ]);

        // Pay Uplines
        if (count($uplines)) {
            for ($i = 0; $i < count($uplines); $i++) {

                //Pay Commission to Uplines
                Commission::create([
                    'user_id' => $uplines[$i],
                    'from_id' => $user->id,
                    'commission' => (float) (($recharge_data[$i] / 100) * $recharge_amount),
                    'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' ' . json_decode(Helpers::settings('recharge_data_plans'), true)[(int) $data["dataplan"] - 1]["desc"] . ' data bought by ' . $user->username
                ]);

                Transaction::create([
                    'user_id' => $uplines[$i],
                    'entry' => 'credit',
                    'paymentmethod' => 13,
                    'amount' => (float) (($recharge_data[$i] / 100) * $recharge_amount),
                    'comment' => 'Commission for ' . $recharge_airtime_code[$recharge_mobilenetwork] . ' ' . json_decode(Helpers::settings('recharge_data_plans'), true)[(int) $data["dataplan"] - 1]["desc"] . ' data bought by ' . $user->username
                ]);
            }
        }
    }

    public static function geneologyTree()
    {
        $users = [];

        $graph = new GraphData();
        $records = $graph->referralGetUsersAtLevel(Auth::id());

        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::find($users);

        $arr = [];

        foreach ($users as $key => $user) {
            $user_name = ($user->lname == "") ? $user->fname : $user->fname . " " . $user->lname;
            if ($key == 0)
                array_push($arr, ['id' => $user->id, 'Full Name' => $user_name, 'Username' => $user->username, 'Phone Number' => $user->phone]);
            else
                array_push($arr, ['id' => $user->id, 'pid' => $user->sponsor_id, 'Full Name' => $user_name, 'Username' => $user->username, 'Phone Number' => $user->phone]);
        }

        return json_encode($arr);
    }


    public static function geneologyList()
    {
        $users = [];

        $graph = new GraphData();
        $records = $graph->referralGetUsersAtLevel(Auth::id());

        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::with(['recharge'])->paginate(15)->find($users);
        return $users;
    }

    public static function geneologyListForDashboard()
    {
        $users = [];

        $graph = new GraphData();
        $records = $graph->referralGetUsersAtLevelForDashboard(Auth::id());

        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::with(['recharge'])->paginate(15)->find($users);
        return $users;
    }

    public static function downlines()
    {
        $graph = new GraphData();
        $record = $graph->getUserDownlines(Auth::id());
        return $record->value("count");
    }

    public static function referrals()
    {
        $users = [];

        $graph = new GraphData();
        $records = $graph->referralGetUsersAtLevelForDashboard(Auth::id());

        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }

        return count($users);
    }
}
