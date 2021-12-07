<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class VitalVariables extends Model{

    public $timestamps = false;

    protected $fillable = [

        'id', 'cost_of_upgrade','cost_of_ltt','cost_of_stt','stt_max_purchase','ltt_overall_purchase','returns_stt_ltt','duration_of_ltt_stt','no_of_month_withdraw_ltt','allow_ltt_purchase_completing','enroll_3upgraded_users','created_at'

    ];

}

