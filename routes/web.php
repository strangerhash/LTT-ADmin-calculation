<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\DigitalThriftTransaction;
use App\GraphData;
use App\PIESystem;
use App\Setting;
use App\User;
use App\TransactionHistory;
use App\Withdrawal;
use App\PIEWithdrawal;
use App\Http\Controllers\QuorumController;
use App\Http\Controllers\MatrixController;
use App\Helpers;
use App\Http\Controllers\Recharge\ReferralSystemController;
// use App\Http\Controllers\Auth\RegisterController;
use App\MatrixIncentive;
use App\MatrixTransaction;
use App\PIETransaction;
use App\Recharge\Airtime;
use App\Recharge\Data;
use App\Recharge\FundWallet;
use App\Recharge\Transaction;
//use App\FundWallet;
use App\Recharge\Withdrawal as AppWithdrawal;
use App\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Http\Request;
// use Request;

//Illuminate\Http\Request.php


use function GuzzleHttp\json_encode;

Route::get('/auth/login', function () {
    if (!Auth::check()) {
       
        return view('auth.login2');
    } else {
        return redirect()->route('dashboard');
    }
})->name("auth-login");

Route::get('/auth/register', function () {
    
    if (!Auth::check()) {
        return view('auth.register2');
    } else {
        return redirect()->route('dashboard');
    }
})->name("auth-register");
Route::post('/auth/register', 'Auth\RegisterController@create')->name('auth.register');
Route::get('/', function () {
    if (!Auth::check()) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $tracking = DB::table('tracking')->where('ip_address',$ip )->get();
            if(count($tracking) == 0){

                    $values = array('ip_address' => $ip);
                    DB::table('tracking')->insert($values);
       
            }
            
        return view('auth.login2');
    } else {
        return redirect()->route('dashboard');
    }
});



