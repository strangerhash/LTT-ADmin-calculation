<?php

namespace App\Admin;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{

    protected $fillable = [
        'username', 'fullname', 'password', 'last_login_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The role that belong to a user.
     */
    public function role()
    {
        return $this->belongsTo('App\Admin\AdminRole')->using('App\Admin\AdminRole_AdminUser');;
    }
}
