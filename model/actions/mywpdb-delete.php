<?php

if (isset($_POST['mywpdb_delete'])) {
  $sanitize = mywpdb_sanitize_array($_POST);
  $tableName = esc_attr($sanitize['table_name']);
  $table_key = esc_attr($sanitize['table_key']);
  $table_value = esc_attr($sanitize['table_value']);
  $get_current_link = urlencode($sanitize['get_current_link']);

  $deletes = $wpdb->delete($tableName, [$table_key => $table_value]);
  wp_safe_redirect(mywpdb_get_current_link());
}
