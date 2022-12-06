<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Exception;
use Illuminate\Support\Facades\Http;

class GA4MeasurementProtocol
{
    private string $clientId = '';
    private string $sessionId = '';

    private bool $debugging = false;

    public function __construct()
    {
        if (config('google-analytics-4-measurement-protocol.measurement_id') === null
            || config('google-analytics-4-measurement-protocol.api_secret') === null
        ) {
            throw new Exception('Please set .env variables for Google Analytics 4 Measurement Protocol as per the readme file first.');
        }
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function enableDebugging(): self
    {
        $this->debugging = true;

        return $this;
    }

    public function postEvent(array $eventData): array
    {
        $unset_session_at_the_end = false;
        // if client id is not set, generate a random one to post the event anyway and not throw an error
        if(session(config('google-analytics-4-measurement-protocol.client_id_session_key')) === null) {
            session([config('google-analytics-4-measurement-protocol.client_id_session_key') => $this->generateRandomId()]);
            $unset_session_at_the_end = true;
        }

        // if session id is not set, generate a random one to post the event anyway and not throw an error
        if(session(config('google-analytics-4-measurement-protocol.session_id_session_key')) === null) {
            session([config('google-analytics-4-measurement-protocol.session_id_session_key') => $this->generateRandomId()]);
            $unset_session_at_the_end = true;
        }
        if (!$this->clientId && !$this->clientId = session(config('google-analytics-4-measurement-protocol.client_id_session_key'))) {
            throw new Exception('Please use the package provided blade directive or set client_id manually before posting an event.');
        }

        if(!$this->sessionId && !$this->sessionId = session(config('google-analytics-4-measurement-protocol.session_id_session_key'))){

            throw new Exception('Please use the package provided blade directive or set session_id manually before posting an event.');
        }
        else {
            $eventData['params']['session_id'] = $this->sessionId;
        }


        $response = Http::withOptions([
            'query' => [
                'measurement_id' => config('google-analytics-4-measurement-protocol.measurement_id'),
                'api_secret' => config('google-analytics-4-measurement-protocol.api_secret'),
            ],
        ])->post($this->getRequestUrl(), [
            'client_id' => $this->clientId,
            'events' => [$eventData],
        ]);

        if ($this->debugging) {
            return $response->json();
        }

        if($unset_session_at_the_end) {
            session()->forget(config('google-analytics-4-measurement-protocol.client_id_session_key'));
            session()->forget(config('google-analytics-4-measurement-protocol.session_id_session_key'));
        }

        return [
            'status' => $response->successful()
        ];
    }

    private function getRequestUrl(): string
    {
        $url = 'https://www.google-analytics.com';
        $url .= $this->debugging ? '/debug' : '';

        return $url.'/mp/collect';
    }

    private function generateRandomId(): string
    {
        return bin2hex(random_bytes(16));
    }
}
