<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers;

class StoreGoogleAnalyticsSessionNumberController
{
    public function __invoke(): void
    {
        session([config('google-analytics-4-measurement-protocol.session_number_session_key') => request('session_number')]);
    }
}

