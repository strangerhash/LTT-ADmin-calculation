<?php
namespace App\Http\Controllers;
use App\Earning;

use App\Matrix;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Custom Imports

use App\Http\Controllers\PinController;

use App\Http\Controllers\MatrixController;

use App\Http\Controllers\MatrixDetailsController;

use App\Http\Controllers\PaystackController;

use App\Recharge\Recharge;

use App\MatrixDetail;

use App\Wallet;

use App\User;

use App\GraphData;

use App\Pin;

use Auth;

use Illuminate\Support\Facades\Hash;

use Unicodeveloper\Paystack\Facades\Paystack;

use App\Helpers;

use App\Mail\AccountUpgrade;

use App\Traits\PaystackTrait;

use Illuminate\Support\Facades\Auth as FacadesAuth;

use Illuminate\Support\Facades\Mail;



class UserController extends Controller

{

    use PaystackTrait;

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

        $this->matrix_details_controller = new MatrixDetailsController();

        $this->graph = new GraphData();

        if (!$this->graph->isConnected()) {

            dd("DB is not running or connection cannot be made.");

        }

    }



    /**

     * Upgrade User into Matrix

     */

    


    /** */

    public function profileUpdate(Request $request)

    {
        die("fdfdfdfdfd");

        // Create a User Object

        $user = Auth::user();



        // Validate Input

        $data = $request->validate(

            [

                "userfirstname" => ['required'],

                "userlastname" => ['required'],

                "usergender" => ['string', 'max:1'],

                "useraccountname" => ['string', 'max:255'],

                "useraccountnumber" => ['numeric', 'min:7'],

                "userbankid" => ['numeric'],

                "userpassword" => ['required', 'min:4'],

                "dob" => ['required', 'date']

            ],

            [

                'userfirstname.required' => 'First name is required',

                'userlastname.required' => 'Last name is required',

                'usergender.string' => 'Gender should be alphabeths',

                'usergender.max' => 'Gender cannot be nore than 1 character',

                'useraccountname.max' => 'Account name cannot exceed 255 characters!',

                'useraccountname.string' => 'Account name can only contain alphabeth!',

                'useraccountnumber.numeric' => 'Your account number should be numbers!',

                'useraccountnumber.min' => 'Account number cannot be less than 7!',

                'userbankid.numeric' => 'Bank id must be numbers',

                'userpassword.required' => 'Password is required',

                'dob.required' => 'Date of birth is required',

                'dob.date' => 'Date of birth is should be in date format',

            ]

        );



        // Confirm Password

        if (!Hash::check($data["userpassword"], $user->password)) {

            return back()

                ->with('message', '<b>User authorization error</b><br>Password is incorrect!')

                ->with('alert', 'danger')

                ->withInput();

        }



        // Validate Bank and Account Number

        $fname = $data["userfirstname"];

        $lname = $data["userlastname"];



        if ($user = User::where('account_number', $data["useraccountnumber"])->where('bank_code', $data["userbankid"])->where('account_name', 'LIKE', "%{$fname}%")->where('account_name', 'LIKE', "%{$lname}%")->first()) {

            return back()

                ->with('message', '<b>Account details already exist.')

                ->with('alert', 'danger')

                ->withInput();

        }



        // Bank Details is unique the verify bank details

        if (Auth::user()->account_number == "") {

            // Verify Account BVN

            $p = new PaystackController();



            //        /*

            $res = $p->resolveAccountNumber($data["useraccountnumber"], $data["userbankid"]);



            if ($res == null) {

                return back()

                    ->with('message', '<b>Account name or Account number could not be verified.<br>Please confirm and try again!</b>')

                    ->with('alert', 'danger')

                    ->withInput();

            }



            $paystk_account_name = strtolower($res->account_name);

            $paystk_account_number = strtolower($res->account_number);



            if (strpos($paystk_account_name, strtolower($data["userfirstname"])) !== false && strpos($paystk_account_name, strtolower($data["userlastname"])) !== false) {



                if ($paystk_account_number == $data["useraccountnumber"]) {

                    //        */

                    $user = User::find(Auth::user()->id);



                    $user->name = $data["userfirstname"] . ' ' . $data["userlastname"];

                    $user->fname = $data["userfirstname"];

                    $user->lname = $data["userlastname"];

                    $user->gender = $data["usergender"];

                    $user->account_name = $data["useraccountname"];

                    $user->account_number = $data["useraccountnumber"];

                    $user->dob = $request->dob;

                    $user->account_bvn = '';

                    $user->bank_code = $data["userbankid"];

                    $user->gender = $data["usergender"];

                    $user->dob = $request->dob;

                    $user->save();



                    return redirect()->route('dashboard')

                        ->with('message', 'User profile updated successfully!')

                        ->with('alert', 'success');



                    //        /*

                } else {

                    return back()

                        ->with('message', '<b>Account number doesn\'t match the account name!</b>')

                        ->with('alert', 'danger')

                        ->withInput();

                }

            } else {

                return back()

                    ->with('message', '<b>Account name doesn\'t match account number!</b>')

                    ->with('alert', 'danger')

                    ->withInput();

            }

        } else {

            $user = User::find(Auth::user()->id);



            $user->gender = $data["usergender"];

            $user->dob = $request->dob;

            $user->gender = $data["usergender"];

            $user->save();



            return redirect()->route('dashboard')

                ->with('message', 'User profile updated successfully!')

                ->with('alert', 'success');

        }

    }

}

