<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaystackTransaction extends Model
{
    protected $table = 'paystack_transactions';
    public $timestamps = false;
    protected $fillable = [
        'transaction_id'
    ];
}
