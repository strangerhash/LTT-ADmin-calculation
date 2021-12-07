<?php

namespace App\Recharge;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'recharge_commissions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'from_id', 'commission', 'comment', 'date_created'
    ];
}
