<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    // Fillable
    protected $fillable = [
        'batch_number', 'pin', 'pin_unique_value', 'date_printed', 'date_used', 'is_used'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Find pin by pin value
     *
     * @param  string  $value
     * @return DB
     */
    public static function findByPin($value)
    {
        return DB::table('pins')->where('pin', $value)->first();
    }


    /**
     * Generate Pin for upgrading user
     *
     * @param
     * @return
     */
    public static function generatePin()
    {
        $pin_count = DB::table('pins')->count();
        $pin = 'ISC00' . ($pin_count + 1);

        return Pin::create([
            'batch_number' => 'shdfsfysdf6sdfs6df6sd3sfsdf',
            'pin' => $pin,
            'pin_unique_value' => $pin,
            'date_printed' =>  null,
            'date_used' => date('Y-m-d H:i:s'),
            'is_used' => 0,
        ]);
    }
}
