<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CompleteRideHailingBooking extends Controller
{
   public function complete(Request $request) {
        $request->validate([
        'reference_id'   => 'required',     
        ]);
        
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_booking")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "status"           => 'CMD'
            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully ride hailing booking completed."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to complete ride hailing booking."
            ];
        }
    }
}