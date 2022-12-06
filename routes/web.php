<?php

use Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers\StoreGoogleAnalyticsClientIdController;
use Illuminate\Support\Facades\Route;

Route::post('store-google-analytics-client-id', StoreGoogleAnalyticsClientIdController::class);
Route::post('store-google-analytics-session-id', StoreGoogleAnalyticsSessionIdController::class);