<?php
include($mywpdb_path . "/controller/mywpdb-controller-search.php");
?>

<h1>検索結果ページ</h1>
<h2>検索キーワード : <?php $search_ketword ?></h2>

<?php
if ($s) {
  foreach ($allTables_array as $tableNames) {
    foreach ($tableNames as $tableName) {

      // ---------- sqlのコマンドのテーブルにカラム部分 ----------
      $table_cols = $wpdb->get_col("DESC {$tableName}", 0);
      $search_table_cols = "";
      $table_col_num = 0;
      foreach ($table_cols as $table_colName) {
        $table_col_num++;
        if ($table_col_num == 1) {
          $search_table_cols .= "CONVERT(`{$table_colName}` USING utf8) LIKE '%{$s}%' ";
        } else {
          $search_table_cols .= "OR CONVERT(`{$table_colName}` USING utf8) LIKE '%{$s}%' ";
        }
      }


      // ---------- sqlのコマンド ----------
      $search_sql = "
    SELECT *
    FROM `{$tableName}` WHERE (
      $search_table_cols
    )";

      // ---------- 検索結果のコマンド ----------
      $search_results = $wpdb->get_results($search_sql, ARRAY_A);
      $search_result_count = 0;
      if ($search_results) {
        $search_result_count++;
?>
        <br>
        <h2>テーブル名 : <?php $tableName ?></h2>
        <table class="mywpdbTable">
          <tr class="mywpdbTable__tr">
            <th class="mywpdbTable__head">
              <div class="mywpdbTable__flex">修正</div>
            </th>

            <?php foreach ($table_cols as $table_colName) { ?>
              <th class="mywpdbTable__head"><?php $table_colName ?></th>
            <?php } ?>
          </tr>

          <?php
          foreach ($search_results as $table_values) {
            $first_key = array_key_first($table_values);
            $first_value = $table_values[$first_key]; ?>
            <tr class="mywpdbTable__tr">

              <td class="mywpdbTable__desc">
                <form class="mywpdbTable__flex" action="<?php get_admin_url() ?>" method="GET">
                  <?php mywpdb_GETS('search_result') ?>

                  <input type="hidden" name="table" value="<?php $tableName ?>">
                  <input type="hidden" name="where[<?php $first_key ?>]" value="<?php $first_value ?>">
                  <button type="submit"><?php "編集" ?></button>

                </form>
              </td>

              <?php
              foreach ($table_values as $table_value) {
                $table_value = strip_tags($table_value);
                $table_value = mb_substr($table_value, 0, 100);
                $table_value = str_replace($s, "<b class='-searchHighlight'>$s</b>", $table_value);
              ?>
                <td class="mywpdbTable__desc"><?php $table_value ?></td>
              <?php } ?>
            </tr>
          <?php } ?>

        </table>
      <?php } ?>
    <?php } ?>

<?php
  }
}
