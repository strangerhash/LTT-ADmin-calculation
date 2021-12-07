<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class MatrixThrift extends Model
{
    /**
     * Count how many matrix_thift user has
     *
     * @param int $id ID of the MT owner
     *
     * @return int $count
     */
    public static function count(int $id)
    {
        $count = User::where('is_matrix_thrift', $id)->count();
        return $count;
    }
}
