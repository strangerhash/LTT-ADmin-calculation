<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{

    protected $table = 'matrices_';

    /**
     * Check if the sponsor is a registered member and has a matrix created
     *
     * @param  string  $value: where $value is pin_unique_value
     * @return DB
     */
    public static function doesSponsorExist($value)
    {
        return DB::table('matrices_')
            ->join('users', 'users.id', '=', 'matrices_.user_id')
            ->where('users.pin_unique_value', $value)
            ->select('matrices_.*')
            ->first();
    }

    /**
     * Create a new matrix in the matrices_ tables for the selected user.
     * @param object $user
     * @return int $matrix_id
     */
    public static function createUserMatrix($user)
    {
        return DB::table('matrices_')
            ->insertGetId([
                'user_id' => $user->id,
                'current_matrix' => $user->current_matrix,
                'is_filled' => 0,
                'total_users' => 0,
                'date_created' => date('Y-m-d h:m:s'),
            ]);
    }

    /**
     * Create a new matrix in the matrices_ tables for the selected user.
     * @param object $user
     * @return int $matrix_id
     */
    public static function _createUserMatrix($user)
    {
        return DB::table('matrices_')
            ->insertGetId([
                'user_id' => $user->id,
                'current_matrix' => $user->current_matrix,
                'quorum_'. 0 => date("Y-m-d H:i:s")
            ]);
    }

    /**
     * Update total_users as new member is registered or as a new member drops
     *
     * @param int $user_id
     * @param int $current_matrix
     * @return DB
     */
    public static function updateTotalUsers($user_id, $current_matrix)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->where('current_matrix', $current_matrix)
            ->increment('total_users');
    }

    /**
     * Get current matrix to filled
     *
     * @param int $user_id
     * @param int $current_matrix
     * @return DB
     */
    public static function getIsFilled($user_id, $current_matrix)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->where('current_matrix', $current_matrix)
            ->first()
            ->is_filled;
    }

    /**
     * Set current matrix to filled
     *
     * @param int $user_id
     * @param int $current_matrix
     * @return DB
     */
    public static function updateIsFilled($user_id, $current_matrix)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->where('current_matrix', $current_matrix)
            ->update([
                'is_filled' => 1
            ]);
    }

    /**
     * Get user's current matrix
     *
     * @param int $user_id
     * @return DB
     */
    public static function getCurrentMatrix($user_id)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->where('is_filled', 0)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
    }


    /**
     * Get all user matrices_
     *
     * @param int $user_id
     * @return DB
     */
    public static function getAllUserMatrices($user_id)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->where('is_filled', 0)
            ->get();
    }


    /**
     * Update user matrix with time and date
     * of the new matrix
     *
     * @param int $user_id
     * @return DB
     */
    public static function updateUserMatrix($user_id, $matrix_tag)
    {
        return DB::table('matrices_')
            ->where('user_id', $user_id)
            ->update([
                'current_matrix' => $matrix_tag,
                'quorum_'. $matrix_tag => date("Y-m-d H:i:s")
            ]);
    }
}
