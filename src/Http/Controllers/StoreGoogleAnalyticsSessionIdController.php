<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers;

class StoreGoogleAnalyticsSessionIdController
{
    public function __invoke(): void
    {
        session([config('google-analytics-4-measurement-protocol.session_id_session_key') => request('session_id')]);
    }
}

