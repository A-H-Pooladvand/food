<?php

use App\Http\Controllers\Order\V1\VendorDelayReport;
use App\Http\Controllers\Order\V1\AssignDelayController;
use App\Http\Controllers\Order\V1\DelayReportController;

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::group(['prefix' => '{order_id}'], function () {
            Route::group(['prefix' => 'delays', 'as' => 'delay.'], function () {
                Route::post('report', DelayReportController::class)->name('report');
                Route::post('assign', AssignDelayController::class)->name('assign');
                Route::get('vendor-report', VendorDelayReport::class)->name('vendor-report');
            });
        });
    });
});

