<?php
namespace App\Http\Controllers\Administrator;
use App\Http\Controllers\Controller; 
use App\WithdrawalRequest;
use App\User;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller{

    public function index()
    {
        //$transactions = Transactions::latest()->paginate(5);
      //$users = DB::table('users')->paginate(10);
    
      $users = DB::table(DB::raw('users as l'))->select('l.id', 't.sponsor_id', 't.username as sponsor', 'l.username', 'l.fname', 'l.lname', 'l.email', 'l.sponsor_id', 'l.status')
      ->leftjoin('users as t', 'l.sponsor_id', '=', 't.id')
      ->orderBy('id', 'asc')
      ->paginate(10);
    
        return view('administrator.members.index')->with('users', $users);
    }

    public function edit($id){

	  $user = DB::table('users')->where('id', $id)->first();
      
      return view('administrator.members.edit')->with(['user'=> $user]);

    }
    public function update(Request $request,$id){
      $data = $request->except('_method','_token','submit');
        
      $name = $request->input('name');
	  $fname = $request->input('fname');
	  $lname = $request->input('lname');
      $sponsor_id = $request->input('sponsor_id');
      $phone = $request->input('phone');
/*DB::table('student')->update($data);*/
/* DB::table('student')->whereIn('id', $id)->update($request->all());*/
      DB::update('update users set name = ?,fname=?,lname=?,sponsor_id=?,phone=? where id = ?',[$name,$fname,$lname,$sponsor_id,$phone,$id]);
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('members');
     /* }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back()->withInput();*/
   }
    
    // Change users' password
   public function change_password(Request $request){
       $user_id      = $request->input('id');
       $new_password = $request->input('new_password');     
       $confirm_password = $request->input('confirm_password');
       if(!empty($new_password) && !empty($confirm_password)){
            if($new_password == $confirm_password){
                
                // Get the user instance.
                $user = User::find($user_id);
                
                // Change the password
                $user->password = Hash::make($new_password);
                
                // Lastly, save the user
                $user->save();
                return json_encode(['status'=>100, 'msg'=>"Successfully updated."]);

           }else{
                return json_encode(['status'=>101, 'msg'=>"Confirm password is not same with the new password."]);
           }
       }else{
              return json_encode(['status'=>101, 'msg'=>"Please add passwords in both the fields."]);
        }
    }
    
    
    // Delete

    public function change_status(Request $request, $id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
         Session::flash('message', 'User inactivated successfully!');
         Session::flash('alert-class', 'alert-success');
        return redirect()->route('members');
   }
    
   // Display users tree
    public function tree($id){
        
        $parents = [];
        $all_parents = [];
        $i=0;
        $html = '<ul id="myUL">';
        $user = DB::table('users')->select('id', 'name', 'parent_id')->where('id', $id)->first();
    
        if(!empty($user)){
            if(!empty($user->parent_id)){
                
                $parents[] = $user;
                $all_parents = $this->getAssociate('parent', $user->parent_id, $parents);
                krsort($all_parents);
               
                
                
            }else{
                $all_parents[] = $user;
            }
            foreach($all_parents as $key=>$value){
                if($i == 0){
                    $html .= ' <li><span class="caret">'.$value->name.'</span>';
                }else{
                    $html .= $this->makeHtml($value);
                }
                $i++;
            }
        }
        return view('administrator.network.index')->with('html', $html);

    }
    
    
    public function getAssociate($type='parent', $id, $users){
       
        // $users = [];
        $user = DB::table('users')->select('id', 'name', 'parent_id')->where('pin_unique_value', $id)->first();
         if(!empty($user)){
            if(!empty($user->parent_id)){
                $users[] = $user;
                return $this->getAssociate($type, $user->parent_id, $users);

            }else{
                
                 $users[] = $user;
                return $users;
            }
         }
        
        // die('success');
    }
    
    public function makeHtml($item){
       $ht = '<ul class="nested"><li><span class="caret">'.$item->name.'</span>';
       return $ht;
    }
}
