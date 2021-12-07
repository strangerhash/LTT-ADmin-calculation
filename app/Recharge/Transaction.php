<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'recharge_transactions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'entry', 'paymentmethod', 'amount', 'comment', 'date_created'
    ];
}
