<?php

namespace App\Http\Controllers\Recharge;

use App\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TVSubscriptionController extends Controller
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

        // Disable Recharge
        $disable_recharge =  Helpers::settings('disable_recharge');
        if ($disable_recharge == 0) {
            return back()
                ->with('message', '<b>Recharge has been disabled!<b><br/>Please try again.')
                ->with('alert', 'danger');
        }
    }
}
