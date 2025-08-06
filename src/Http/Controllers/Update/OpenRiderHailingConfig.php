<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class OpenRiderHailingConfig extends Controller
{
   public function open(Request $request) {
        
        $request->validate([
            'reference_id'   => 'required', 
        ]);
    
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_config")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "open"            => 1,
            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully rider hailing config open."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to open rider hailing config."
            ];
        }
    }
}