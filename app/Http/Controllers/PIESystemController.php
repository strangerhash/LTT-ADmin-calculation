<?php

namespace App\Http\Controllers;

use App\PIESystem;
use App\User;
use App\TransactionHistory;
use App\Http\Controllers\WalletController;
use App\PIEWithdrawal;
use App\Withdrawal;
use App\Wallet;
use App\Helpers;
use App\Http\Traits\WalletTrait;
use App\MatrixTransaction;
use App\PIETransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\json_encode;

class PIESystemController extends Controller
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
    }

    public function create(Request $request)
    {
        // Instantiate User
        $user = Auth::user();

        // Disable PIE Purchase
        $disable_pie_purchase =  Helpers::settings('disable_pie_purchase');
        if ($disable_pie_purchase == 0) {
            return back()
                ->with('message', '<b>LTT purchase has been disabled!<b><br/>Please try again.')
                ->with('alert', 'danger');
        }

        // Get price for one PIE Unit
        $price_of_a_pie_unit = Helpers::settings('pie_price_ordinary');

        // If User is in Q0 send back
        if ($user->current_matrix < 1) {
            return back()
                ->with('message', '<b>You have to be in Quorum 1 to purchase LTT!<b><br/>Please try again.')
                ->with('alert', 'danger');
        }

        // Validate Input
        $data = $request->validate(
            [
                "numberofpieunits" => ['required', 'integer', 'min:1'],
                "paymentmethod" => ['required', 'integer'],
                "userpassword" => ['required', 'min:4'],
                "amount" => ['required'],
            ],
            [
                'numberofpieunits.integer' => 'Number of LTT Units has to be a number between 0-9!',
                'numberofpieunits.min' => 'You cannot purchase 0 LLT Units!',
                'amount.required' => 'Amount is required!',
            ]
        );

        // Confirm Amount before passing to paystack
        $realPrice = $request->numberofpieunits * $price_of_a_pie_unit;

        if ($realPrice != $request->amount) {
            return back()
                ->with('message', '<b>Invalid amount entered</b>!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Make sure user cannot buy more than 1000LTT
        $result = PIESystem::where('user_id', $user->id)->select(DB::raw('SUM(no_of_pie) as total_pie'))->first()->total_pie;
        if (($result + $request->numberofpieunits) > 1000) {
            return back()
                ->with('message', '<b>You cannot purchase more that 1000 LTT Units</b>!')
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



        // Check if user messed with input field
        if ((int) $data["paymentmethod"] == 11) {

            // Perform Deduction
            $this->handeDeduction($realPrice);

            // Create LTT accounts
            $actualAmount = $data['numberofpieunits'] * 1000; //Replace with DB Value
            $this->createPIEAccount($user->id, $actualAmount, $data['numberofpieunits'], "purchased");

            // Log Transaction
            MatrixTransaction::create([
                "user_id" => $user->id,
                "entry" => "debit",
                "paymentmethod" => 6,
                "is_commission" => null,
                "amount" => $realPrice,
                'comment' => 'Purchase of ' . $data['numberofpieunits']  . ' LTT units'
            ]);

            return back()->with("message", "Transaction Successfully!<br>" . $data["numberofpieunits"] . " LTT Units purchased successfully.")->with("alert", "success");
        } else { // Return Error
            return back()
                ->with('message', 'Something went wrong with your payment!')
                ->with('alert', 'danger')
                ->withInput();
        }
    }

    /**
     * This closes the PIE account
     */
    public function withdrawAll($account_id)
    {
        // Check if id belongs to this user
        $pie = PIESystem::where(['user_id' => Auth::user()->id, 'id' => $account_id])->firstOrFail();

        // check if pie is over 6 months old
        $effective_date = date('Y-m-d', strtotime("+6 months", strtotime($pie->start_date)));

        // If today's date is greater than $effective_date
        // User can withdraw all
        if (date('Y-m-d') < $effective_date) {
            return back()->with("message", "PIE must have grown for atleast 6 months before it can be closed")->with("alert", "danger");
        } else {
            return back()->with("message", "Request to close PIE account is processing")->with("alert", "danger");
        }
    }

    /** */
    public function createPIEAccount($user_id, $amount, $no_of_pie, $track)
    {
        $end_date = $this->calculate_end_date();
        $start_date = date('Y-m-d');

        $pie = new PIESystem;

        $pie->user_id = $user_id;
        $pie->amount = $amount;
        $pie->no_of_pie = $no_of_pie;
        $pie->track = $track;
        $pie->start_date = $start_date;
        $pie->end_date = $end_date;
        $pie->withdraw_date = null;
        $pie->amount_withdrawn = 0.0;
        $pie->save();

        return $pie;
    }

    /**
     * This calculate the current earning of this user
     * as of today
     *
     * @param DateTime $start_date
     * @param DateTime $user_end_date
     * @return float $amount_eaned
     */
    public function calculate_current_earning($start_date, $user_end_date, $user_date_closed, $amount)
    {
        $today = date('Y-m-d');

        // If date's up?
        // if ($today == $user_end_date) {
        //     return $this->compound_interest($amount);
        // }

        $start_date = strtotime($start_date);
        $end_date = ($user_date_closed == null) ? strtotime(date('Y-m-d')) : strtotime($user_date_closed);

        $days = ($end_date - $start_date) / 60 / 60 / 24;

        return $this->handle_current_earning_calculation($days, $amount);
    }

    /** */
    public function calculate_end_date()
    {
        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string("1095 days"));
        return date_format($date, "Y-m-d");
    }

    /** */
    private function handle_current_earning_calculation($days, $amount)
    {
        // Calculate daily interest
        $daily_interest = $this->compound_interest($amount) / 1095;
        return $daily_interest * (int) $days;
    }

    private function compound_interest($amount)
    {
        // Compound Interest
        // A = P (1 + r/n) (nt)
        // A = the future value of the investment/loan, including interest
        // P = the principal investment amount (the initial deposit or loan amount)
        // r = the annual interest rate (decimal)
        // n = the number of times that interest is compounded per unit t
        // t = the time the money is invested or borrowed for
        return $amount * ((1 + 0.3 / 1)) ** (1 * 3);
    }


    /**
     * This decreases user wallet
     * @param User $user - Instance of User model
     * @param int $pie_id - ID pf PIE account
     * @param int $wallet - 0 - Matrix Account or 1 - PIE Account
     * @param float $amount - Amount increase
     * @param int $ref - 0 - Pie trans or 1 - Matrix trans
     * @param string $purpose - Why is the transaction
     * @param int $status  - 0 - Processing, 1 - Approved, 2 - Cancelled
     */
    public function decrease($user, $pie_id, $wallet, $amount, $ref, $purpose, $status)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user->id,
            'pie_id' => $pie_id,
            'wallet' => $wallet,
            'amount' => $amount,
            'entry' => 0,
            'ref' => $ref,
            'purpose' => $purpose,
            'status' => $status,
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
    public static function logPIECredit($user, $pie_id, $wallet, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user->id,
            'pie_id' => $pie_id,
            'wallet' => $wallet,
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
    public static function logPIEDebit($user, $pie_id, $wallet, $amount, $purpose)
    {
        // Create a Transaction History
        TransactionHistory::create([
            'user_id' => $user->id,
            'pie_id' => $pie_id,
            'wallet' => $wallet,
            'amount' => $amount,
            'entry' => 0,
            'ref' => 0,
            'purpose' => $purpose,
            'status' => 1,
            'date_created' => date('Y-m-d H:i:s'),
            'date_completed' => date('Y-m-d H:i:s')
        ]);
    }

    public function withdraw(Request $request)
    {
        // Create a User Object
        $user = Auth::user();

        // Validate Input
        $data = $request->validate(
            [
                'amount' => 'required|min:100|numeric',
                'password' => 'required|min:1',
            ],
            [
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

        // Insufficient balance
        if ($user->wallet->pie < $data["amount"]) {
            return back()
                ->with('message', 'You do not have sufficient money in your PIE account!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Create Withdrawal Record
        PIEWithdrawal::create([
            'user_id' => $user->id,
            'pie_id' => null,
            'amount' => $data["amount"],
            'status' => 0,
        ]);

        return back()
            ->with('message', '<b>Transaction Processing!</b> <br> Withdrawal Request Processing!')
            ->with('alert', 'success')
            ->withInput();
    }

    public function transferFromPIEAccount(Request $request)
    {
        // Create a User Object
        $user = Auth::user();

        // Validate Input
        $data = $request->validate(
            [
                'amount' => 'required|min:100|numeric',
                'password' => 'required|min:1',
                'pie_account' => 'nullable|integer|exists:pie_system,id|gt:0',
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

        // Check if value for pie_account is provided
        if (isset($data["pie_account"])) {

            // Confirm PIE account balance
            $pie_id = $data["pie_account"];
            $pie = PIESystem::findOrFail($pie_id);

            // PIE Account must be 6 months old
            $date_created = $pie->start_date;
            if (time() < strtotime($date_created . ' +6 months')) {
                return back()
                    ->with('message', 'LTT must be 6 months old before withdrawal.')
                    ->with('alert', 'danger')
                    ->withInput();
            }

            // Insufficient balance
            if ($pie->current_earning < $data["amount"]) {
                return back()
                    ->with('message', 'You do not have sufficient money in this PIE account!')
                    ->with('alert', 'danger')
                    ->withInput();
            }

            // Increase wallet account
            $this->increaseCommission($user->id, $data["amount"]);

            // Log Transaction
            MatrixTransaction::create([
                "user_id" => $user->id,
                "entry" => "credit",
                "paymentmethod" => 6,
                "amount" => $data["amount"],
                "is_commission" => 1,
                'comment' => 'Withdrawal from LLT Account'
            ]);

            PIEWithdrawal::create([
                'user_id' => $user->id,
                'amount' => $data["amount"],
                'pie_id' => $data["pie_account"],
                'status' => 1
            ]);

            return back()
                ->with('message', '<b>Transaction Successful!</b> <br> Withdrawal Request Completed!')
                ->with('alert', 'success')
                ->withInput();
        } else { // No PIE Account selected
            return back()
                ->with('message', '<b>Something went wrong with your request!</b> <br> Please try again or contact the administrator!')
                ->with('alert', 'danger')
                ->withInput();
        }
    }
}
