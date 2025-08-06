<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CloseRiderHailingConfig extends Controller
{
   public function close(Request $request) {
        
        $request->validate([
            'reference_id'   => 'required', 
        ]);
    
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_config")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "open"            => 0,
            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully rider hailing config closed."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to close rider hailing config."
            ];
        }
    }
}