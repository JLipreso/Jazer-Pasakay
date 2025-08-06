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
       
    ]);

    $pickupData = $request['pickup_location'];
    $pickupgeolocation = $pickupData['geolocation'];
    $pickupString = implode(',', $pickupgeolocation);

    $dropoffData = $request['dropoff_location'];
    $dropoffgeolocation = $dropoffData['geolocation'];
    $dropoffString = implode(',', $dropoffgeolocation);

        $getDistanceKM = \Jazer\Pasakay\Http\Controllers\Utility\GoogleMapMatrix::getDistance(
            $pickupString,$dropoffString);
    

        $source = DB::connection("conn_pasakay")
        ->table("rider_hailing_config")
        ->select("fare_base", "fare_succeeding")
        ->where([
            "project_refid"     => config('jtpasakayconfig.project_refid'),
            "branch_refid"      => $request['branch_refid']
        ])
        ->first();

        if($source) {
            $cashTips = $request['cash_tips'] ?? 0;
            $fareTotal = 0;
            $fareBase = $source->fare_base;
            $fareSucceeding = $source->fare_succeeding;
            $distanceKM = $getDistanceKM['distance_value'];         
            if($distanceKM > 1) {
                  $fareTotal = ($fareSucceeding * $distanceKM) + $fareBase + $cashTips - $fareSucceeding;
            }else {
                  $fareTotal = $fareBase + $cashTips;
            }     
            

             $submitted = DB::connection("conn_pasakay")->table("rider_hailing_booking")->insert([
                "project_refid"          => config('jtpasakayconfig.project_refid'),
                "reference_id"           => \Jazer\Pasakay\Http\Controllers\Utility\ReferenceID::create('RHB'),
                "branch_refid"           => $request['branch_refid'],
                "customer_refid"         => $request['customer_refid'],
                "pickup_location"        => json_encode($request['pickup_location']),
                "dropoff_location"       => json_encode($request['dropoff_location']),
                "distance_km"            => $distanceKM,
                "fare_base"              => $fareBase,
                "fare_succeeding"        => $fareSucceeding,
                "fare_total"             => $fareTotal,
                "cash_tips"              => $cashTips,
                "booking_datetime"       => Carbon::now(),
                "booking_geolocation"    => json_encode($pickupgeolocation),
                "booking_remarks"        => $request['booking_remarks'], 
                "status"                 => 'NEW'
            ]);

            if($submitted) {
                return [
                    "success"   => true,
                    "message"   => "Successfully rider hailing booking created."
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Failed to create rider hailing booking."
                ];
            }
        }
        else {
            return [
                    "success"   => false,
                    "message"   => "Failed to create rider hailing booking."
                ];
        }
        
           
        
    }
}