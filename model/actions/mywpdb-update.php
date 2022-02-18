<?php
/*--------------------------------------------------
/* DBの変更
/*------------------------------------------------*/
if (isset($_POST['mywpdbUpdateTrigger'])) {
  $sanitized_POST = mywpdb_sanitize_array($_POST);

  global $wpdb;
  $table = $sanitized_GET['table'];
  $first_key = array_key_first($sanitized_POST);
  $first_value = $sanitized_POST[$first_key];

  // ---------- 最初を削除 ----------
  $shift = array_shift(
    $sanitized_POST
  );

  $wpdb_update_array = [];
  foreach ($sanitized_POST as $key => $value) {
    if ($key === 'mywpdbUpdateTrigger') {
      continue;
    }
    $wpdb_update_array[$key] = $value;
  }

  $result = $wpdb->update(
    $table,
    $wpdb_update_array,
    [$first_key => $first_value]
  );

  wp_safe_redirect(mywpdb_get_current_link());
}