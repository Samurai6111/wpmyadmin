<?php
global $wpdb;

/*--------------------------------------------------
/* 変数
/*------------------------------------------------*/
$sanitized_GET = mywpdb_sanitize_array($_GET);
$sanitized_where_GET = mywpdb_sanitize_array($_GET['where']);
// ---------- $s ----------
$s = esc_attr($sanitized_GET['s']);

// ---------- リミット ----------
$limit = 25;

// ---------- ページ ----------
if (esc_attr($sanitized_GET['page_num'])) {
  $page_num = esc_attr($sanitized_GET['page_num']);
} else {
  $page_num = 1;
}
// ---------- オフセット ----------
if (esc_attr($sanitized_GET['page'])) {
  $offset = ($page_num * $limit) - $limit;
} else {
  $offset = 0;
}


/*--------------------------------------------------
/* テーブル周りの変数
/*------------------------------------------------*/
if ('GET' === $_SERVER['REQUEST_METHOD']) {
  $page_esc = esc_attr($sanitized_GET["page"]);
  $tableName = esc_attr($sanitized_GET["table"]);
  $where_array = mywpdb_escape_array($sanitized_where_GET);
}

// ---------- 全テーブル一覧 ----------
$allTables_array = $wpdb->get_results("SHOW TABLES LIKE '%'");


// ---------- 共通 ----------
$table_cols = $wpdb->get_col("DESC {$tableName}", 0);

// ---------- table ----------
$table = $wpdb->get_results("SELECT * FROM $tableName LIMIT $limit OFFSET $offset", ARRAY_A);

// ---------- カウント ----------
$row_count = count($wpdb->get_results("SELECT * FROM $tableName", ARRAY_A));
$page_count = $row_count / $limit;

// ---------- row ----------
$where_key = (!empty($where_array)) ? array_key_first($sanitized_where_GET) : '';
$table_row = $wpdb->get_results('SELECT * FROM ' . $tableName . ' WHERE ' .  $where_key . ' = '  . '"' . $sanitized_where_GET[$where_key] . '" ', ARRAY_A);
