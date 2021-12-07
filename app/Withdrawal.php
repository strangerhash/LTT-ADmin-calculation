<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Withdrawal extends Model

{

    public $timestamps = false;

    protected $fillable = [

        'user_id',

        'amount',

        'status',

        'account',

        'date_created',

        'date_completed'

    ];

}

