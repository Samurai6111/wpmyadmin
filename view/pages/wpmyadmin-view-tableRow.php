<?php
// include($wpmyadmin_path . "/controller/wpmyadmin-controller-tableRow.php");
include($wpmyadmin_path . "/model/actions/wpmyadmin-update.php");
?>

<h1><?php wpmyadmin_breadcrumb() ?></h1>
<br>

<form action="<?php echo wpmyadmin_get_current_link() ?>"
      method="POST">


  <table class="wpmyadminTable -w100">
    <?php foreach ($table_row[0] as $table_key => $table_value) {

      $letter_count = mb_strlen($table_value);

    ?>
    <tr class="wpmyadminTable__tr">
      <th class="wpmyadminTable__head -tal"><?php echo esc_html($table_key) ?></th>
      <td class="wpmyadminTable__desc -w100">

        <?php if ($letter_count > 200) { ?>
        <textarea name="<?php echo esc_attr($table_key) ?>"
                  id=""
                  cols="30"
                  rows="10"><?php echo esc_attr($table_value) ?></textarea>
        <?php } else { ?>
        <input type="text"
               name="<?php echo esc_attr($table_key) ?>"
               value="<?php echo esc_attr($table_value) ?>">
        <?php } ?>
      </td>
    </tr>
    <?php } ?>
  </table>

  <br>
  <button class="-btn"
          name="wpmyadminUpdateTrigger">変更する</button>
</form>