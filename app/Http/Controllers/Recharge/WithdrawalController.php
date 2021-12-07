<?php

namespace App\Http\Controllers\Recharge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Recharge\ReferralSystemController;
use App\Recharge\Airtime;
use App\Recharge\Transaction;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Helpers;
use App\Recharge\Data;
use App\Recharge\Withdrawal;
use Unicodeveloper\Paystack\Facades\Paystack;

class WithdrawalController extends Controller
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

    public function withdraw(Request $request)
    {
        // Instantaiate User
        $user = Auth::user();

        // Validate Input
        $data = $request->validate(
            [
                "amount" => ['integer', 'required', 'min:100'],
                "password" => ['required'],
            ],
            [
                'amount.min' => '#100 is the minimum amount for withdrawal.',
            ]
        );


        // Confirm Password
        if (!Hash::check($data["password"], $user->password)) {
            return back()
                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')
                ->with('alert', 'danger')
                ->withInput();
        }

        // Create Withdrawal Record
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $data["amount"],
            'status' => 0,
            'date_completed' => null
        ]);

        return back()
            ->with('message', '<b>Transaction Processing!</b> <br> Withdrawal Request Processing!')
            ->with('alert', 'success')
            ->withInput();
    }
}
