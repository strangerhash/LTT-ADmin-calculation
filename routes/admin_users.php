<?php

use Illuminate\Support\Facades\Route;



Route::prefix('administrator')->group(function () {

    // Authentication Routes

    Route::post('login', 'Administrator\AdminLoginController@loginAdmin')->name('admin.login');

    Route::get('logout', 'Administrator\AdminLoginController@logout')->name('admin.logout');



    Route::get('/', function () {

        return view('administrator.auth.login');

    })->name('admin.root');



    Route::get('login', function () {

        return view('administrator.auth.login');

    })->name('admin.login');



    Route::get('dashboard', 'Administrator\AdminDashboardController@index')->name('admin.dashboard');



    Route::get('transactions', 'Administrator\AdminTransactionsController@index')->name('transactions');   Route::get('user_transactions/{id}', 'Administrator\AdminTransactionsController@user_transactions')->name('user_transactions');


    Route::get('transactions/create', 'Administrator\AdminTransactionsController@create')->name('transactions.create');

    Route::post('transactions/store', 'Administrator\AdminTransactionsController@store')->name('transactions.store');

    ## Update

    Route::get('transactions/store/{id}', 'Administrator\AdminTransactionsController@edit')->name('transactions.edit');

    Route::post('transactions/update/{id}', 'Administrator\AdminTransactionsController@update')->name('transactions.update');
    ## Delete

    Route::post('transactions/delete/{id}', 'Administrator\AdminTransactionsController@destroy')->name('transactions.delete');


    Route::get('funddeposit', 'Administrator\AdminFundDepositController@index')->name('funddeposit');

    Route::get('funddeposit/create', 'Administrator\AdminFundDepositController@create')->name('funddeposit.create');

    Route::post('funddeposit/store', 'Administrator\AdminFundDepositController@store')->name('funddeposit.store');

    ## Update

    Route::get('funddeposit/store/{id}', 'Administrator\AdminFundDepositController@edit')->name('funddeposit.edit');

    Route::post('funddeposit/update/{id}', 'Administrator\AdminFundDepositController@update')->name('funddeposit.update');

    Route::post('funddeposit/delete/{id}', 'Administrator\AdminFundDepositController@destroy')->name('funddeposit.delete');

     Route::post('funddeposit/status/{id}', 'Administrator\AdminFundDepositController@status')->name('funddeposit.status');


     Route::get('withdrawal', 'Administrator\AdminWithdrawalRequestController@index')->name('withdrawal');

    Route::get('withdrawal/create', 'Administrator\AdminWithdrawalRequestController@create')->name('withdrawal.create');

    Route::post('withdrawal/store', 'Administrator\AdminWithdrawalRequestController@store')->name('withdrawal.store');

    ## Update

    Route::get('withdrawal/store/{id}', 'Administrator\AdminWithdrawalRequestController@edit')->name('withdrawal.edit');

    Route::post('withdrawal/update/{id}', 'Administrator\AdminWithdrawalRequestController@update')->name('withdrawal.update');

    Route::post('withdrawal/delete/{id}', 'Administrator\AdminWithdrawalRequestController@destroy')->name('withdrawal.delete');

     Route::post('withdrawal/status/{id}', 'Administrator\AdminWithdrawalRequestController@status')->name('withdrawal.status');


   // Vital Variables 

      Route::get('vitalvaribales', 'Administrator\AdminVitalVariablesController@index')->name('vitalvaribales');

    Route::get('vitalvaribales/create', 'Administrator\AdminVitalVariablesController@create')->name('vitalvaribales.create');

    Route::post('vitalvaribales/store', 'Administrator\AdminVitalVariablesController@store')->name('vitalvaribales.store');

    ## Update

    Route::get('vitalvaribales/store/{id}', 'Administrator\AdminVitalVariablesController@edit')->name('vitalvaribales.edit');

    Route::post('vitalvaribales/update/{id}', 'Administrator\AdminVitalVariablesController@update')->name('vitalvaribales.update');

    Route::post('vitalvaribales/delete/{id}', 'Administrator\AdminVitalVariablesController@destroy')->name('vitalvaribales.delete');




     Route::get('members', 'Administrator\AdminUserController@index')->name('members');    
     Route::get('members/tree/{id}', 'Administrator\AdminUserController@tree')->name('members.network');

     Route::post('members/password_change', 'Administrator\AdminUserController@change_password')->name('members.change_password');


     Route::get('members/store/{id}', 'Administrator\AdminUserController@edit')->name('members.edit');
     Route::post('members/update/{id}', 'Administrator\AdminUserController@update')->name('members.update');
     Route::post('members/change_status/{id}', 'Administrator\AdminUserController@change_status')->name('members.changeStatus');

     
     
    // Wallet Route Groupss

    Route::group(['prefix' => 'wallet'], function () {

        Route::get('incoming-funds', 'Administrator\AdminWalletController@incomingFunds')->name('incoming.funds');

        //Route::get('add-transaction', 'Administrator\AdminWalletController@addTransaction')->name('add.transaction');

        Route::get('outgoing-funds', 'Administrator\AdminWalletController@outgoingFunds')->name('outgoing.funds');

        Route::get('incoming-funds/{user_id}/approve/{id}', 'Administrator\AdminWalletController@incomingFundsApprove')->name('incoming.funds.approve');

        Route::get('incoming-funds/{user_id}/decline/{id}', 'Administrator\AdminWalletController@incomingFundsDecline')->name('incoming.funds.decline');

        Route::get('outgoing-funds/{user_id}/approve/{id}', 'Administrator\AdminWalletController@outgoingFundsApprove')->name('outgoing.funds.approve');

        Route::get('outgoing-funds/{user_id}/decline/{id}', 'Administrator\AdminWalletController@outgoingFundsDecline')->name('outgoing.funds.decline');

    });



    Route::get('wallet', 'Administrator\AdminDashboardController@index')->name('admin.dashboard');

    Route::get('settings', function () {

        dd("/administrator/settings: Admin Settings");

    })->name('admin.settings');

});

