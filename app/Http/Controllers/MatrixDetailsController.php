<?php

namespace App\Http\Controllers;

use App\MatrixType;
use App\MatrixDetail;

class MatrixDetailsController extends Controller
{
    private $matrix_types;
    private $matrix_details;

    function __construct()
    {
        $this->matrix_types = new MatrixType();
        $this->matrix_details = new MatrixDetail();
    }

    /**
     * First user registration.
     * Create a new user instance after a valid registration.
     * @param int $current_matrix
     * @param int $matrix_id
     *
     * @return \App\User
     */
    public function buildMatrixDetails($current_matrix, $matrix_id)
    {
        // Get Number of users required to fill the current_matrix
        $matrix_type = $this->matrix_types->getOneMatrixType($current_matrix);

        // Create fields in matrix_details based on required_number
        // this fields will be filled by the users as the get into the current matrix
        for ($i=0; $i < $matrix_type->required_number; $i++) {

            $_position = $i + 1;

            $this->matrix_details->createMatrixDetail($matrix_id, $_position);
        }
    }

}
