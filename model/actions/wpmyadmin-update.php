<?php
/*--------------------------------------------------
/* DBの変更
/*------------------------------------------------*/
if (isset($_POST['wpmyadminUpdateTrigger'])) {
  $sanitized_POST = wpmyadmin_sanitize_array($_POST);

  global $wpdb;
  $table = $sanitized_GET['table'];
  $first_key = array_key_first($sanitized_POST);
  $first_value = $sanitized_POST[$first_key];

  // ---------- 最初を削除 ----------
  $shift = array_shift($sanitized_POST);

  $wpdb_update_array = [];
  foreach ($sanitized_POST as $key => $value) {
    if ($key === 'wpmyadminUpdateTrigger') {
      continue;
    }
    $wpdb_update_array[$key] = $value;
  }

  $result = $wpdb->update(
    $table,
    $wpdb_update_array,
    [$first_key => $first_value]
  );

  wp_safe_redirect(wpmyadmin_get_current_link());
}