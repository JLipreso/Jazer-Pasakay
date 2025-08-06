<?php

namespace Jazer\Pasakay\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UpdateRiderHailingConfig extends Controller
{
   public function update(Request $request) {
        
        $request->validate([
            'reference_id'   => 'required', 
            'branch_refid'     => 'required',
            'fare_base'       => 'required|numeric',
            'fare_succeeding'     => 'required|numeric',
        ]);
    
       $updated = DB::connection("conn_pasakay")->table("rider_hailing_config")
            ->where([
                "project_refid"  => config('jtpasakayconfig.project_refid'),
                "reference_id"   => $request['reference_id']
            ])
            ->update([
                "branch_refid"         => $request['branch_refid'],
                "fare_base"            => $request['fare_base'],
                "fare_succeeding"      => $request['fare_succeeding']
            ]);

        if($updated) {
            return [
                "success"   => true,
                "message"   => "Successfully rider hailing config."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Failed to update rider hailing config."
            ];
        }
    }
}