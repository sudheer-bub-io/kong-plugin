<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function kong_ai_admin_enqueue_scripts() {
    wp_enqueue_style('kong-ai-admin-styles', KONG_AI_PLUGIN_URL . 'assets/css/admin-styles.css');
    wp_enqueue_script('kong-ai-admin-scripts', KONG_AI_PLUGIN_URL . 'assets/js/admin-scripts.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'kong_ai_admin_enqueue_scripts');
