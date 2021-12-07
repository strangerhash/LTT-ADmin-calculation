<?php

namespace App\Http\Controllers;

use App\DigitalThriftTransaction;
use App\MatrixThrift;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\GraphData;
use App\Wallet;
use App\Helpers;
use App\Http\Traits\WalletTrait;
use App\MatrixTransaction;
use App\PIETransaction;
use Illuminate\Support\Facades\Hash;


class MatrixThriftController extends Controller
{
    use WalletTrait;

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

    /**
     * Create a new user instance after a valid registration.
     */
    public function create(Request $request)
    {
        $daily_limit = Helpers::settings('mt_daily_limit');
        $mt_pack_price = Helpers::settings('mt_price');
        $user = Auth::user();
        set_time_limit(0);


        // Disable STT Purchase
        $disable_stt_purchase =  Helpers::settings('disable_stt_purchase');
        if ($disable_stt_purchase == 0) {
            return back()
                ->with('message', '<b>STT purchase has been disabled!<b><br/>Please try again.')
                ->with('alert', 'danger');
        }

        // Validate Input
        $data = $request->validate(
            [
                "quantity" => ['required', 'integer', 'min:1', 'max:2'],
                "paymentmethod" => ['required', 'integer'],
                "userpassword" => ['required', 'min:4'],
                "amount" => ['required']
            ],
            [
                'quantity.integer' => 'Number of STT packs has to be a number between 1 and 2',
                'quantity.min' => 'You cannot purchase 0 STT unit!'
            ]
        );

        // Confirm Amount before passing to wallet
        $realPrice = $request->quantity * $mt_pack_price;

        if ($realPrice != $request->amount) {
            return back()
                ->with('message', '<b>Invalid amount entered</b>!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Check fir insufficient balance
        if ($request->amount > $user->total_wallet_balance) {
            return back()
                ->with('message', '<b>Insufficient balance</b>!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Confirm Password
        if (!Hash::check($data["userpassword"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Check daily limit
        $no_of_mtpacks_today = DigitalThriftTransaction::where('user_id', Auth::id())->whereDate('date_created', date("Y-m-d"))->sum('quantity');

        if (((int) $no_of_mtpacks_today + (int) $request->quantity) > (int) $daily_limit) {
            return back()->with("message", "You have exceeded the daily STT units limit!")->with("alert", "danger");
        }

        // Check if user messed with input field
        if ((int) $data["paymentmethod"] == 11) {

            // Perform Deduction
            $this->handeDeduction($realPrice);

            // Log Transaction
            MatrixTransaction::create([
                "user_id" => $user->id,
                "entry" => "debit",
                "paymentmethod" => 6,
                "is_commission" => null,
                "amount" => $realPrice,
                'comment' => 'Purchase of ' . $data["quantity"]  . ' STT units'
            ]);

            // Log DigitalThriftTransaction
            DigitalThriftTransaction::create([
                "user_id" => $user->id,
                "amount" => $data["amount"],
                "quantity" => $data["quantity"],
                "paymentmethod" => 6
            ]);

            // startMatrixThriftPurchase
            $this->startMatrixThriftPurchase($data["quantity"]);
            return back()->with("message", $data["quantity"] . " Short Term Thrift(s) purchased successfully.")->with("alert", "success");
        } else { // Return Error
            return back()
                ->with('message', 'Something went wrong with your payment!')
                ->with('alert', 'danger')
                ->withInput();
        }
    }

    public function startMatrixThriftPurchase($quantity)
    {
        for ($i = 0; $i < $quantity; $i++) {
            $this->handleCreateMTPack();
        }
    }

    public function handleCreateMTPack()
    {
        $owner = Auth::user();
        $no_of_matrix_thrift = MatrixThrift::count($owner->id);
        $next_matrix_thrift = $no_of_matrix_thrift + 1;

        // User Owner Information for Matrix Thrift
        $user = User::create([
            'name' => Auth::user()->username . "_" . $next_matrix_thrift,
            'username' => Auth::user()->username . "_" . $next_matrix_thrift,
            'pin_unique_value' => null,
            'parent_id' => null,
            'sponsor_id' => $owner->id,
            'position' => null,
            'current_matrix' => null,
            'is_matrix_thrift' => $owner->id,
            'email' => str_replace('', '_', strtolower(Auth::user()->username)) . $next_matrix_thrift . '@iscubenetworks.com',
            'password' => 'disabled',
            'fname' => "STT: " . Auth::user()->fname . "_" . $next_matrix_thrift,
            'lname' => "STT:" . Auth::user()->lname . "_" . $next_matrix_thrift
        ]);
        Wallet::create(['user_id' => $user->id]);

        $this->upgrade($user);
    }

    /**
     * Upgrade Matrix Thrift
     * Upgrade User into Matrix
     */
    private function upgrade($user)
    {
        // Load Sponsor Details
        $sponsor = User::findOrFail($user->sponsor_id);

        // Perform Upgrade Operation
        $userController = new UserController();
        $userController->doUpgrade($sponsor, $user);
    }

    /**
     * This is only used when the Matrix Thrift/Robot has completed Q0
     * And this action transfers earning to owner
     * @param int $user_id
     */
    public function disableMatrixThrift($user)
    {
        // Set the value of is_thrift_completed to one
        $user->is_thrift_completed = 1;
        $user->save();
    }

    /**
     * This trasnfer the earning from the Matrix Thrift to it's owner
     */
    public function transferMatrixThriftEarningToOwner($user)
    {
        $owner_id = $user->is_matrix_thrift;
        $balance = $user->wallet->balance;
        $this->decreaseCommission($user->id, $balance);

        $owner = User::findOrFail($owner_id);
        $this->increaseCommission($owner->id, $balance);

        // Credit Owner wallet
        MatrixTransaction::create([
            "user_id" => $owner->id,
            "entry" => "credit",
            "paymentmethod" => 6,
            "is_commission" => 1,
            "amount" => $balance,
            'comment' => 'Completed Thrift for ' . $user->username
        ]);
    }
}
