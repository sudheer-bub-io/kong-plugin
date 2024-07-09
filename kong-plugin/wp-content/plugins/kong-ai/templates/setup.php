<div class="kong-ai-iframe-container">
    <iframe id="kong-ai-iframe" src="https://dev.kong.ai/" title="Kong.ai" frameborder="0"></iframe>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var iframe = document.getElementById('kong-ai-iframe');
    // Listen for messages from the iframe
    window.addEventListener('message', function(event) {
        if (event.origin !== 'https://dev.kong.ai') {
            return; // Ignore messages not from the expected origin
        }

        // Handle the message received from the iframe
        var token = event.data.token;
        console.log('Received token from iframe:', token);

        // Save the token via AJAX to WordPress
        saveTokenToWordPress(token);
    });

    // Function to save token to WordPress via AJAX
    function saveTokenToWordPress(token) {
        var data = {
            'action': 'save_kong_ai_token',
            'token': token
        };

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Token saved:', data);
        })
        .catch(error => {
            console.error('Error saving token:', error);
        });
    }
});
</script>
