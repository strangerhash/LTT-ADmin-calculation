<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Transactions extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id', 'user_id','wallet_type','amount','description','date_created'
    ];

  

}
