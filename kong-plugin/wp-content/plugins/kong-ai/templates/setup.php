<div class="wrap">
    <h1>Kong.ai Setup</h1>
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
        global $wpdb;
        $table_name = $wpdb->prefix . 'kong_ai_users';
        $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));

        if ($user) {
            // User exists, check password
            if (password_verify($password, $user->password)) {
                // Login successful, generate token and proceed
                $token = hash('sha256', $email . time());
                update_option('kong_ai_token', $token);
            } else {
                echo '<p class="kong-ai-error">Invalid password. Please try again.</p>';
            }
        } else {
            // User does not exist, create new account
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $wpdb->insert($table_name, array('email' => $email, 'password' => $hashed_password));
            echo '<p class="kong-ai-success">Account created successfully. Your bot is now live.</p>';
            echo '<li>Hashed Password: ' . esc_html($hashed_password) . '</li>';

            // Generate token and proceed
            $token = hash('sha256', $email . time());
            update_option('kong_ai_token', $token);
            echo '<p>Generated Token: ' . esc_html($token) . '</p>';
        }

        // Display current database values
        $users = $wpdb->get_results("SELECT * FROM $table_name");
        echo '<h2>Current Registered Users:</h2>';
        if ($users) {
            echo '<ul>';
            foreach ($users as $user) {
                echo '<li>ID: ' . esc_html($user->id) . ' | Email: ' . esc_html($user->email) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No users found.</p>';
        }
    }
    ?>
</div>
