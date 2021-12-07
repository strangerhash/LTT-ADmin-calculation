<?php

namespace App\Http\Controllers\Recharge;

use App\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Unicodeveloper\Paystack\Facades\Paystack;

class FundWalletController extends Controller
{
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

    public function fund(Request $request)
    {
        // Instantiate User
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
                "paymentmethod" => ['required', 'integer'],
                "proofofpayment" => ['required'],
                "password" => ['required', 'min:4'],
                "amount" => ['required']
            ],
            [
                'password.min' => 'Your password must be more than 4 characters',
                'proofofpayment.required' => 'Proof of payment is required.'
            ]
        );

        if ($data["paymentmethod"] == 4) {

            // Online Payment
            return Paystack::getAuthorizationUrl()->redirectNow();
        } else {
            // Bank Authentication

            // Set new file name
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
            }

            // Create record and upload file
            $data = DB::table()->create([
                'user_id' => '',
                'file_name' => $fileName,
                'status' => 0,
                'date_created' => now()
            ]);

            if ($data) {
                $file->move(public_path('posts'), $fileName);
            }
        }

        // Confirm Password
        if (!Hash::check($data["password"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }
    }
}
