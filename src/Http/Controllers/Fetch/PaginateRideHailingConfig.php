<?php

namespace Jazer\Pasakay\Http\Controllers\Fetch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PaginateRideHailingConfig extends Controller
{
    public static function paginate(Request $request) {
        $query = DB::connection("conn_pasakay")->table("rider_hailing_config")
        ->where("project_refid", config('jtpasakayconfig.project_refid'));

    if (!empty($request['search'])) {
        $search = $request['search'];
        $query->where(function ($q) use ($search) {
            $q->where('fare_base', 'like', "%{$search}%")
            ->orWhere('fare_succeeding', 'like', "%{$search}%")
            ->orWhere('open', 'like', "%{$search}%");
        });
    }
    return $query
        ->orderBy("dataid", "desc")
        ->paginate(config('jtpasakayconfig.fetch_paginate_max'));
    }
}