<?php
define('SAVEQUERIES', true);

global $wpdb;

/*--------------------------------------------------
/* 変数
/*------------------------------------------------*/
// ---------- $s ----------
$s = esc_attr($_GET['s']);
// ---------- リミット ----------
$limit = 25;

// ---------- ページ ----------
if (esc_attr($_GET['page_num'])) {
  $page_num = esc_attr($_GET['page_num']);
} else {
  $page_num = 1;
}
// ---------- オフセット ----------
if (esc_attr($_GET['page'])) {
  $offset = ($page_num * $limit) - $limit;
} else {
  $offset = 0;
}

/*--------------------------------------------------
/* テーブル周りの変数
/*------------------------------------------------*/
// ---------- 全テーブル一覧 ----------
$allTables_array = $wpdb->get_results("SHOW TABLES LIKE '%'");

// ---------- 共通 ----------
$page_esc = esc_attr($_GET["page"]);
$tableName = esc_attr($_GET["table"]);
$table_cols = $wpdb->get_col("DESC {$tableName}", 0);

// ---------- table ----------
$table = $wpdb->get_results("SELECT * FROM $tableName LIMIT $limit OFFSET $offset", ARRAY_A);

// ---------- カウント ----------
$row_count = count($wpdb->get_results("SELECT * FROM $tableName", ARRAY_A));
$page_count = $row_count / $limit;

// ---------- row ----------
$where_array = wpmyadmin_escape_array($_GET['where']);
$where_key = (!empty($where_array)) ? array_key_first($_GET['where']) : '';
$table_row = $wpdb->get_results('SELECT * FROM ' . $tableName . ' WHERE ' .  $where_key . ' = '  . '"' . $_GET['where'][$where_key] . '" ', ARRAY_A);