<?php

namespace Jazer\Pasakay\Http\Controllers\Create;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiderHailingConfig extends Controller
{
    public static function create(Request $request) {

       $request->validate([   
        'branch_refid'     => 'required',
        'fare_base'       => 'required|numeric',
        'fare_succeeding'     => 'required|numeric',
    ]);

      $submitted = DB::connection("conn_pasakay")->table("rider_hailing_config")->insert([
                "project_refid"          => config('jtpasakayconfig.project_refid'),
                "reference_id"           => \Jazer\Pasakay\Http\Controllers\Utility\ReferenceID::create('RHC'),
                "branch_refid"              => $request['branch_refid'],
                "fare_base"              => $request['fare_base'],
                "fare_succeeding"        => $request['fare_succeeding'],
                "open"                   => 0
            ]);

            if($submitted) {
                return [
                    "success"   => true,
                    "message"   => "Successfully rider hailing config created."
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Failed to create rider hailing config."
                ];
            }
    }
}