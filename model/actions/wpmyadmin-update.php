<?php
/*--------------------------------------------------
/* DBの変更
/*------------------------------------------------*/
if (isset($_POST['wpmyadminUpdateTrigger'])) {
  global $wpdb;
  $table = $_GET['table'];
  $first_key = array_key_first($_POST);
  $first_value = $_POST[$first_key];

  // ---------- 最初を削除 ----------
  $shift = array_shift($_POST);

  $wpdb_update_array = [];
  foreach ($_POST as $key => $value) {
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