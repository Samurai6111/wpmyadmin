<?php
global $allTables_array, $wpdb, $table_cols, $tableName;
$s = mywpdb_validation($sanitized_GET["s"]);

if ($s) {
  $search_ketword = $s;
} else {
  $search_ketword = 'なし';
}
