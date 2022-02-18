<?php
/*--------------------------------------------------
/* 関数
/*------------------------------------------------*/

/**
 * cssファイルのpathを取得
 *
 * @param $css_file cssファイル名
 */
function mywpdb_css_path($css_file)
{
  return plugins_url('/view/assets/css/' . $css_file, __FILE__);;
}


/**
 * 配列のエスケープ
 *
 * @param $array 配列
 */
function mywpdb_escape_array($array)
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
function mywpdb_sanitize_array($array)
{
  $rtn_array = [];
  if (!empty($array)) {
    foreach ($array as $key => $value) {
      if (!is_array($value)) {
        $value = trim($value);
        $value = stripslashes($value);
        $rtn_array[$key] = htmlspecialchars($value, ENT_QUOTES);
      }
    }
  }
  return $rtn_array;
}

/**
 * サニタイズ
 *
 * @param $variable 値
 */
function mywpdb_sanitize($value)
{
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}


/**
 * 現在のページのリンクをパラメータ付きで取得
 */
function mywpdb_get_current_link()
{

  $link = is_ssl() ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  // $link_esc = esc_url($link);
  return ($link);
}

/**
 * 現在の$sanitized_GETを全て取得しinput[type="hidden"]に変換
 *
 * @param $exclude 除外するアイテムのキー
 */
function mywpdb_GETS($exclude = null)
{
  $sanitized_GET = mywpdb_sanitize_array($_GET);
  foreach ($sanitized_GET as $key => $value) {
    if ($key == $exclude) {
      continue;
    }
?>
<input type="hidden"
       name="<?php echo esc_attr($key) ?>"
       value="<?php echo esc_attr($value) ?>">
<?php  }
}


/**
 * パンクズりすと
 *
 * @param $
 */
function mywpdb_breadcrumb()
{
  $sanitized_GET = mywpdb_sanitize_array($_GET);
  $sanitized_where_GET = mywpdb_sanitize_array($_GET['where']);
  ?>
<div class="mywpdb_breadcrumb">
  <a href="<?php echo esc_url(admin_url() . "?page=mywpdb_page") ?>">テーブル一覧</a>

  <?php if (isset($sanitized_GET['table'])) { ?>
  > <a href="<?php echo esc_url(admin_url() . "?page=mywpdb_page&table=" . $sanitized_GET['table']) ?>"><?php echo esc_html($sanitized_GET['table']) ?></a>
  <?php } ?>

  <?php if (!empty($sanitized_where_GET)) {
      $first_key = array_key_first($sanitized_where_GET);
      $first_value = $sanitized_where_GET[$first_key];
    ?>
  > <a href="<?php echo esc_url(admin_url() . "?page=mywpdb_page&table=" . $sanitized_GET['table']) ?>">
    <?php
        $output = "where '";
        $output .= esc_html($first_key);
        $output .= "' = '";
        $output .= esc_html($first_value);
        $output .= "'";
        echo esc_html($output);
        ?>

  </a>

  <?php } ?>
</div>

<?php
}




function mywpdb_validation($data)
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
function mywpdb_pagination($page_count)
{
  global $limit;
  $sanitized_GET = mywpdb_sanitize_array($_GET);
  $sanitized_where_GET = mywpdb_sanitize_array($_GET['where']);
  $offset = 0;
  $pages = $sanitized_GET['page'];
  $last = (int)$page_count + 1;
  $page_num = (isset($sanitized_GET['page_num'])) ? (int)$sanitized_GET['page_num'] : 1;
  $prev = (!isset($page_num) || (int)$page_num < 1) ? 1 : (int)$page_num - 1;
  $next = ((int)$page_num == $last) ? $last : (int)$page_num + 1;
?>
<form class="mywpdbPagination"
      mehtod="GET"
      action="<?php echo mywpdb_get_current_link() ?>">
  <?php mywpdb_GETS() ?>

  <select class="mywpdbPagination__select"
          name="page_num">
    <?php for ($l = 1; $l < $last; $l++) { ?>
    <option <?php echo ($l) == esc_attr($page_num) ? 'selected' : ''; ?>
            value="<?php echo $l ?>"><?php echo $l ?></option>
    <?php } ?>
  </select>
  <script>
  (function($) {
    $('.mywpdbPagination__select').on('change', function() {
      $('.mywpdbPagination').submit()
    })
  })(jQuery);
  </script>

  <ul class="mywpdbPagination__list">
    <li class="mywpdbPagination__listChild">
      <button name="page_num"
              value="<?php echo esc_attr($prev) ?>">

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

    <li class="mywpdbPagination__listChild <?php echo ($page_num == $i) ? '-current' : ''; ?>">
      <button name="page_num"
              value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></button>
    </li>
    <?php } else {
          $b++;
          if ($b == 4) {
            echo '<li class="mywpdbPagination__listChild">...</li>';
          }
          continue;
        }
      }
      ?>

    <li class="mywpdbPagination__listChild">
      <button name="page_num"
              value="<?php echo esc_attr($next) ?>">

        > </button>
    </li>
  </ul>
</form>
<?php
}