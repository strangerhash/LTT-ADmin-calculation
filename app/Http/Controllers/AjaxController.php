<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuorumController;
use App\User;

class AjaxController extends Controller
{
    public function quorumShift()
    {
        $quorum = new QuorumController();
        $quorum->initiateQuorumShift();
        $user = User::findOrFail(Auth::id());
        return response()->json([
            'total_pie' => $user->count_pie_accounts,
            'wallet_balance' => $user->total_wallet_balance,
            'pie_balance' => $user->wallet->pie,
            'matrix_level' => isset($user->matrix_type) ? $user->matrix_type->name : null,
            'total_deposited' => (int)$user->total_deposited,
            'total_earnings' => $user->total_earnings
        ]);
    }
}
