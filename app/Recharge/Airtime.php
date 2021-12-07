<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    protected $table = 'recharge_airtime';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'wallet', 'amount', 'provider', 'phone_number', 'date_created'
    ];
}





class Electricity extends Model
{
    //
}

class TVSubscription extends Model
{
    //
}

