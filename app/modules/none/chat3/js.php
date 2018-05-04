<script type="text/javascript">
    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    };

    function subscribe(channel) {
        conn.send(JSON.stringify({command: "subscribe", channel: channel}));
    }

    function sendMessage(msg) {
        conn.send(JSON.stringify({command: "message", message: msg}));
    }
</script>