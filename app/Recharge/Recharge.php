<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $table = 'recharge';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'is_upgraded', 'wallet', 'date_created'
    ];
}
