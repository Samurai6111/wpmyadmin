<?php
// include($mywpdb_path . "/controller/mywpdb-controller-table.php");
include($mywpdb_path . "/model/mywpdb-model-actions.php");
?>

<h1><?php mywpdb_breadcrumb() ?></h1>
<table class="mywpdbTable">
  <tr class="mywpdbTable__tr">
    <th class="mywpdbTable__head">action</th>

    <?php foreach ($table_cols as $table_colName) { ?>
      <th class="mywpdbTable__head"><?php echo esc_html($table_colName) ?></th>
    <?php } ?>
  </tr>

  <?php foreach ($table as $table_values) {
    $first_key = array_key_first($table_values);
    $first_value = $table_values[$first_key];
  ?>
    <tr class="mywpdbTable__tr">
      <td class="mywpdbTable__desc">
        <div class="mywpdbTable__flex">

          <form action="<?php echo mywpdb_get_current_link() ?>" method="POST" id="tableRowDelete">
            <input type="hidden" name="mywpdb_delete">
            <input type="hidden" name="get_current_link" value="<?php echo mywpdb_get_current_link() ?>">
            <input type="hidden" name="table_key" value="<?php echo esc_attr($first_key) ?>">
            <input type="hidden" name="table_name" value="<?php echo esc_attr($tableName) ?>">
            <input type="hidden" name="table_value" value="<?php echo esc_attr($first_value) ?>">

            <button type="button" class="-error" form="tableRowDelete" onclick="mywpdb_confirm_to_submit(event)">削除</button>
          </form>

          <form action="<?php echo get_admin_url() ?>" method="GET">
            <?php mywpdb_GETS() ?>

            <button type="submit" name="where[<?php echo esc_attr($first_key) ?>]" value="<?php echo esc_attr($first_value) ?>">編集</button>
          </form>
        </div>
      </td>
      <?php foreach ($table_values as $table_value) {
        $table_value = strip_tags($table_value);
        $table_value = mb_substr($table_value, 0, 100);
      ?>
        <td class="mywpdbTable__desc"><?php echo esc_html($table_value) ?></td>
      <?php } ?>
    </tr>
  <?php } ?>
</table>

<?php mywpdb_pagination($page_count) ?>


<script>
  function mywpdb_confirm_to_submit(e) {
    (function($) {
      target = e.target;
      if (window.confirm("データを削除しますか？")) {
        formID = $(target).attr("form");
        $("#" + formID).submit();
      } else {}
    })(jQuery);
  }
</script>
