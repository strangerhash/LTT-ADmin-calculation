<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarningHistory extends Model
{
    protected $table = 'earning_histories';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'amount', 'purpose', 'trans_type', 'date_created'
    ];

}
