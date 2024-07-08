<div class="wrap">
    <h1>Kong.ai Training</h1>
    <form method="post" action="">
        <div class="kong-ai-form-field">
            <label for="kong_ai_website">Website URL:</label>
            <input type="url" id="kong_ai_website" name="kong_ai_website" value="<?php echo get_site_url(); ?>" required>
        </div>
        <div class="kong-ai-form-field">
            <input type="submit" value="Train Bot">
        </div>
    </form>
    <?php
    if (isset($_POST['kong_ai_website'])) {
        $website = esc_url($_POST['kong_ai_website']);
        $token = get_option('kong_ai_token');
        echo '<li>Hashed Password: ' . esc_html($token) . '</li>';
        if ($token) {
            // Perform API request to Kong.ai to train the bot
            $response = wp_remote_post('https://kong.ai/api/train', [
                'body' => json_encode(['website' => $website]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            if (is_wp_error($response)) {
                echo '<p class="kong-ai-error">There was an error training the bot. Please try again.</p>';
            } else {
                echo '<p class="kong-ai-success">The bot is successfully trained with your website.</p>';
            }
        } else {
            echo '<p class="kong-ai-error">Please login first to train the bot.</p>';
        }
    }
    ?>
</div>
