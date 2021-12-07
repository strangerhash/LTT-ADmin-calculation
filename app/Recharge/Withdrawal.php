<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'recharge_withdrawal';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'amount', 'status', 'date_completed'
    ];
}
