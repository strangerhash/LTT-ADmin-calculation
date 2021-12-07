<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller; 

use App\VitalVariables;
use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;


class AdminVitalVariablesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {  
        //$transactions = Transactions::latest()->paginate(5);

      $vital_variables = DB::select('select * from vital_variables');

        return view('administrator.system.index')->with('vital_variables', $vital_variables);

    }


   public function create(){

      $users = DB::select('select * from users');
      return view('administrator.system.create')->with('users', $users);

   }



   public function store(Request $request){

      $data = $request->except('_method','_token','submit');



      $validator = Validator::make($request->all(), [

         'cost_of_upgrade' => 'required|string',

         'cost_of_ltt' => 'required|string|min:3',

         'cost_of_stt' => 'required|string|min:3',

         'stt_max_purchase' => 'required|string|min:3'

      ]);



      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }



      if($record = VitalVariables::firstOrCreate($data)){

         Session::flash('message', 'Added Successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('vitalvaribales');

      }else{

         Session::flash('message', 'Data not saved!');

         Session::flash('alert-class', 'alert-danger');

      }

      return Back();

   }



   public function edit($id){
      
      $users = DB::select('select * from users');

      $vitalvaribale= VitalVariables::find($id);

      return view('administrator.system.edit')->with(['users'=> $users,'vitalvaribale'=> $vitalvaribale]);

   }



   public function update(Request $request,$id){

      $data = $request->except('_method','_token','submit');

      
      $validator = Validator::make($request->all(), [

         'cost_of_upgrade' => 'required',

         'cost_of_ltt' => 'required|string',

      ]);


      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }

      $VitalVariable = VitalVariables::find($id);

      if($VitalVariable->update($data)){

         Session::flash('message', 'Update successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('vitalvaribales');

      }else{

         Session::flash('message', 'Data not updated!');

         Session::flash('alert-class', 'alert-danger');

      }

      return Back()->withInput();

   }

   // Delete

   public function destroy($id){
     DB::delete('delete from vital_variables where id = ?',[$id]);

      //$transaction->delete();

      return redirect()->route('vitalvaribales')->with('success', 'Vital Varibales deleted successfully');;

   }









   

   

}





