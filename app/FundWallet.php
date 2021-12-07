<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class FundWallet extends Model

{

    protected $table = "fund_wallet";

    public $timestamps = false;



    protected $fillable = [

        'user_id', 'amount', 'file_name', 'depositor_name', 'verified', 'payment_method', 'date_created', 'date_updated'

    ];

}

