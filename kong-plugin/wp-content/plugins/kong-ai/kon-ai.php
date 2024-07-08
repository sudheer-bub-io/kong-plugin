<?php
/*
Plugin Name: Kong.ai Integration
Description: Integrates Kong.ai with WordPress for bot setup, training, and chat history.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('KONG_AI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('KONG_AI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include admin page functions
require_once KONG_AI_PLUGIN_PATH . 'includes/admin-page.php';
require_once KONG_AI_PLUGIN_PATH . 'includes/database.php'; // Include database.php

// Hook function to add admin menu and submenu pages
add_action('admin_menu', 'kong_ai_menu');

function kong_ai_menu() {
    add_menu_page(
        'Kong.ai', 
        'Kong.ai', 
        'manage_options', 
        'kong-ai', 
        'kong_ai_dashboard', 
        plugins_url('assets/images/kong-logo.png', __FILE__), 
        6
    );    
    add_submenu_page('kong-ai', 'Setup', 'Setup', 'manage_options', 'kong-ai-setup', 'kong_ai_setup');
    add_submenu_page('kong-ai', 'Training', 'Training', 'manage_options', 'kong-ai-training', 'kong_ai_training');
    add_submenu_page('kong-ai', 'Chat History', 'Chat History', 'manage_options', 'kong-ai-chat-history', 'kong_ai_chat_history');
    // add_submenu_page('kong-ai', 'Registered Users', 'Registered Users', 'manage_options', 'kong-ai-registered-users', 'kong_ai_registered_users'); // New submenu page
}

// Function to include dashboard template
function kong_ai_dashboard() {
    include KONG_AI_PLUGIN_PATH . 'templates/home.php';
}

// Function to include setup template
function kong_ai_setup() {
    include KONG_AI_PLUGIN_PATH . 'templates/setup.php';
}

// Function to include training template
function kong_ai_training() {
    include KONG_AI_PLUGIN_PATH . 'templates/training.php';
}

// Function to include chat history template
function kong_ai_chat_history() {
    include KONG_AI_PLUGIN_PATH . 'templates/chat-history.php';
}

// Function to display registered users
// function kong_ai_registered_users() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'kong_ai_users';

//     $users = $wpdb->get_results("SELECT * FROM $table_name");

//     echo '<div class="wrap">';
//     echo '<h1>Registered Users</h1>';

//     if ($users) {
//         echo '<table class="wp-list-table widefat fixed striped">';
//         echo '<thead><tr><th>ID</th><th>Email</th></tr></thead>';
//         echo '<tbody>';

//         foreach ($users as $user) {
//             echo '<tr>';
//             echo '<td>' . esc_html($user->id) . '</td>';
//             echo '<td>' . esc_html($user->email) . '</td>';
//             echo '</tr>';
//         }

//         echo '</tbody></table>';
//     } else {
//         echo '<p>No users found.</p>';
//     }

//     echo '</div>';
// }

// Hook function to display registered users page
function kong_ai_registered_users_page() {
    // Check if the current admin page is our registered users page
    if (isset($_GET['page']) && $_GET['page'] === 'kong-ai-registered-users') {
        kong_ai_registered_users();
    }
}
add_action('admin_init', 'kong_ai_registered_users_page');

// Function to add Kong.ai script to header
function add_kong_ai_script() {
    $token = get_option('kong_ai_token');
    if ($token) {
        echo '<script id="kong-ai-script" src="https://kong.ai/script.js" data-token="' . esc_attr($token) . '"></script>';
    }
}
add_action('wp_head', 'add_kong_ai_script');
?>
