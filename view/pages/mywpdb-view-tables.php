<?php

?>
<h1>テーブル一覧</h1>

<form class="mywpdb__form" action="<?php echo get_admin_url() ?>" method="GET">
  <?php mywpdb_GETS() ?>

  <table class="mywpdbTable">
    <?php
    // global $allTables_array;
    foreach ($allTables_array as $tableNames) { ?>
      <tr class="mywpdbTable__tr">
        <td class="mywpdbTable__head">
          <?php
          foreach ($tableNames as $tableName) {
          ?>
            <button class="mywpdb__formButton" type="submit" name="table" value="<?php echo esc_attr($tableName) ?>"><?php echo esc_html($tableName) ?></button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </table>
</form>
