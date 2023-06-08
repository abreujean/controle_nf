<?php

namespace App\Http\Controllers;

use App\Models\Mei;
use Illuminate\Http\Request;

class MeiController extends Controller
{

    public static $FIRST_REGISTER = 1;


    /**
     * Function to list mei in system
     * @return JsonResponse
     */
    public function listMei(): object
    {
        $mei = Mei::all();
        return $mei;
    }

    /**
     * Function to retrieve mei data.
     * @param $codhash
     * @return object
     */
    public function recoverMeiDataByCodhash($codhash) : object
    {
        $mei = mei::where('codhash', $codhash)->get();
        return $mei;
    }

    /**
     * Function to retrieve mei id by codhash
     * @param placa
     * @return boolean
     */
    public function recoverIDByCodHashMei($codhash): int
    {
        $mei = Mei::where('codhash', $codhash)->get();
        return $mei[0]->id;
    }

        /**
     * Function to update mei data.
     */
    public function updateMei($codhash, $max_value ) : void
    {
        Mei::where('codhash', $codhash)->update(['max_value' => $max_value]);
    }


    /**
     * Function to retrieve mei data.
     * @param $codhash
     * @return float
     */
    public function recoverMaxValueMeiData() : string
    {
        $mei = mei::where('id', MeiController::$FIRST_REGISTER)->get();
        return $mei[0]->max_value;
    }
}
