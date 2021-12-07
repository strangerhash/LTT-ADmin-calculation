<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pin;

class PinController extends Controller
{
    /**
     * Confirm if pin inputed by the user exist and has been used
     *
     * @param  string  $pin
     * @return boolean
     */
    public static function isPinUsed($pin)
    {
        $pin = Pin::findByPin($pin);
        if( !empty($pin) ){
            if($pin->is_used == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Return the unique id of the pin
     *
     * @param  string  $pin
     * @return boolean
     */
    public static function getPinUniqueID($pin)
    {
        $pin = Pin::findByPin($pin);
        return $pin->pin_unique_value;
    }

}
