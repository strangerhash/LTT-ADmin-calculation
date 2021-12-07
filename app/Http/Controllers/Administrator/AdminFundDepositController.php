<?php
namespace App\Http\Controllers\Administrator;
use App\Http\Controllers\Controller; 
use App\FundDeposit;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
  
class AdminFundDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$transactions = Transactions::latest()->paginate(5);
       $funddeposit = DB::table('fund_deposit')
            ->join('users', 'users.id', '=', 'fund_deposit.user_id')
            ->select('fund_deposit.*', 'users.name')
            ->get();  
  
        return view('administrator.funddeposit.index')->with('funddeposit', $funddeposit);
    }

    public function create(){
      $users = DB::select('select * from users');
      return view('administrator.funddeposit.create')->with('users', $users);
   }

   public function store(Request $request){

      $data = $request->except('_method','_token','submit');

      $validator = Validator::make($request->all(), [

         'user_id' => 'required|integer',

         'payment_method' => 'required|string|min:3',

         'amount' => 'required|string|min:3',
      ]);

      if ($validator->fails()) {

         return redirect()->Back()->withInput()->withErrors($validator);

      }
       
      if($record = FundDeposit::firstOrCreate($data)){

         Session::flash('message', 'Added Successfully!');

         Session::flash('alert-class', 'alert-success');

         return redirect()->route('funddeposit');

      }else{

         Session::flash('message', 'Data not saved!');

         Session::flash('alert-class', 'alert-danger');

      }

      return Back();

   }


   public function edit($id){
      $users = DB::select('select * from users');
      $funddeposit = FundDeposit::find($id);
      return view('administrator.funddeposit.edit')->with(['users'=> $users,'funddeposit'=> $funddeposit]);
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
      $FundDeposit = FundDeposit::find($id);

      if($FundDeposit->update($data)){

         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('funddeposit');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back()->withInput();
   }

  // Delete
   public function destroy($id){
      FundDeposit::destroy($id);
      Session::flash('message', 'Delete successfully!');
      Session::flash('alert-class', 'alert-success');
      return redirect()->route('funddeposit');
   }

   public function status(Request $request,$id){
      $data = $request->except('_method','_token','submit');
      $FundDeposit = FundDeposit::find($id);

      if($FundDeposit->update($data)){

         Session::flash('message', 'Update status successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('funddeposit');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back()->withInput();
   }


   
   
}


