<?php
/*
Plugin Name: Kong.ai Integration
Description: Integrates Kong.ai with WordPress for bot setup, training, and chat history.
Version: 1.0
Author: kong-developers
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('KONG_AI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('KONG_AI_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once KONG_AI_PLUGIN_PATH . 'includes/admin-page.php';

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
}

function kong_ai_dashboard() {
    include KONG_AI_PLUGIN_PATH . 'templates/home.php';
}

function kong_ai_setup() {
    include KONG_AI_PLUGIN_PATH . 'templates/setup.php';
}

function kong_ai_training() {
    include KONG_AI_PLUGIN_PATH . 'templates/training.php';
}

function kong_ai_chat_history() {
    include KONG_AI_PLUGIN_PATH . 'templates/chat-history.php';
}

function add_kong_ai_script() {
    $token = get_option('kong_ai_token');
    if ($token) {
        echo '<script id="kong-ai-script" src="https://kong.ai/script.js" data-token="' . esc_attr($token) . '"></script>';
    }
}

add_action('wp_head', 'add_kong_ai_script');

function kong_ai_enqueue_admin_styles() {
    wp_enqueue_style('kong-ai-admin-style', plugins_url('assets/css/admin-styles.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'kong_ai_enqueue_admin_styles');
