<?php


?>
<h1>テーブル一覧</h1>

<form class="wpmyadmin__form"
      action="<?php echo get_admin_url() ?>"
      method="GET">
  <?php wpmyadmin_GETS() ?>

  <table class="wpmyadminTable">
    <?php
    global $allTables_array;

    foreach ($allTables_array as $tableNames) { ?>
    <tr class="wpmyadminTable__tr">
      <td class="wpmyadminTable__head">
        <?php
          foreach ($tableNames as $tableName) {
          ?>
        <button class="wpmyadmin__formButton"
                type="submit"
                name="table"
                value="<?php echo $tableName ?>"><?php echo $tableName ?></button>
        <?php } ?>
      </td>
    </tr>
    <?php } ?>
  </table>
</form>