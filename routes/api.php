<?php

use Illuminate\Support\Facades\Route;
use Jazer\Pasakay\Http\Controllers\Create\RiderHailingBooking;
use Jazer\Pasakay\Http\Controllers\Update\AssignRiderRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Update\CancelRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Update\CompleteRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Update\FailRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Delete\DeleteRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Fetch\PaginateRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Fetch\SingleRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Fetch\StatisticsRideHailingBooking;
use Jazer\Pasakay\Http\Controllers\Create\RiderHailingConfig;
use Jazer\Pasakay\Http\Controllers\Update\UpdateRiderHailingConfig;
use Jazer\Pasakay\Http\Controllers\Update\CloseRiderHailingConfig;
use Jazer\Pasakay\Http\Controllers\Update\OpenRiderHailingConfig;
use Jazer\Pasakay\Http\Controllers\Delete\DeleteRideHailingConfig;
use Jazer\Pasakay\Http\Controllers\Fetch\PaginateRideHailingConfig;
use Jazer\Pasakay\Http\Controllers\Fetch\SingleRideHailingConfig;

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'ride-hailing-booking'], function () {          
        Route::post('create', [RiderHailingBooking::class, 'create']);
        Route::put('assign-rider', [AssignRiderRideHailingBooking::class, 'assignrider']);
        Route::put('cancel', [CancelRideHailingBooking::class, 'cancel']);
        Route::put('complete', [CompleteRideHailingBooking::class, 'complete']);
        Route::put('fail', [FailRideHailingBooking::class, 'fail']);
        Route::delete('delete', [DeleteRideHailingBooking::class, 'delete']);
        Route::get('paginate', [PaginateRideHailingBooking::class, 'paginate']);
        Route::get('singlefetch', [SingleRideHailingBooking::class, 'single']);
        Route::get('statistics', [StatisticsRideHailingBooking::class, 'statistics']);
    });
    Route::group(['prefix' => 'ride-hailing-config'], function () {          
        Route::post('create', [RiderHailingConfig::class, 'create']);
        Route::post('update', [UpdateRiderHailingConfig::class, 'update']);
        Route::post('close',  [CloseRiderHailingConfig::class, 'close']);
        Route::post('open',   [OpenRiderHailingConfig::class, 'open']);
        Route::post('delete', [DeleteRideHailingConfig::class, 'delete']);
        Route::get('paginate', [PaginateRideHailingConfig::class, 'paginate']);
        Route::get('singlefetch', [SingleRideHailingConfig::class, 'single']);
    });
   
});

