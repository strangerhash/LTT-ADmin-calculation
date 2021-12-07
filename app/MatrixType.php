<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class MatrixType extends Model
{

    protected $table = 'matrix_types';
    /**
     * This returns a matrix type based on the input parameter
     *
     * @param int $code // this accepts the variable current_matrix
     * @return DB
     */
    public function getOneMatrixType($code)
    {
        return DB::table('matrix_types')->where('code', $code)->first();
    }
}
