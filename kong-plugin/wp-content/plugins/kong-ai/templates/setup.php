<div class="wrap">
    <h1>LogIn</h1>
    <form id="kong-ai-setup-form" method="post" action="">
        <input type="hidden" name="kong_ai_setup_form" value="1">
        <div class="kong-ai-form-field">
            <label for="kong_ai_email">Email:</label>
            <input type="email" id="kong_ai_email" name="kong_ai_email" required>
        </div>
        <div class="kong-ai-form-field">
            <label for="kong_ai_password">Password:</label>
            <input type="password" id="kong_ai_password" name="kong_ai_password" required>
        </div>
        <div class="kong-ai-form-field">
            <input type="submit" value="Login / Signup">
        </div>
    </form>
    <?php
    if (isset($_POST['kong_ai_setup_form'])) {
        $email = sanitize_email($_POST['kong_ai_email']);
        $password = sanitize_text_field($_POST['kong_ai_password']);

        // Perform API request to Kong.ai to get the token
        $response = wp_remote_post('https://kong.ai/api/login', [
            'body' => json_encode(['email' => $email, 'password' => $password]),
            'headers' => ['Content-Type' => 'application/json']
        ]);

        if (is_wp_error($response)) {
            echo '<p class="kong-ai-error">There was an error logging in. Please try again.</p>';
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (isset($data['token'])) {
                // Store the token in the database
                update_option('kong_ai_token', $data['token']);
                echo '<p class="kong-ai-success">Logged in successfully. Your bot is now live.</p>';
                // Add the script to the website header/footer
                add_action('wp_head', 'add_kong_ai_script');
            } else {
                echo '<p class="kong-ai-error">Invalid email or password. Please try again.</p>';
            }
        }
    }
    ?>
</div>
