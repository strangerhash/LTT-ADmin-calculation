<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIEWithdrawal extends Model
{
    protected $table = 'pie_withdrawals';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'pie_id', 'amount', 'status'
    ];
}
