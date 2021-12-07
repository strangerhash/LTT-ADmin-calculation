<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PIESystem;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Tracking;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'verified']);
    }

    public function index(Request $request)
    {
        //die('dfdfd');
        $registeredUsers = $this->countRegisteredUsers();
        $upgradedUsers = $this->countUpgradedUsers();
        $totalSTT = $this->countSTT();
        $totalLTT = $this->countLTT();

        $tracking_users =  DB::select('select * from tracking');

        $tarcking_yesterday_users = DB::select('SELECT * FROM tracking
    WHERE date_created BETWEEN CURDATE() - INTERVAL 1 DAY
        AND CURDATE() - INTERVAL 1 SECOND');

        $thismonth_tracking_users = DB::select('SELECT * FROM tracking WHERE MONTH(date_created) = MONTH(CURDATE())');

        $lastmonth_tracking_users  = DB::select('SELECT * FROM tracking
WHERE YEAR(date_created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(date_created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)');
        
        return view(
            'administrator.dashboard',
            [
                'registeredUsers' => $registeredUsers,
                'upgradedUsers' => $upgradedUsers,
                'totalSTT' => $totalSTT,
                'totalLTT' => $totalLTT,
                'total_tracking_users'=> count($tracking_users),
                'total_yesterday_users'=> count($tarcking_yesterday_users),
                'thismonth_trackingusers' => count($thismonth_tracking_users),
                'lastmonth_tracking_users' => count($lastmonth_tracking_users),
            ]
        );
    }


    /**
     * Get all registered users.
     */
    protected function countRegisteredUsers()
    {
        return User::all()->count();
    }

    /**
     * Get all registered users.
     */
    protected function countUpgradedUsers()
    {
        return User::where('is_upgraded', 1)->count();
    }


    /**
     * Count total STT.
     */
    protected function countSTT()
    {
        return User::where('is_matrix_thrift', '<>', 0)->count();
    }

    /**
     * Count total LTT.
     */
    protected function countLTT()
    {
        return PIESystem::where('date_closed', null)->select(DB::raw('count(no_of_pie) as pie_count'))->first()->pie_count;
    }

    /**
     * Get Total Number Of Upgraded Users By Number Of Days
     */
    protected function getTotalNumberOfUpgradedUsersByNumberOfDays(int $days = 10)
    {
        $datesBetween = $this->getDatesBeforeToday();
        dd($datesBetween);
        return User::where('is_upgraded', 1)->count();
    }

    /**
     *
     */
    protected function getDatesBeforeToday($days = 20)
    {
        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string("${days} days ago"));

        // Declare two dates
        $date1 = $date->format('Y-m-d');
        $date2 = now()->format('Y-m-d');

        // Declare an empty array
        $array = array();

        // Use strtotime function
        $variable1 = strtotime($date1);
        $variable2 = strtotime($date2);

        // Use for loop to store dates into array
        // 86400 sec = 24 hrs = 60*60*24 = 1 day
        for (
            $currentDate = $variable1;
            $currentDate <= $variable2;
            $currentDate += (86400)
        ) {

            $store = "'" . date('Y-m-d', $currentDate) . "'";
            $array[] = $store;
        }

        // Display the dates in array format
        return $array;
    }
}
