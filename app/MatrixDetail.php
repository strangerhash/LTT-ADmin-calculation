<?php

namespace App;

use DB;

class MatrixDetail
{
    /**
     * This create a new matrix details
     *
     * @param int $matrix_id
     * @param int $position
     *
     * @return int $id //this is the id of the new created row
     */
    public function createMatrixDetail($matrix_id, $position)
    {
        return DB::table('matrix_details')
            ->insertGetId([
                'matrix_id' => $matrix_id,
                'members_id' => NULL,
                'position_on_chart' => $position,
                'date_created' => date('Y-m-d h:m:s'),
                'date_filled' => NULL,
            ]);
    }


    /** */
    public static function updateUserMatrixPosition($matrix_id, $position_on_chart, $members_id)
    {
        return DB::table('matrix_details')
                ->where('matrix_id', $matrix_id)
                ->where('position_on_chart', $position_on_chart)
                ->update([
                    'members_id' => $members_id,
                    'date_filled' => date('Y-m-d h:i:s')
                ]);
    }


    /** */
    public static function getFreeMatrixPosition($matrix_id)
    {
        return DB::table('matrix_details')
                ->where('matrix_id', $matrix_id)
                ->where('members_id', NULL)
                ->orderBy('position_on_chart', 'asc')
                ->limit(1)
                ->first();
    }
}
