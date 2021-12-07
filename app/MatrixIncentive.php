<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixIncentive extends Model
{
    protected $table = 'matrix_incentives';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'level', 'incentive_id', 'date_collected'
    ];
}