// Referral Link
Route::get('/ref/{username}', function ($username) {
    if (!Auth::check()) {
        return view('auth.register2', ['username' => $username]);
    } else {
        return redirect()->route('dashboard');
    }
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    // Frontend Routes
    Route::get('/dashboard', function () {
        if (Auth::user()->account_number != null) {
            $referrals = User::where('sponsor_id', Auth::id())->where('is_matrix_thrift', 0)->paginate(10);
            $records = DB::table('fund_wallet')->where('user_id', Auth::id())->get();
            $fund_desposit = DB::table('fund_deposit')->where('user_id', Auth::id())->get();
            $fund_widthdraw = DB::table('withdrawals')->where('user_id', Auth::id())->get();
            $earnings = DB::table('earnings')->where('user_id', Auth::id())->get();
            //$records = FundWallet::where('user_id', Auth::id());
            $my_fund_wallet = 0.00;
            foreach($records as $recod){
                $my_fund_wallet = $my_fund_wallet + $recod->amount;

            }

            $my_fund_deposit = 0.00;
            foreach($fund_desposit as $fund){
                $my_fund_deposit = $my_fund_deposit + $fund->amount;

            }


            $my_fund_with = 0.00;
            foreach($fund_widthdraw as $withdraw){
                $my_fund_with = $my_fund_with + $withdraw->amount;

            }

            $total_earnings = 0.00;
            foreach($earnings as $earning){
                $total_earnings = $total_earnings + $earning->balance;
            }




            return view('dashboard', ['referrals' => $referrals,'my_fund_wallet' => $my_fund_wallet,'my_fund_deposit'=> $my_fund_deposit, 'my_fund_withdraw' => $my_fund_with,'total_earnings'=> $total_earnings]);
            // return view('dashboard');
        } else {
            return redirect()->route('profile');
        }
    })->name('dashboard');

    Route::get('/upgrade-account', function () {

        if (Auth::user()->account_number != null)
            return view('frontend.upgrade-account');
        else
            return redirect()->route('profile');
    })->name('user_upgrade');

    Route::get('/buy-mt-pack', function () {
        if (Auth::user()->is_upgraded == 0) {
            return view('frontend.upgrade-account');
        } else {
            return view('frontend.buy-mt-pack', ['mt_price' => Helpers::settings('mt_price')]);
        }
    })->name('buy-mt-pack');

    Route::get('/buy-pie-units', function () {
        if (Auth::user()->is_upgraded == 0) {
            return view('frontend.buy-pie-units', ['pie_price' => Helpers::settings('pie_price_ordinary')]);
        } else {
            return view('frontend.buy-pie-units', ['pie_price' => Helpers::settings('pie_price_upgraded')]);
        }
    })->name('buy-pie-units');

    Route::get('/my-matrix', function () {
        return view('frontend.my-matrix');
    })->name('matrix');

    Route::get('/geneology', function () {
        $user = Auth::user();
        $dt = '{id : "' . $user->id . '", name : "' . $user->fname . '", title : "' . $user->fname . '", matrix : "' . $user->current_matrix . '", relationship : "001",';

        $graph = new GraphData();
        $users = [];
        $records = $graph->getUserGeneology($user->id);
        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::find($users);

        $dat = '"children": [';
        foreach ($users as $key => $user) {
            $dat = $dat . ('{id : "' . $user->id . '", name : "' . $user->fname . '", title : "' . $user->fname . '", matrix : "' . $user->current_matrix . '", relationship : "111"},');
        }
        $dat = $dat . ']}';

        return view('frontend.geneology', ['data' => $dt . $dat]);
    })->name('geneology');

    Route::get('/withdrawal', function () {
        $withdrawals = Withdrawal::where('user_id', Auth::id())->where('account', 0)->get();
        return view('frontend.withdrawal', ['withdrawals' => $withdrawals]);
    })->name('withdrawal');

    Route::get('/my-profile', function () {
        return view('frontend.profile');
    })->name('profile');

    Route::post('/updateprofile', 'UserController@profileUpdate')->name('updateprofile');

    Route::get('/account-statement', function () {
        $records = MatrixTransaction::where('user_id', Auth::id())->latest('date_created')->paginate(10);
        return view('frontend.account-statement', ['records' => $records]);
    })->name('account-statement');


    Route::get('/mtpack-history', function () {
        return view('frontend.mtpack-history');
    })->name('mtpack-history');


    // Paystack
    Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');

    // Add New Matrix Thrift
    Route::any('/user/matrix-thrift/add', 'MatrixThriftController@create')->name('matrix-thrift-add');

    // User Upgrade
    Route::post('/user/upgrade', 'UserController@upgrade')->name('upgrade');


    // MTPack View
    Route::get('/mtpack/{id}/view', function ($id) {

        $quorum = new QuorumController();
        $quorum->monoUserMTShift($id);
        // Check if id belongs to this user
        $user = User::where(['id' => $id])->firstOrFail();

        // Load View
        return view('frontend.mtpack-history', ['user' => $user]);
    })->name('mt-view');


    Route::post('/withdrawal/request', 'WalletController@withdrawalRequest');
    // Payment Handler
    Route::get('/process-mt-pack-payment', 'PaymentController@mtPurchaseHandler');
    Route::get('/process-pie-payment', 'PaymentController@piePurchaseHandler');
    Route::get('/upgrade-account/process-payment', 'PaymentController@accountUpgradeHandler');


    Route::post('/refresh-account', 'AjaxController@quorumShift');

    Route::get('/orgchart/init/{username?}', function ($username = null) {
        $matrix = new MatrixController();
        if($username != ''){
            $username = $username;
        } else{
             $user_logged_in = Auth::user();
            $username = $user_logged_in->usernmae;
        }
        $parents = [];
        $all_parents = [];
        $i=0;
        $html = '<ul id="myUL">';
        $user = DB::table('users')->select('id', 'name', 'parent_id')->where('username', $username)->first();
    
        if(!empty($user)){
            if(!empty($user->parent_id)){
                
                $parents[] = $user;
                $all_parents = $matrix->getAssociate('parent', $user->parent_id, $parents); +
                krsort($all_parents);
               
                
                
            }else{
                $all_parents[] = $user;
            }
            foreach($all_parents as $key=>$value){
                if($i == 0){
                    $html .= ' <li><span class="caret">'.$value->name.'</span>';
                }else{
                    $html .= '<ul class="nested"><li><span class="caret">'.$value->name.'</span>';
                }
                $i++;
            }
        }



        //return $html;

        /*$graph = new GraphData();
        $user = null;
        if (isset($username)) {
            $user = User::where('username', $username)->first();
            $res = $graph->isRelatedToUser(Auth::user()->id, $user->id);
            if ($res != true)
                return response()->json(['message' => 'User not your downline!']);
        } else {
            $user = Auth::user();
        }
        $dt = ['id' => $user->id, 'name' => $user->fname, 'title' => $user->username . '(' . $user->current_matrix . ')', 'matrix' => $user->current_matrix, 'relationship' => "001"];

        $users = [];
        $records = $graph->getUserGeneology($user->id);
        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }
        $users = User::find($users);

        echo "<pre>";
        print_r($users);
        echo "</pre>";
        die;  

        $data_2 = [];

        foreach ($users as $key => $user) {
            array_push($data_2, ['id' => $user->id, 'name' => $user->fname . " " . $user->lname, 'title' => $user->username . '(' . $user->current_matrix . ')', 'matrix' => $user->current_matrix, 'relationship' => '111']);
        }
        $data_ = ["children" => $data_2];*/

        //return response()->json(array_merge($dt, $data_));
    });

    Route::get('/orgchart/children/{id}', function ($id) {
        $graph = new GraphData();
        $users = [];
        $records = $graph->getUserGeneology($id);
        foreach ($records as $record) {
            array_push($users, $record->value("users"));
        }

        $users = User::find($users);
        $data_2 = [];

        foreach ($users as $key => $user) {
            array_push($data_2, ['id' => $user->id, 'name' => $user->fname . " " . $user->lname, 'title' => $user->username . '(' . $user->current_matrix . ')', 'matrix' => $user->current_matrix, 'relationship' => '111']);
        }
        $data_ = ["children" => $data_2];



        return response()->json($data_);
    });
});


