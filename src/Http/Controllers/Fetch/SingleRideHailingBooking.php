<?php

namespace Jazer\Pasakay\Http\Controllers\Fetch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SingleRideHailingBooking extends Controller
{
    public static function single(Request $request) {
        $source = DB::connection("conn_pasakay")
        ->table("rider_hailing_booking")
        ->select("reference_id", "project_refid", "branch_refid", "customer_refid", "pickup_location", 
        "dropoff_location", "distance_km", "fare_base", "fare_succeeding",
         "fare_total", "cash_tips", "booking_datetime", "booking_geolocation", "booking_remarks", 
         "rider_refid", "rider_datetime", "rider_remarks", "status")
        ->where([
            "project_refid"     => config('jtpasakayconfig.project_refid'),
            "reference_id"      => $request['reference_id']
        ])
        ->get();

        if(count($source) > 0) {
            return $source[0];
        }
        else {
            return [];
        }
    }
}


