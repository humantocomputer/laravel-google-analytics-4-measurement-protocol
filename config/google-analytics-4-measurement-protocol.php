<?php

return [
    'measurement_id' => env('MEASUREMENT_ID', null), # Same as Google Analytics Tracking ID

    'api_secret' => env('MEASUREMENT_PROTOCOL_API_SECRET', null),

    'client_id_session_key' => 'google-analytics-4-measurement-protocol.client_id',

    'session_id_session_key' => 'google-analytics-4-measurement-protocol.session_id',

    'session_number_session_key' => 'google-analytics-4-measurement-protocol.session_number'
];
