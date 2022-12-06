<script>

    function collectClientId() {
        gtag('get', "{{ config('google-analytics-4-measurement-protocol.measurement_id') }}", 'client_id', function (clientId) {
            postClientId(clientId);
        });
    }

    function collectSessionId() {
        gtag('get', "{{ config('google-analytics-4-measurement-protocol.measurement_id') }}", 'session_id', function (sessionId) {
            postSessionId(sessionId);
        });
    }


    function postClientId(clientId) {
        var data = new FormData();
        data.append('client_id', clientId);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'store-google-analytics-client-id', false);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.send(data);
    }

    function postSessionId(sessionId) {
        var data = new FormData();
        data.append('session_id', sessionId);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'store-google-analytics-session-id', false);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.send(data);
    }

    @if (!session(config('google-analytics-4-measurement-protocol.client_id_session_key'), false))
    collectClientId();
    @endif
    @if (!session(config('google-analytics-4-measurement-protocol.session_id_session_key'), false))
    collectSessionId();
    @endif


</script>
