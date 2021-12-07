<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Earning extends Model
{
    protected $table = 'earnings';
    protected $fillable = [
        'user_id', 'balance'
    ];
}
