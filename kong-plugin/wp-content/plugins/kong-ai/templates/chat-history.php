<div class="wrap">
    <h1>Chat History</h1>
    <?php
    $token = get_option('kong_ai_token');
    if ($token) {
        $iframe_url = 'https://kong.ai/chat-history?token=' . esc_attr($token);
        echo '<iframe src="' . $iframe_url . '" style="width: 100%; height: 500px;"></iframe>';
    } else {
        echo '<p>Please login first to view the chat history.</p>';
    }
    ?>
</div>
