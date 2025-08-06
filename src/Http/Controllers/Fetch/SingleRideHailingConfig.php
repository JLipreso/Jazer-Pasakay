<?php

namespace Jazer\Pasakay\Http\Controllers\Fetch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SingleRideHailingConfig extends Controller
{
    public static function single(Request $request) {
        $source = DB::connection("conn_pasakay")
        ->table("rider_hailing_config")
        ->select("reference_id", "project_refid", "branch_refid", "fare_base", "fare_succeeding", 
        "open")
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


