<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaystackTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Unicodeveloper\Paystack\Facades\Paystack;

class FundWalletController extends Controller
{
    use PaystackTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Class can only be accessed by the auth middleware
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        // Create record and upload file
        $records = DB::table('fund_wallet')->where('user_id', $user->id)->latest('date_created')->paginate();
        return view('frontend.wallet.fund-wallet', ['records' => $records]);
    }

    public function fund(Request $request)
    {
        // Instantiate User
        $user = Auth::user();

        // Disable Recharge
        // $disable_recharge =  Helpers::settings('disable_recharge');
        // if ($disable_recharge == 0) {
        //     return back()
        //         ->with('message', '<b>Recharge has been disabled!<b><br/>Please try again.')
        //         ->with('alert', 'danger');
        // }

        // Validate Input
        $data = $request->validate(
            [
                "paymentmethod" => ['required', 'integer'],
                "depositors_name" => ['sometimes', 'required_if:paymentmethod,5'],
                "proofofpayment" => ['sometimes', 'required_if:paymentmethod,5', 'image'],
                "password" => ['required', 'min:4'],
                "amount" => ['required', 'numeric'],
                "displayamount" => ['required', 'numeric']
            ],
            [
                'paymentmethod.required' => 'Payment method is required.',
                'paymentmethod.integer' => 'Payment method is should be an integer.',
                'depositors_name.required_if' => 'Despositor\'s name is required',
                'password.min' => 'Your password must be more than 4 characters',
                'proofofpayment.required' => 'Proof of payment is required.',
                'proofofpayment.image' => 'Proof of payment must be an image.',
                'amount.required' => 'Amount is required.',
                'amount.numeric' => 'Amount should be in numbers.',
                'displayamount.required' => 'Amount is required.',
                'displayamount.numeric' => 'Amount should be in numbers.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password cannot be less than 4 characters.'
            ]
        );

        // Confirm Password
        if (!Hash::check($data["password"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }


        // Confirm Amount before passing to paystack
        $realPrice = $request->displayamount;
        $realPrice = ($request->paymentmethod == 4) ? (self::getPaystackCharge($realPrice) + $realPrice) : $realPrice;

        if ((int) $request->amount != (int) ($realPrice * 100)) {
            return back()
                ->with('message', '<b>Invalid amount entered</b>!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Handle Payment
        if ($data["paymentmethod"] == 4) {
            // Online Payment
            return Paystack::getAuthorizationUrl()->redirectNow();
        } else {
            // Bank Authentication
            // Set new file name
            if ($request->hasFile('proofofpayment')) {
                $file = $request->file('proofofpayment');
                $fileName = time() . '.' . strtolower($file->getClientOriginalExtension());
            } else {
                return back()
                    ->with('message', '<b>No proof of payment found.</b>')
                    ->with('alert', 'danger')
                    ->withInput();
            }

            // Get filename with the extension
            $filenameWithExt = $request
                ->file('proofofpayment')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request
                ->file('proofofpayment')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('proofofpayment')
                ->storeAs('public/payments', $fileNameToStore);

            // Create record and upload file
            $data = DB::table('fund_wallet')->insertGetId(
                [
                    'user_id' => $user->id,
                    'amount' => $request->displayamount,
                    'file_name' => $fileNameToStore,
                    'depositor_name' => $request->depositors_name,
                    'verified' => 0, // 0 - Pending
                    'payment_method' => 1, // 1 - Bank Deposit
                    'date_created' => now()
                ]
            );

            return back()
                ->with('message', '<b>Payment awaiting verification</b>')
                ->with('alert', 'info')
                ->withInput();
        }
    }
}
