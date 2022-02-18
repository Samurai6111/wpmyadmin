<div class="mywpdb">
  <div class="inner">
    <a href="<?php echo esc_url(get_admin_url() . '/?page=mywpdb_page') ?>">テーブル一覧へ戻る</a>
    <br><br>

    <h1>検索フォーム</h1>
    <form action="<?php echo get_admin_url() ?>" method="GET">
      <?php mywpdb_GETS();
      ?>

      <input type="hidden" name="search_result">
      <input type="text" value="<?php echo esc_attr($sanitized_GET['s']) ?>" name="s">

      <button type="submit">送信</button>
    </form>
    <br>
    <?php

    global $where_array;
    // ---------- 検索 ----------
    if (esc_attr($sanitized_GET["s"])) {
      include($mywpdb_path . "/view/pages/mywpdb-view-search.php");
    } else {
      // ---------- 各テーブル 1行 ----------
      if (
        !empty($sanitized_where_GET) &&
        esc_attr($sanitized_GET["table"]) &&
        esc_attr($sanitized_GET["page"])
      ) {
        include($mywpdb_path . "/view/pages/mywpdb-view-tableRow.php");
      }
      // ---------- 各テーブル ----------
      elseif (
        esc_attr($sanitized_GET["table"]) &&
        esc_attr($sanitized_GET["page"])
      ) {
        include($mywpdb_path . "/view/pages/mywpdb-view-table.php");
      }
      // ---------- 初期画面 ----------
      elseif (esc_attr($sanitized_GET["page"])) {

        include($mywpdb_path . "/view/pages/mywpdb-view-tables.php");
      }
    }
    ?>
  </div>
</div>