// ISCUBE RECHARGE
Route::group(['middleware' => ['auth', 'verified']], function () {

    // PIE SYSTEM ROUTES
    Route::prefix('long-term-thrift')->group(function () {
        
        // Route::get('/dashboard', function () {
        //     return view('frontend.pie.pie-dashboard');
        // })->name('pie-dashboard');

        Route::get('/account/{id}/close', 'PIESystemController@withdrawAll')->name('pie-account-close');

        Route::get('/accounts', function () {
            $records = PIESystem::where('user_id', Auth::id())->latest('start_date')->paginate(15);
            return view('frontend.pie.pie-accounts', ['records' => $records]);
        })->name('pie-accounts');

        Route::get('/transactions', function () {
            $records = PIETransaction::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('frontend.pie.pie-transactions', ['records' => $records]);
        })->name('pie-transactions');

        Route::get('/account/{id}', function ($id) {
            $pie = PIESystem::where(['user_id' => Auth::user()->id, 'id' => $id])->firstOrFail();
            $records = PIEWithdrawal::where('pie_id', $id)->latest('date_created')->paginate(15);
            return view('frontend.pie.pie-single-account', ['id' => $id, 'records' => $records, 'pie' => $pie]);
        })->name('pie-single-account');

        Route::get('/account/{id}/withdrawal', function ($id) {
            $pie = PIESystem::where(['user_id' => Auth::user()->id, 'id' => $id])->firstOrFail();
            $records = PIEWithdrawal::where('pie_id', $id)->latest('date_created')->paginate(15);
            return view('frontend.pie.pie-single-account-withdrawal', ['id' => $id, 'pie' => $pie, 'records' => $records]);
        })->name('pie-single-account-withdrawal');
        Route::post('/account/withdrawal', 'PIESystemController@transferFromPIEAccount')->name('pie-account-withdrawal');

        Route::get('/purchase', function () {
            return view('frontend.pie.pie-purchase', ['pie_price' => Helpers::settings('pie_price_ordinary')]);
        })->name('pie-purchase');
        Route::post('/purchase', 'PIESystemController@create')->name('pie-purchase');

        Route::get('/withdrawal', function () {
            $records = PIEWithdrawal::where('user_id', Auth::id())->where('pie_id', null)->latest('date_created')->paginate(15);
            return view('frontend.pie.pie-withdrawal', ['records' => $records]);
        })->name('pie-withdrawal');

        Route::post('/withdrawal', 'PIESystemController@withdraw')->name('pie-withdrawal');
    });

    // DIGITAL THRIFT SYSTEM ROUTES
    Route::prefix('short-term-thrift')->group(function () {
        Route::get('/purchase', function () {
            if (Auth::user()->is_upgraded == 0) {
                return view('frontend.upgrade-account');
            } else {
                $records = DigitalThriftTransaction::where('user_id', Auth::id())->latest('date_created')->paginate(15);
                return view('frontend.digital-thrift.digital-thrift-purchase', ['mt_price' => Helpers::settings('mt_price'), 'records' => $records]);
            }
        })->name('digital-thrift-purchase');

        Route::post('/purchase', 'MatrixThriftController@create')->name('digital-thrift-purchase');

        Route::get('/accounts', function () {
            $records = User::where(['is_matrix_thrift' => Auth::id()])->oldest('created_at')->paginate(10);
            return view('frontend.digital-thrift.digital-thrift-accounts', ['user' => [], 'records' => $records]);
        })->name('digital-thrift-accounts');

        Route::get('/account/{id}', function ($id) {
            $user = User::where(['id' => $id, 'is_matrix_thrift' => Auth::id()])->firstOrFail();

            if ((int) $user->is_thrift_completed == 1)
                return redirect()->route('digital-thrift-accounts')->with("message", "Thrift completed for this STT User and earning has been transfered into Matrix Account")->with("alert", "success");
            else
                return view('frontend.digital-thrift.digital-thrift-single-account', ['user' => $user]);
        })->name('digital-thrift-single-account');

        Route::get('/transactions', function () {
            $records = DigitalThriftTransaction::latest('date_created')->paginate(15);
            return view('frontend.digital-thrift.digital-thrift-transactions', ['records' => $records]);
        })->name('digital-thrift-transactions');
    });

    // RECHARGE SYSTEM ROUTES
    Route::prefix('recharge')->group(function () {

        Route::get('upgrade-vtu', 'Recharge\DashboardController@upgradeVTU')->name('recharge-upgrade-vtu');
        Route::post('upgrade-vtu', 'Recharge\ReferralSystemController@upgradeVTU')->name('recharge-upgrade-vtu');
        Route::get('dashboard', 'Recharge\DashboardController@index')->name('recharge-dashboard');

        // Airtime
        Route::get('buy-airtime', function () {
            $records = Airtime::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('recharge.frontend.airtime', ['records' => $records]);
        })->name('recharge-airtime');
        Route::post('buy-airtime', 'Recharge\AirtimeController@purchase')->name('recharge-airtime');

        // Data Bundle
        Route::get('buy-data-bundle', function () {
            $records = Data::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('recharge.frontend.data', ['records' => $records]);
        })->name('recharge-data-bundle');
        Route::post('buy-data-bundle', 'Recharge\DataController@purchase')->name('recharge-data-bundle');

        // Electricity
        Route::get('buy-electricity/{company}', function ($company) {
            return view('recharge.frontend.electricity', ['company' => $company]);
        })->name('recharge-electricity');

        // TV Subscription
        Route::get('buy-tv-subscription/{company}', function ($company) {
            return view('recharge.frontend.subscription', ['company' => $company]);
        })->name('recharge-tv-subscription');

        // Wallet
        Route::get('fund-wallet', function () {
            $records = FundWallet::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('recharge.frontend.fund-wallet', ['records' => $records]);
        })->name('recharge-fund-wallet');
        Route::post('fund-wallet', 'Recharge\FundWalletController@fund')->name('recharge-fund-wallet');

        // My Network
        // Route::get('recharge-geneology-list', function () {
        //     $data = ReferralSystemController::geneologyList();
        //     return view('recharge.frontend.geneology-list', ['data' => $data]);
        // })->name('recharge-geneology-list');

        Route::get('recharge-geneology-tree', function () {
            $data = ReferralSystemController::geneologyTree();
            return view('recharge.frontend.geneology-tree', ['data' => $data]);
        })->name('recharge-geneology-tree');

        Route::get('recharge-transactions', function () {
            $records = Transaction::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('recharge.frontend.transactions', ['records' => $records]);
        })->name('recharge-transactions');


        Route::get('recharge-withdrawal', function () {
            $records = AppWithdrawal::where('user_id', Auth::id())->latest('date_created')->paginate(15);
            return view('recharge.frontend.withdrawal', ['records' => $records]);
        })->name('recharge-withdrawal');
        Route::post('recharge-withdrawal', 'Recharge\WithdrawalController@withdraw')->name('recharge-withdrawal');

        // Reload Account
        Route::post('/refresh-account', 'Recharge\DashboardController@refreshAccount');
    });

    // MATRIX SYSTEM ROUTES
    Route::prefix('matrix')->group(function () {
        Route::get('/quorum-matrix', function () {
            $user = Auth::user();
            $pin_unique_value = $user->pin_unique_value;
            $users = User::where('parent_id',$pin_unique_value)->get();
            /*echo "<pre>";
            print_r($user);
            echo "</pre>";
            die("dfdfd");*/
            //$records = Users::where('user_id', Auth::id())->latest('date_created')->paginate(15); 
            return view('frontend.matrix.quorum-matrix',['users' => $users]);
        })->name('matrix-quorum');

        Route::get('/geneology-tree/{username?}', function ($username = null ){
            $matrix = new MatrixController();
            if($username != ''){
            $username = $username;
        } else{
             $user_logged_in = Auth::user();
            $username = $user_logged_in->username;
        }
        
        $parents = [];
        $all_parents = [];
        $i=0;
        $html = '';
        $html .= '<ul id="myUL">';
        $user = DB::table('users')->select('id', 'name', 'parent_id')->where('username', $username)->first();
    
        if(!empty($user)){
            if(!empty($user->parent_id)){
                
                $parents[] = $user;
                $all_parents = $matrix->getAssociate('parent', $user->parent_id, $parents); +
                krsort($all_parents);
               
                
                
            }else{
                $all_parents[] = $user;
            }
            foreach($all_parents as $key=>$value){
                if($i == 0){
                    $html .= '<li><span class="caret">'.$value->name.'</span>';
                }else{
                    $html .= '<ul class="nested"><li><span class="caret">'.$value->name.'</span>';
                }
                $i++;
            }
        }
            //echo $html;
        $html = trim($html);
            return view('frontend.matrix.geneology-tree')->with(['html' => $html]);
        })->name('matrix-geneology-tree');

        Route::get('/downlines/{step?}', function ($step = 0) {
            if ($step < 0)
                $step = 0;

            $graph = new GraphData();
            $users = [];
            $records = $graph->getUserDownlinesByStep(Auth::id(), $step);
            foreach ($records as $record) {
                array_push($users, $record->value("users"));
            }
            $records = User::find($users);

            echo "<pre>";
            print_r($records);
            echo "</pre>";
            die;

            return view('frontend.matrix.downlines', ['records' => $records, 'step' => $step]);
        })->name('matrix-downlines');

        Route::get('/referrals', function () {
            $records = User::where('sponsor_id', Auth::id())->where('is_matrix_thrift', 0)->paginate(10);
            return view('frontend.matrix.referrals', ['records' => $records]);
        })->name('matrix-referrals');

        Route::get('/incentives', function () {
            $records = MatrixIncentive::where('user_id', Auth::id())->paginate(15);
            return view('frontend.matrix.incentives', ['records' => $records]);
        })->name('matrix-incentives');
    });

    // WALLET ROUTES
    Route::prefix('wallet')->group(function () {
        Route::get('/fund', 'FundWalletController@index')->name('fund-wallet');
        Route::post('/fund', 'FundWalletController@fund')->name('fund-wallet');
    });
});


