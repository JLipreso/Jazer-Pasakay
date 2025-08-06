<?php

namespace Jazer\Pasakay\Http\Controllers\Fetch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsRideHailingBooking extends Controller
{
    public static function statistics(Request $request) {
       $today = Carbon::today()->toDateString();
       $statuses = ['NEW', 'ASG', 'CNC', 'FAI'];

 
    $todaySummary = DB::connection("conn_pasakay")
        ->table("rider_hailing_booking")
        ->selectRaw("
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'NEW' THEN 1 ELSE 0 END) AS count_new,
            SUM(CASE WHEN status = 'ASG' THEN 1 ELSE 0 END) AS count_asg,
            SUM(CASE WHEN status = 'CNC' THEN 1 ELSE 0 END) AS count_cnc,
            SUM(CASE WHEN status = 'FAI' THEN 1 ELSE 0 END) AS count_fai
            ")
        ->where("project_refid", config('jtpasakayconfig.project_refid'))
        ->whereIn('status', $statuses)
        ->whereDate("booking_datetime", $today)
        ->first();


    $allTimeSummary = DB::connection("conn_pasakay")
        ->table("rider_hailing_booking")
        ->selectRaw("
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'NEW' THEN 1 ELSE 0 END) AS count_new,
            SUM(CASE WHEN status = 'ASG' THEN 1 ELSE 0 END) AS count_asg,
            SUM(CASE WHEN status = 'CNC' THEN 1 ELSE 0 END) AS count_cnc,
            SUM(CASE WHEN status = 'FAI' THEN 1 ELSE 0 END) AS count_fai            
            ")
        ->where("project_refid", config('jtpasakayconfig.project_refid'))
        ->whereIn('status', $statuses)
        ->first();

       return response()->json([
            'today_summary' => [
                'booking_new'         => (int) $todaySummary->count_new,
                'booking_assigned'    => (int) $todaySummary->count_asg,
                'booking_cancelled'   => (int) $todaySummary->count_cnc,
                'booking_fail'        => (int) $todaySummary->count_fai,
                'booking_total_today' => (int) $todaySummary->total_bookings
            ],
            'all_time_summary' => [
                'booking_new'         => (int) $allTimeSummary->count_new,
                'booking_assigned'    => (int) $allTimeSummary->count_asg,
                'booking_cancelled'   => (int) $allTimeSummary->count_cnc,
                'booking_fail'        => (int) $allTimeSummary->count_fai,
                'booking_total'       => (int) $allTimeSummary->total_bookings
            ]
        ]);
    }
}


