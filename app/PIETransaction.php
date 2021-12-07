<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIETransaction extends Model
{
    protected $table = 'pie_transactions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'pie_id', 'entry', 'paymentmethod', 'amount', 'comment'
    ];
}
