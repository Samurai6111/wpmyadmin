<?php
global $allTables_array, $wpdb, $table_cols, $tableName;
$s = wpmyadmin_validation($_GET["s"]);

if ($s) {
  $search_ketword = $s;
} else {
  $search_ketword = 'なし';
}