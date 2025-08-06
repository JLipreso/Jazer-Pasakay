<?php

namespace Jazer\Pasakay\Http\Controllers\Delete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Task: Create a function that will delete job post
 */

class DeleteRideHailingBooking extends Controller
{
    public static function delete(Request $request) {

        $request->validate([
        'reference_id'         => 'required'
        ]);
        $deleted = DB::connection("conn_pasakay")->table("rider_hailing_booking")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id" => $request['reference_id']
            ])
            ->delete();

        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Successfully ride hailing booking deleted."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to delete ride hailing booking."
            ];
        }
    }
}