// AjaxCalls
Route::get('/fetch-user-info', function () {
    $referrer = $_GET["referrer"];
    $user = User::where('username', $referrer)->select(['fname', 'lname'])->firstOrFail();
    return json_encode($user);
});
Route::get('/is-username-unique', function () {
    $username = $_GET["username"];
    
    $user = User::where('username', $username)->select(['id'])->firstOrFail();
    //if($user == null) $user = [];
    return json_encode($user);
});
Route::get('/is-email-unique', function () {
    $email = $_GET["email"];
    $user = User::where('email', $email)->select(['id'])->firstOrFail();
    return json_encode($user);
});

Route::get('/clear-cache', function () {
   echo  $exitCode = Artisan::call('cache:clear');
   dd('done');
});


// Auth
// Auth::routes();
Auth::routes(['verify' => true]);

// Admin Routes
// First User Registration
 Route::any('/first-user/register', 'FirstUserController@firstUserRegistration')->name('first-user');
// Reset System
 Route::get('/reset', 'ResetController@resetFirstUser')->name('reset');
Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

// Clear application cache:
 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

Route::get('/command-run', function() {
     $exitCode = Artisan::call('migrate:fresh'); 
     dd($exitCode);
     return 'Application cache cleared';
 });
 

 // Clear view cache:
 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });
include_once('admin_users.php');