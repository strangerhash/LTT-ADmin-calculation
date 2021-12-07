<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Matrix;

use App\GraphData;
use App\User;
use App\users;
use Illuminate\Support\Facades\DB;

class MatrixController extends Controller

{



    /**

     * Confirm if pin inputed by the user exist and has been used

     *

     * @param  string  $sponsor: where $sponsor is pin_unique_value

     * @return boolean

     */

    public static function doesSponsorExist($sponsor)

    {

        $sponsor = Matrix::doesSponsorExist($sponsor);



        if( empty($sponsor) || $sponsor == NULL ){

            return false;

        }else{

            return true;

        }

    }



    /**

     * Get the real parent and position of new registration

     *

     * @param  int  $number_of_children

     * @param  array  $data

     * @return boolean

     */

    public static function getRealParentAndPosition($free_spaces, $data)

    {

        $result = [];



        $number_of_children = $free_spaces->value('no_of_children');

        $real_parent = $free_spaces->value('pin_unique_value');



        if($number_of_children == 0){

            array_push($result, ["parent" => $real_parent, "position" => "L"]);



        }elseif ($number_of_children == 1) {

            array_push($result, ["parent" => $real_parent, "position" => "R"]);



        }elseif ($number_of_children == 2) {

            dd("default 2");

        }else{

            dd("default 3");

        }



        return $result;

    }





    /**

     * Get the real parent and position of new registration

     *

     * @param  int  $number_of_children

     * @param  array  $data

     * @return boolean

     */

    public static function getRealParentAndPositionTrinary($free_spaces)

    {

        $result = [];



        $number_of_children = $free_spaces->value('no_of_children');

        $real_parent = $free_spaces->value('pin_unique_value');



        if($number_of_children == 0){

            array_push($result, ["parent" => $real_parent, "position" => "L"]);



        }elseif ($number_of_children == 1) {

            array_push($result, ["parent" => $real_parent, "position" => "M"]);



        }elseif ($number_of_children == 2) {

            array_push($result, ["parent" => $real_parent, "position" => "R"]);

        }else{

            dd("default 3");

        }



        return $result;

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

