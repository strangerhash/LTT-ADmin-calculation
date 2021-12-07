<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'pie', 'balance', 'incoming', 'outgoing', 'created_at', 'updated_at'
    ];

}
