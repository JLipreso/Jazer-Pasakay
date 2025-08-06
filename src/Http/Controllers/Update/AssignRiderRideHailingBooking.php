<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AssignRiderRideHailingBooking extends Controller
{
   public function assignrider(Request $request) {
        
        $request->validate([
        'reference_id'   => 'required', 
        'rider_refid'   => 'required',      
        ]);
    
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_booking")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "rider_refid"            => $request['rider_refid'],
                "rider_datetime"         => Carbon::now(),
                "rider_remarks"          => $request['rider_remarks'],
                "status"                 => 'ASG'

            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully ride hailing booking assigned rider."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to assign rider ride hailing booking."
            ];
        }
    }
}