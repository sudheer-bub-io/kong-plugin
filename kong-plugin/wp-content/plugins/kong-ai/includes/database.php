<?php
// Create custom table on plugin activation
function kong_ai_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'kong_ai_users';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        password varchar(255) NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'kong_ai_create_table');
?>
