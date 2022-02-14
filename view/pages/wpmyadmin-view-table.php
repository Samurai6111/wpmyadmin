<?php
include($wpmyadmin_path . "/controller/wpmyadmin-controller-table.php");
include($wpmyadmin_path . "/model/wpmyadmin-model-actions.php");
?>

<h1><?php wpmyadmin_breadcrumb() ?></h1>
<table class="wpmyadminTable">
  <tr class="wpmyadminTable__tr">
    <th class="wpmyadminTable__head">action</th>

    <?php foreach ($table_cols as $table_colName) { ?>
    <th class="wpmyadminTable__head"><?php echo $table_colName ?></th>
    <?php } ?>
  </tr>

  <?php foreach ($table as $table_values) {
    $first_key = array_key_first($table_values);
    $first_value = $table_values[$first_key];
  ?>
  <tr class="wpmyadminTable__tr">
    <td class="wpmyadminTable__desc">
      <div class="wpmyadminTable__flex">

        <form action="<?php echo wpmyadmin_get_current_link() ?>"
              method="POST">
          <input type="hidden"
                 name="wpmyadmin_delete">
          <input type="hidden"
                 name="get_current_link"
                 value="<?php echo wpmyadmin_get_current_link() ?>">
          <input type="hidden"
                 name="table_key"
                 value="<?php echo $first_key ?>">
          <input type="hidden"
                 name="table_name"
                 value="<?php echo $tableName ?>">
          <input type="hidden"
                 name="table_value"
                 value="<?php echo $first_value ?>">

          <button type="submit"
                  class="-error"
                  onclick="confirm_to_submit()">削除</button>
        </form>

        <form action="<?php get_admin_url() ?>"
              method="GET">
          <?php wpmyadmin_GETS() ?>

          <button type="submit"
                  name="where[<?php echo $first_key ?>]"
                  value="<?php echo $first_value ?>">編集</button>
        </form>
      </div>
    </td>
    <?php foreach ($table_values as $table_value) {
        $table_value = strip_tags($table_value);
        $table_value = mb_substr($table_value, 0, 100);
      ?>
    <td class="wpmyadminTable__desc"><?php echo $table_value ?></td>
    <?php } ?>
  </tr>
  <?php } ?>
</table>

<?php wpmyadmin_pagination($page_count) ?>