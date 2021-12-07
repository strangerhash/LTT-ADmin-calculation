<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class FundWallet extends Model
{
    protected $table = 'recharge_fund_wallet';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'wallet', 'amount',
    ];
}
