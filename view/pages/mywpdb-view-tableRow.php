<?php
// include($mywpdb_path . "/controller/mywpdb-controller-tableRow.php");
include($mywpdb_path . "/model/actions/mywpdb-update.php");
?>

<h1><?php mywpdb_breadcrumb() ?></h1>
<br>

<form action="<?php echo mywpdb_get_current_link() ?>" method="POST">


  <table class="mywpdbTable -w100">
    <?php foreach ($table_row[0] as $table_key => $table_value) {

      $letter_count = mb_strlen($table_value);

    ?>
      <tr class="mywpdbTable__tr">
        <th class="mywpdbTable__head -tal"><?php echo esc_html($table_key) ?></th>
        <td class="mywpdbTable__desc -w100">

          <?php if ($letter_count > 200) { ?>
            <textarea name="<?php echo esc_attr($table_key) ?>" id="" cols="30" rows="10"><?php echo esc_attr($table_value) ?></textarea>
          <?php } else { ?>
            <input type="text" name="<?php echo esc_attr($table_key) ?>" value="<?php echo esc_attr($table_value) ?>">
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </table>

  <br>
  <button class="-btn" name="mywpdbUpdateTrigger">変更する</button>
</form>
