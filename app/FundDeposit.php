<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FundDeposit extends Model
{
	protected $table = "fund_deposit";
    public $timestamps = false;
    protected $fillable = [
        'id', 'user_id','amount','payment_method','status','date_created'
    ];
}
