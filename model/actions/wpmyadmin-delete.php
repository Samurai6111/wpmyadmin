<?php

if (isset($_POST['wpmyadmin_delete'])) {
  $sanitize = wpmyadmin_sanitize_array($_POST);
  $tableName = esc_attr($sanitize['table_name']);
  $table_key = esc_attr($sanitize['table_key']);
  $table_value = esc_attr($sanitize['table_value']);
  $get_current_link = urlencode($sanitize['get_current_link']);

  $deletes = $wpdb->delete($tableName, [$table_key => $table_value]);
  // wp_safe_redirect($get_current_link);
  // exit;
}