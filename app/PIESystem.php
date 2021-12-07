<?php

namespace App;

use App\Http\Controllers\PIESystemController;
use Illuminate\Database\Eloquent\Model;
use App\TransactionHistory;

class PIESystem extends Model
{
    protected $table = 'pie_system';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'amount', 'no_of_pie', 'track', 'start_date', 'end_date', 'withdraw_date', 'amount_withdrawn', 'date_closed'
    ];

    public function getCurrentEarningAttribute()
    {
        // Confirm PIE account balance
        $pie_amount_withdrawn = PIEWithdrawal::where('pie_id', $this->id)->sum('amount');
        $pie = new PIESystemController();
        $current_earning = $pie->calculate_current_earning($this->start_date,$this->end_date, $this->date_closed, $this->amount);
        $current_earning = $current_earning - $pie_amount_withdrawn;
        return round((float)$current_earning, 2, PHP_ROUND_HALF_UP);
    }
}
