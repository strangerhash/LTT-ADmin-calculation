<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalThriftTransaction extends Model
{
    protected $table = 'digital_thrift_transactions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'amount', 'quantity', 'paymentmethod', 'date_created'
    ];
}
