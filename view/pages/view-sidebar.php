<div class="wpmyadminSidebar">
  <form class="wpmyadmin__form" action="<?php get_admin_url() ?>" method="GET">
    <input type="hidden" name="page" value="<?php $_GET["page"] ?>">
    <?php
    foreach ($allTables_array as $tableNames) {
      foreach ($tableNames as $tableName) {
        $tableName_view = str_replace($wpdb->prefix, "", $tableName);
    ?>

        <button class="wpmyadmin__formButton <?php echo ($_GET["table"] === $tableName) ? '-current' : ''; ?>" type="submit" name="table" value="<?php $tableName ?>">wp_<?php $tableName_view ?></button>
      <?php } ?>
    <?php } ?>
  </form>
</div>
