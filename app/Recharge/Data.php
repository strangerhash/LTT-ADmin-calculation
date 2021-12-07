<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'recharge_data';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'amount', 'provider', 'plan', 'phone_number', 'wallet', 'date_created'
    ];
}
