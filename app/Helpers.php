<?php

namespace App;

use Cache;
use App\Traits\PaystackTrait;
use Hashids\Hashids;

class Helpers
{
    use PaystackTrait;

    /**
     * fetch cached setting from database
     *
     * @return string
     */
    public static function settings($key)
    {
        static $settings;

        // Cache::flush();

        if (is_null($settings)) {
            $settings = Cache::remember('settings', 24 * 60, function () {
                return array_pluck(Setting::all()->toArray(), '_value', '_key');
            });
        }

        return (is_array($key)) ? array_only($settings, $key) : $settings[$key];
    }

    public static function getChargedAmount($key)
    {
        $item_amount = self::settings($key);
        return $item_amount + self::getPaystackCharge($item_amount);
    }

    public static function encodeId($id)
    {
        $hash = new Hashids('iscube newtworks', 10);
        return $hash->encode($id);
    }

    public static function decodeId($id)
    {
        $hash = new Hashids('iscube newtworks', 10);
        return $hash->decode($id)[0];
    }
}
