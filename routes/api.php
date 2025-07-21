<?php

use Illuminate\Support\Facades\Route;
use Jazer\Pasakay\Http\Controllers\Create\RiderHailingBooking;


Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'ride-hailing-booking'], function () {          
        Route::post('create', [RiderHailingBooking::class, 'create']);
    });
   
});

