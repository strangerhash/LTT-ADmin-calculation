<?php

namespace App\Traits;

use App\Helpers;

/**
 * Handles re-usable codes for paystack controller
 */
trait PaystackTrait
{

    /**
     * return paystack charge on a particular amount
     */

    public static function getPaystackCharge($amount)
    {
        $paystack_percent_charge = (float) Helpers::settings('paystack_percent_charge');
        $paystack_flat_fee = (float) Helpers::settings('paystack_flat_fee');

        // Paystack do not charge #100 on amount below 2500
        if ($amount < 2500)
            return ($paystack_percent_charge * $amount);
        else
            return (($paystack_percent_charge * $amount) + $paystack_flat_fee);
    }

    /**
     * return paystack charge on a particular amount
     */

    public static function getPaystackChargeOnly($amount)
    {
        $paystack_percent_charge = (float) Helpers::settings('paystack_percent_charge');
        $paystack_flat_fee = (float) Helpers::settings('paystack_flat_fee');

        // Paystack do not charge #100 on amount below 2500
        if ($amount < 2500)
            return ($paystack_percent_charge * $amount);
        else
            return ($amount - $paystack_flat_fee) / $paystack_percent_charge;
    }
}
