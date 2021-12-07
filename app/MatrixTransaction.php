<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixTransaction extends Model
{
    protected $table = 'matrix_transactions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'entry', 'paymentmethod', 'is_commission', 'amount', 'comment', 'date_created'
    ];
}
