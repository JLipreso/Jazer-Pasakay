<?php

namespace Jazer\Pasakay\Http\Controllers\Create;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiderHailingBooking extends Controller
{
    public static function create(Request $request) {

       $request->validate([   
        'branch_refid'       => 'required',
        'customer_refid'     => 'required',
        'pickup_location'    => 'required',
        'dropoff_location'   => 'required',
        'cash_tips'          => 'required|numeric',
        'status'             => 'required|in:NEW,ASG,ONG,CMD,CNC,FAI',
        ], [
            'status.in'      => 'The status field must be one of: NEW, ASG, ONG, CMD, CNC, FAI,',
    ]);
     //   $getDistanceKM = \Jazer\Pasakay\Http\Controllers\Utility\GoogleMapMatrix::getDistance(
     //       $request['pickup_location'],$request['dropoff_location']);
    

        $source = DB::connection("conn_pasakay")
        ->table("rider_hailing_config")
        ->select("fare_base", "fare_succeeding")
        ->where([
           "project_refid"     => config('jtpasakayconfig.project_refid'),
            "branch_refid"      => $request['branch_refid']
        ])
        ->get();

        if(count($source) > 0) {
             return $source[0];
        }
        else {
            return [
                    "success"   => false,
                    "message"   => "Failed to create rider hailing booking."
                ];
        }
        
           
        
    }
}