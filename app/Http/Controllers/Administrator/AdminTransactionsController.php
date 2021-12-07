<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller; 

use App\Transactions;
use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;


class AdminTransactionsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {  
        

        //$transactions = Transactions::latest()->paginate(5);

      $transactions = DB::select('select * from transactions');

        return view('administrator.transaction.index')->with('transactions', $transactions);

    }


    public function create(){

      $users = DB::select('select * from users where name IS NOT NULL');
      return view('administrator.transaction.create')->with('users', $users);

   }



   public function store(Request $request){

      $data = $request->except('_method','_token','submit');
//       echo "<pre>";print_r($data);die('success');


      $validator = Validator::make($request->all(), [

         'user_id' => 'required|integer',

         'wallet_type' => 'required|string|min:3',

         'amount' => 'required|string|min:3',

         'description' => 'required|string|min:3'

      ]);



      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }



      if($record = Transactions::firstOrCreate($data)){

         Session::flash('message', 'Added Successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('transactions');

      }else{

         Session::flash('message', 'Data not saved!');

         Session::flash('alert-class', 'alert-danger');

      }



      return Back();

   }

    public function user_transactions($id){
      
      $users = DB::select('select * from users');

      $transaction= Transactions::select('transactions.id', 'transactions.user_id', 'users.username','wallet_type', 'amount', 'description', 'date_created')->leftjoin('users', 'transactions.user_id', '=', 'users.id')->where('user_id', $id)->getQuery()->get()->toArray();
    //   echo "<pre>";print_r($transaction);die;

      return view('administrator.transaction.user_transactions')->with(['users'=> $users,'transactions'=> $transaction]);

   }

   public function edit($id){
      
      $users = DB::select('select * from users');

      $transaction= Transactions::find($id);

      return view('administrator.transaction.edit')->with(['users'=> $users,'transaction'=> $transaction]);

   }



   public function update(Request $request,$id){

      $data = $request->except('_method','_token','submit');

      
      $validator = Validator::make($request->all(), [

         'amount' => 'required',

         'description' => 'required|string',

      ]);



      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }

      $transaction = Transactions::find($id);



      if($transaction->update($data)){



         Session::flash('message', 'Update successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('transactions');

      }else{

         Session::flash('message', 'Data not updated!');

         Session::flash('alert-class', 'alert-danger');

      }



      return Back()->withInput();

   }



   // Delete

   public function destroy($id){
     DB::delete('delete from transactions where id = ?',[$id]);

      //$transaction->delete();


      return redirect()->route('transactions')->with('success', 'Transaction deleted successfully');;

   }









   

   

}





