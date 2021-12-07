<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Users extends Model

{

    public $timestamps = false;
    protected $table = "users";

    protected $fillable = [

        'name', 'email', 'password', 'pin_unique_value', 'parent_id', 'sponsor_id', 'position', 'current_matrix', 'is_upgraded', 'is_matrix_thrift',

        'fname', 'lname', 'username', 'phone', 'gender', 'account_name', 'account_number', 'account_bvn', 'bank_code', 'last_login_at', 'dob'

    ];

}

