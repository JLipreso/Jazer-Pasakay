<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FailRideHailingBooking extends Controller
{
   public function fail(Request $request) {
        $request->validate([
        'reference_id'   => 'required', 
        'rider_remarks'   => 'required',    
        ]);
        
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_booking")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "status"           => 'FAI',
                "rider_remarks"    => $request['rider_remarks']
            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully ride hailing booking failed."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to fail ride hailing booking."
            ];
        }
    }
}