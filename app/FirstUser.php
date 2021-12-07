<?php

namespace App;

use DB;

class FirstUser
{
    /**
     * Create a new matrix in the matrices tables for the selected user.
     * @param object $user
     * @return int $matrix_id
     */
    public static function createUserMatrix($user)
    {
        return DB::table('matrices_')
            ->insertGetId([
                'user_id' => $user->id,
                'current_matrix' => 0,
                'quorum_'. 0 => date("Y-m-d H:i:s")
                // 'is_filled' => 0,
                // 'total_users' => 0,
                // 'date_created' => date('Y-m-d h:m:s'),
            ]);
    }
}
