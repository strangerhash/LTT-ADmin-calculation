<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class WithdrawalRequest extends Model
{
	protected $table = "withdrawal_request";
    public $timestamps = false;
    protected $fillable = [
        'id', 'user_id','amount','status','date_created'
    ];
}
