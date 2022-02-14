<div class="wpmyadmin">
  <div class="inner">
    <a href="<?php echo get_admin_url() . '/?page=wpmyadmin_page' ?>">テーブル一覧へ戻る</a>
    <br><br>

    <h1>検索フォーム</h1>
    <form action="<?php echo get_admin_url() ?>"
          method="GET">
      <?php wpmyadmin_GETS() ?>

      <input type="hidden"
             name="search_result">
      <input type="text"
             value="<?php echo esc_attr($_GET['s']) ?>"
             name="s">

      <button type="submit">送信</button>
    </form>
    <br>
    <?php

    global $where_array;
    // ---------- 検索 ----------
    if (esc_attr($_GET["s"])) {
      include($wpmyadmin_path . "/view/pages/wpmyadmin-view-search.php");
    } else {
      // ---------- 各テーブル 1行 ----------
      if (
        !empty($where_array) &&
        esc_attr($_GET["table"]) &&
        esc_attr($_GET["page"])
      ) {
        include($wpmyadmin_path . "/view/pages/wpmyadmin-view-table-row.php");
      }
      // ---------- 各テーブル ----------
      elseif (
        esc_attr($_GET["table"]) &&
        esc_attr($_GET["page"])
      ) {
        include($wpmyadmin_path . "/view/pages/wpmyadmin-view-table.php");
      }
      // ---------- 初期画面 ----------
      elseif (esc_attr($_GET["page"])) {

        include($wpmyadmin_path . "/view/pages/wpmyadmin-view-tables.php");
      }
    }
    ?>
  </div>
</div>