<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\GraphData;
use App\Matrix;
use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// Custom Imports
use App\Wallet;
use App\Recharge\Recharge;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $matrix_details_controller;

    private $graph;

    public function __construct()
    {
        $this->middleware('guest');
        // $this->graph = new GraphData();
        // if (!$this->graph->isConnected()) {
        //     dd("DB is not running or connection cannot be made.");
        // }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'alpha_dash', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:4', 'confirmed'],
            'referrer' => ['required', 'exists:users,username'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    protected function create(Request $request)
    {
        $data = $request->all();
        
        // Fetch sponsor's id using pin_unigue_value
        if (isset($data['referrer'])) {
            $sponsor = User::where('username', $data['referrer'])->get()->first();
        }

        // Check if the $sponsor is a Matrix Thrift or a Robot
        if ($sponsor->is_matrix_thrift == 1) {
            dd("You cannot use a ROBOT to sponsor");
        }

        if (true) {
            // This registers any user into the system
            $user =  User::create([
                'email' => $data['email'],
                'sponsor_id' => $sponsor->id,
                'username' => strtolower($data['username']),
                'phone' => $data['phone'],
                'password' => Hash::make($data['password'])
            ]);
            Wallet::create(['user_id' => $user->id]);
            Recharge::create(['user_id' => $user->id, 'is_upgraded' => 0, 'date_created' => date('Y-m-d H:i:s')]);
            Mail::to($user)->send(new AccountCreated($user));
            // return $user;
            return view('auth.login2');
        }
    }
}
