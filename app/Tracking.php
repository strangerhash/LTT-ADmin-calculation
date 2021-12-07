<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tracking extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id', 'ip_address','date_created'
    ];


  public function tracking_users(){


  		$results =  DB::select('select * from tracking');
  		return count($results);


  }



}
