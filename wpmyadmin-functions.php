<?php
/*--------------------------------------------------
/* 関数
/*------------------------------------------------*/

/**
 * cssファイルのpathを取得
 *
 * @param $css_file cssファイル名
 */
function wpmyadmin_css_path($css_file)
{
  return plugins_url('/view/assets/css/' . $css_file, __FILE__);;
}


/**
 * 配列のエスケープ
 *
 * @param $array 配列
 */
function wpmyadmin_escape_array($array)
{
  $rtn_array = [];
  if (!empty($array)) {
    foreach ($array as $key => $value) {
      $rtn_array[$key] = esc_attr($value);
    }
  }
  return $rtn_array;
}

/**
 * 配列のサニタイズ
 *
 * @param $array 配列
 */
function wpmyadmin_sanitize_array($array)
{
  $rtn_array = [];
  if (!empty($array)) {
    foreach ($array as $key => $value) {
      $rtn_array[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
  }
  return $rtn_array;
}

/**
 * サニタイズ
 *
 * @param $variable 値
 */
function wpmyadmin_sanitize($variable)
{
  return htmlspecialchars($variable);
}


/**
 * 現在のページのリンクをパラメータ付きで取得
 */
function wpmyadmin_get_current_link()
{

  $link = is_ssl() ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $link_esc = esc_url($link);
  return ($link_esc);
}

/**
 * 現在の$_GETを全て取得しinput[type="hidden"]に変換
 *
 * @param $exclude 除外するアイテムのキー
 */
function wpmyadmin_GETS($exclude = null)
{
  foreach ($_GET as $key => $value) {
    if ($key == $exclude) {
      continue;
    }
?>
<input type="hidden"
       name="<?php echo $key ?>"
       value="<?php echo $value ?>">
<?php  }
}


/**
 * パンクズりすと
 *
 * @param $
 */
function wpmyadmin_breadcrumb()
{
  ?>
<div class="wpmyadmin_breadcrumb">
  <a href="<?php echo admin_url() . "?page=wpmyadmin_page" ?>">テーブル一覧</a>

  <?php if (isset($_GET['table'])) { ?>
  > <a href="<?php echo admin_url() . "?page=wpmyadmin_page&table=" . $_GET['table'] ?>"><?php echo $_GET['table'] ?></a>
  <?php } ?>

  <?php if (isset($_GET['where'])) {
      $first_key = array_key_first($_GET['where']);
      $first_value = $_GET['where'][$first_key];
    ?>
  > <a href="<?php echo admin_url() . "?page=wpmyadmin_page&table=" . $_GET['table'] ?>">
    <?php echo "where $first_key = $first_value" ?>
  </a>

  <?php } ?>
</div>

<?php
}




function wpmyadmin_validation($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/**
 * ページネーション
 *
 * @param $page_count ページの数
 */
function wpmyadmin_pagination($page_count)
{
  global $limit;
  $offset = 0;
  $pages = $_GET['page'];
  $last = (int)$page_count + 1;
  $page_num = (isset($_GET['page_num'])) ? (int)$_GET['page_num'] : 1;
  $prev = (!isset($page_num) || (int)$page_num < 1) ? 1 : (int)$page_num - 1;
  $next = ((int)$page_num == $last) ? $last : (int)$page_num + 1;
?>
<form class="wpmyadminPagination"
      mehtod="GET"
      action="<?php echo wpmyadmin_get_current_link() ?>">
  <?php wpmyadmin_GETS() ?>

  <select class="wpmyadminPagination__select"
          name="page_num">
    <?php for ($l = 1; $l < $last; $l++) { ?>
    <option <?php echo ($l) == $page_num ? 'selected' : ''; ?>
            value="<?php echo $l ?>"><?php echo $l ?></option>
    <?php } ?>
  </select>
  <script>
  (function($) {
    $('.wpmyadminPagination__select').on('change', function() {
      $('.wpmyadminPagination').submit()
    })
  })(jQuery);
  </script>

  <ul class="wpmyadminPagination__list">
    <li class="wpmyadminPagination__listChild">
      <button name="page_num"
              value="<?php echo $prev ?>">

        < </button>
    </li>

    <?php
      $b = 0;
      for ($i = 1; $i <= $last; $i++) {
        if (
          $i == 1 ||
          $i == 2 ||
          $i == $last ||
          $i == $last - 1 ||
          $i == $page_num ||
          $i == $page_num + 1 ||
          $i == $page_num - 1
        ) {
      ?>

    <li class="wpmyadminPagination__listChild <?php echo ($page_num == $i) ? '-current' : ''; ?>">
      <button name="page_num"
              value="<?php echo $i ?>"><?php echo $i ?></button>
    </li>
    <?php } else {
          $b++;
          if ($b == 4) {
            echo '<li class="wpmyadminPagination__listChild">...</li>';
          }
          continue;
        }
      }
      ?>

    <li class="wpmyadminPagination__listChild">
      <button name="page_num"
              value="<?php echo $next ?>">

        > </button>
    </li>
  </ul>
</form>
<?php
}