<?php
namespace App\Http\Controllers\Administrator;
use App\Http\Controllers\Controller; 
use App\WithdrawalRequest;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
  
class AdminWithdrawalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$transactions = Transactions::latest()->paginate(5);
       $withdrawal = DB::table('withdrawal_request')
            ->join('users', 'users.id', '=', 'withdrawal_request.user_id')
            ->select('withdrawal_request.*', 'users.name')
            ->get();  
  
        return view('administrator.withdrawal.index')->with('withdrawal', $withdrawal);
    }

    public function create(){
      $users = DB::select('select * from users');
      return view('administrator.withdrawal.create')->with('users', $users);
   }

   public function store(Request $request){

      $data = $request->except('_method','_token','submit');

      $validator = Validator::make($request->all(), [

         'user_id' => 'required|integer',
         'amount' => 'required|string|min:3',
      ]);

      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }
       
      if($record = WithdrawalRequest::firstOrCreate($data)){

         Session::flash('message', 'Added Successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('withdrawal');

      }else{

         Session::flash('message', 'Data not saved!');

         Session::flash('alert-class', 'alert-danger');

      }

      return Back();

   }


   public function edit($id){
      $users = DB::select('select * from users');
      $withdrawal = WithdrawalRequest::find($id);
      return view('administrator.withdrawal.edit')->with(['users'=> $users,'withdrawal'=> $withdrawal]);
   }

   public function update(Request $request,$id){
      $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
         'payment_method' => 'required',
         'amount' => 'required',
      ]);

      if ($validator->fails()) {
         return redirect()->Back()->withInput()->withErrors($validator);
      }
      $WithdrawalRequest = WithdrawalRequest::find($id);

      if($WithdrawalRequest->update($data)){

         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('withdrawal');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back()->withInput();
   }

  // Delete
   public function destroy($id){
      WithdrawalRequest::destroy($id);
      Session::flash('message', 'Delete successfully!');
      Session::flash('alert-class', 'alert-success');
      return redirect()->route('withdrawal');
   }

   public function status(Request $request,$id){
      $data = $request->except('_method','_token','submit');
      $WithdrawalRequest = WithdrawalRequest::find($id);

      if($WithdrawalRequest->update($data)){

         Session::flash('message', 'Update status successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('withdrawal');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back()->withInput();
   }

   
}


