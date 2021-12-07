<?php

namespace App;

use App\Http\Controllers\QuorumController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use GuzzleHttp\Psr7\Request;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pin_unique_value', 'parent_id', 'sponsor_id', 'position', 'current_matrix', 'is_upgraded', 'is_matrix_thrift',
        'fname', 'lname', 'username', 'phone', 'gender', 'account_name', 'account_number', 'account_bvn', 'bank_code', 'last_login_at', 'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the earning associated with the user.
     */
    public function earning()
    {
        return $this->hasOne('App\Earning');
    }

    /**
     * Get the wallet associated with the user.
     */
    public function wallet()
    {
        return $this->hasOne('App\Wallet');
    }

    /**
     * Get the recharge account associated with the user.
     */
    public function recharge()
    {
        return $this->hasOne('App\Recharge\Recharge');
    }

    /**
     * Get the pie associated with the user.
     */
    public function pie()
    {
        return $this->hasMany('App\PIESystem');
    }

    /**
     * Get the transactions associated with the user.
     */
    public function transactions()
    {
        return $this->hasMany('App\TransactionHistory');
    }

    /**
     * Get the matrix lvel user belongs to.
     */
    public function matrix_type()
    {
        return $this->belongsTo('App\MatrixType', 'current_matrix', 'code');
    }

    /**
     * Get the matrix lvel user belongs to.
     */
    public function matrix_thrift()
    {
        return $this->belongsTo('App\MatrixType', 'current_matrix', 'code');
    }

    /**
     * Get the earning associated with the user.
     * @return Collection $matrix_thrifts List of user's matrix thrifts
     */
    public function getMatrixThriftsAttribute()
    {
        return User::where('is_matrix_thrift', $this->id)->paginate(15);
    }

    /**
     * Get the earning associated with the user.
     * @return Collection $matrix_thrifts List of user's matrix thrifts
     */
    public function getMatrixThriftsCountAttribute()
    {
        return User::where('is_matrix_thrift', $this->id)->count();
    }

    /**
     * Get the pie associated with the user.
     * @return Collection $matrix_thrifts List of user's matrix thrifts
     */
    public function getCountPieAccountsAttribute()
    {
        $result = PIESystem::where('user_id', $this->id)->select(DB::raw('SUM(no_of_pie) as total_pie'))->first()->total_pie;
        if (is_null($result)) {
            return 0;
        }
        return $result;
    }

    /** */
    public function getMatrixUsersAttribute()
    {
        $graph = new \App\GraphData();
        $level = 2;
        $users = [];

        // Check if User is in stage 5 then Increase depth to 3 generations
        if ($this->current_matrix == 5) {
            $level = 3;
        }

        $records = $graph->getUsersAtLevel($this->id, $level, $this->current_matrix);
        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::find($users);

        $arr = [];

        foreach ($users as $key => $user) {
            $user_name = $user->fname . " " . $user->lname;
            // $user_name = ($user->name == "") ? $user->name : $user->fname . " " . $user->lname;
            if ($key == 0)
                array_push($arr, ['id' => $user->pin_unique_value, 'Full Name' => $user_name, 'Username' => $user->username, 'Phone Number' => $user->phone, 'Sponsor' => $user->sponsor_id, 'System Unique ID' => $user->pin_unique_value, 'Parent' => $user->parent_id, 'S/N' => $user->id, 'Current Matrix' => $user->current_matrix]);
            else
                array_push($arr, ['id' => $user->pin_unique_value, 'pid' => $user->parent_id, 'Full Name' => $user_name, 'Username' => $user->username, 'Phone Number' => $user->phone, 'Sponsor' => $user->sponsor_id, 'Parent' => $user->parent_id, 'System Unique ID' => $user->pin_unique_value, 'S/N' => $user->id, 'Current Matrix' => $user->current_matrix]);
        }

        return json_encode($arr);
    }

    /**
     * Get the number of referrals.
     * @return Collection $matrix_thrifts List of user's matrix thrifts
     */
    public function getReferralsAttribute()
    {
        return User::where('sponsor_id', $this->id)->where('is_matrix_thrift', 0)->paginate(10);
    }

    /** */
    public function getDownlinesAttribute()
    {
        $graph = new \App\GraphData();
        $level = 2;
        $users = [];

        // Check if User is in stage 5 then Increase depth to 3 generations
        if ($this->current_matrix == 5) {
            $level = 3;
        }

        $records = $graph->getUsersAtLevel($this->id, $level, $this->current_matrix);
        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::find($users)->paginate(5);

        dd($users);
    }

    public function getQuorumShiftAttribute()
    {
        $quorum = new QuorumController();
        $quorum->initiateQuorumShift();
    }


    /**
     * Get the first and last name of sponsor.
     * @return Collection $matrix_thrifts List of user's matrix thrifts
     */
    public function getSponsorAttribute()
    {
        $record = User::where('id', $this->sponsor_id)->first();
        if ($record)
            return $record->fname . ' ' . $record->lname;
        else
            return '';
    }

    /**
     * Get number of referrals.
     */
    public function getNoOfReferralsAttribute()
    {
        return User::where('sponsor_id', $this->id)->where('is_upgraded', 1)->count();
    }

    /**
     * Get total wallwt balance.
     */
    public function getTotalWalletBalanceAttribute()
    {
        // Check for Q0 Users
        if ($this->current_matrix < 3 && $this->no_of_referrals < 3) {
            return $this->wallet->incoming;
        }

        // Check for Q3 Users
        if ($this->current_matrix >= 3 && $this->no_of_referrals < 6) {
            return $this->wallet->incoming;
        }
        // Return complete wallet
        return $this->wallet->balance + $this->wallet->incoming;
    }


    /**
     * Get total deposited
     */
    public function getTotalDepositedAttribute()
    {
        return FundWallet::where('user_id', $this->id)->where('verified', 1)->sum('amount');
    }

    /**
     * Get total earning
     */
    public function getTotalEarningsAttribute()
    {
        return MatrixTransaction::where('user_id', $this->id)->whereNotNull('is_commission')->where('is_commission', 1)->sum('amount');
    }
}
