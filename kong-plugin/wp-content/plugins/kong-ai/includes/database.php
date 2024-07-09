<?php
// Create tables and handle database operations

// Function to create necessary database tables
function kong_ai_create_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'kong_ai_tokens';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        token varchar(255) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// Function to insert a token into the database
function kong_ai_insert_token($token) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'kong_ai_tokens';
    $wpdb->insert(
        $table_name,
        array(
            'token' => $token,
        )
    );
}

// Function to retrieve the latest token from the database
function kong_ai_get_latest_token() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'kong_ai_tokens';
    return $wpdb->get_var("SELECT token FROM $table_name ORDER BY id DESC LIMIT 1");
}

// Add more database functions as needed for your plugin
