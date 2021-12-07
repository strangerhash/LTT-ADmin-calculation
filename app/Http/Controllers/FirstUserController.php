<?php

namespace App\Http\Controllers;

use App\Earning;
use App\User;
use App\Wallet;
use App\Recharge\Recharge;
use Illuminate\Support\Facades\Hash;
use App\FirstUser;
use App\GraphData;
use App\Http\Controllers\MatrixDetailsController;
use App\Matrix;

class FirstUserController extends Controller
{
    private $matrix_details_controller;

    function __construct()
    {
        $this->matrix_details_controller = new MatrixDetailsController();
    }


    /**
     * First user registration.
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    public function firstUserRegistration()
    {
        // Since the first User has neither sponsor nor parent, set
        // his parent_id to 0 and sponsor_id to 0
        $parent_id = 0;
        $sponsor_id = 0;
        $position = 0;
        $current_matrix = 0;

        $user = User::create([
            'name' => 'First User',
            'pin_unique_value' => 'ISC001',
            'parent_id' => $parent_id,
            'sponsor_id' => $sponsor_id,
            'position' => $position,
            'current_matrix' => $current_matrix,
            'is_upgraded' => 1,
            'is_matrix_thrift' => 0,
            'email' => 'admin@mlm.com',
            'username' => 'admin@mlm.com',
            'password' => Hash::make('#password@34'),
        ]);

        if($user){
            $graph = new GraphData();
            $graph->createData($user);
            Matrix::_createUserMatrix($user);
            Wallet::create(['user_id' => $user->id]);
            Recharge::create(['user_id' => $user->id, 'is_upgraded' => 0, 'date_created' => date('Y-m-d H:i:s') ]);
            $graph->referralCreateData($user);
        }
        dd($user);
    }
}
