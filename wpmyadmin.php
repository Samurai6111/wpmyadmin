<?php
/*
@package    WordPress
@subpackage my_plugin
@author  Samurai6111 <samurai.blue6111@gmail.com>
Plugin Name: wpMyAdmin
Text Domain: my_plugin
Description: Wordpressで管理画面からDBを編集することが出来るプラグイン
Author: Shota Kawakatsu
Author URI: https://github.com/Samurai6111
Version: 1.3
Plugin URI: https://github.com/Samurai6111/my-wpdb
*/

/*--------------------------------------------------
/* phpファイルのURLに直接アクセスされても中身見られないようにするやつ
/*------------------------------------------------*/
if (!defined('ABSPATH')) exit;


/*--------------------------------------------------
/* 変数
/*------------------------------------------------*/
// ---------- url ----------
$wpmyadmin_url = plugins_url('', __FILE__);
// ---------- path ----------
$wpmyadmin_path = plugin_dir_path(__FILE__);


/*--------------------------------------------------
/* ファイルインクルード
/*------------------------------------------------*/
if (
    is_admin() &&
    esc_attr($sanitized_GET['page']) === 'wpmyadmin_page'
) {
    include($wpmyadmin_path . "/wpmyadmin-functions.php");
    include($wpmyadmin_path . "/wpmyadmin-variables.php");
}

/*--------------------------------------------------
/* ページ作成
/*------------------------------------------------*/
function wpmyadmin_add_pages()
{
    global $wpmyadmin_path;
    add_menu_page(
        __('wpMyAdmin'),
        __('wpMyAdmin'),
        'manage_options',
        'wpmyadmin_page',
        'wpmyadmin_view',
        'dashicons-calendar-alt',
        100
    );
}
add_action('admin_menu', 'wpmyadmin_add_pages');

function wpmyadmin_view()
{
    global $wpmyadmin_path;
    include($wpmyadmin_path . "/wpmyadmin-functions.php");
    include($wpmyadmin_path . "/wpmyadmin-variables.php");

    // ---------- ページ読み込み ----------
    include($wpmyadmin_path . "/view/pages/wpmyadmin-view.php");
}

/**
 * css読み込み
 */
function wpmyadmin_load_css()
{
    global $wpmyadmin_url;
    wp_enqueue_style('wpmyadmin_css', $wpmyadmin_url . '/view/assets/css/wpmyadmin-style.css', false, '1.1', 'all');
}
add_action('admin_enqueue_scripts', 'wpmyadmin_load_css');


// /**
//  * css読み込み
//  */
// function wpmyadmin_load_js()
// {
//     global $wpmyadmin_path;
//     $js_directory = $wpmyadmin_path . 'view/assets/js/';
//     $js_file_list = glob($js_directory . '*.js');
//     foreach ($js_file_list as $js_file) {
//         $js_file_name = basename($js_file);
//         $js_name = str_replace(".js", "", $js_file_name);
//         $js_file_path = $js_directory . $js_file_name;

//         wp_enqueue_script($js_name, $js_file_path, [], false, true);
//     }
// }
// add_action('admin_enqueue_scripts', 'wpmyadmin_load_js');