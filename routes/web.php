<?php

use Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers\StoreGoogleAnalyticsClientIdController;
use Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers\StoreGoogleAnalyticsSessionIdController;
use Illuminate\Support\Facades\Route;

Route::post('store-google-analytics-client-id', StoreGoogleAnalyticsClientIdController::class)->middleware('web');
Route::post('store-google-analytics-session-id', StoreGoogleAnalyticsSessionIdController::class)->middleware('web');