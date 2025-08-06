<?php

namespace Jazer\Pasakay\Http\Controllers\Fetch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PaginateRideHailingBooking extends Controller
{
    public static function paginate(Request $request) {
        $query = DB::connection("conn_pasakay")->table("rider_hailing_booking")
        ->where("project_refid", config('jtpasakayconfig.project_refid'));

    if (!empty($request['search'])) {
        $search = $request['search'];
        $query->where(function ($q) use ($search) {
            $q->where('reference_id', 'like', "%{$search}%")
            ->orWhere('customer_refid', 'like', "%{$search}%")
            ->orWhere('rider_refid', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%");
        });
    }
   $query->orderByRaw("CASE WHEN status = 'NEW' THEN 0 ELSE 1 END")
      ->orderBy("status", "desc"); // optional second ordering
    return $query->paginate(config('jtpasakayconfig.fetch_paginate_max'));
   }
}