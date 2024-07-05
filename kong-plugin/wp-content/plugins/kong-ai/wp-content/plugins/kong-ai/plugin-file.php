<?php
/*
Plugin Name: Kong AI Plugin
Plugin URI: http://example.com/kong-ai-plugin
Description: A simple example plugin to demonstrate how to create a WordPress plugin.
Version: 1.0
Author: Your Name
Author URI: http://example.com
License: GPL2
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Hook for adding admin menus
add_action('admin_menu', 'kong_ai_plugin_menu');

// Action function for the above hook
function kong_ai_plugin_menu() {
    add_menu_page(
        'Kong AI Plugin Page',
        'Kong AI',
        'manage_options',
        'kong-ai-plugin',
        'kong_ai_plugin_page',
        'dashicons-admin-site-alt3',
        6
    );
}

// Function to display the plugin admin page
function kong_ai_plugin_page() {
    ?>
    <div class="wrap">
        <h1>Kong AI Plugin</h1>
        <p>Welcome to the Kong AI Plugin page.</p>
    </div>
    <?php
}

// Hook for adding content to the WordPress admin dashboard
add_action('wp_dashboard_setup', 'kong_ai_add_dashboard_widgets');

function kong_ai_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'kong_ai_dashboard_widget',
        'Kong AI Dashboard Widget',
        'kong_ai_dashboard_widget_function'
    );
}

function kong_ai_dashboard_widget_function() {
    echo '<p>Hello World! Welcome to the Kong AI Plugin dashboard widget!</p>';
}
?>
