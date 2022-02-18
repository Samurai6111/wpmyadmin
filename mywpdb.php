<?php
/*
@package    WordPress
@subpackage my_plugin
@author  Samurai6111 <samurai.blue6111@gmail.com>
Plugin Name: My wpdb
Text Domain: my_plugin
Description: Wordpressで管理画面からDBを編集することが出来るプラグイン
Author: Shota Kawakatsu
Author URI: https://github.com/Samurai6111
Version: 1.3
Plugin URI: https://github.com/Samurai6111/mywpdb
*/

/*--------------------------------------------------
/* phpファイルのURLに直接アクセスされても中身見られないようにするやつ
/*------------------------------------------------*/
if (!defined('ABSPATH')) exit;


/*--------------------------------------------------
/* 変数
/*------------------------------------------------*/
// ---------- url ----------
$mywpdb_url = plugins_url('', __FILE__);
// ---------- path ----------
$mywpdb_path = plugin_dir_path(__FILE__);


/*--------------------------------------------------
/* ファイルインクルード
/*------------------------------------------------*/
if (
    is_admin() &&
    esc_attr($sanitized_GET['page']) === 'mywpdb_page'
) {
    include($mywpdb_path . "/mywpdb-functions.php");
    include($mywpdb_path . "/mywpdb-variables.php");
}

/*--------------------------------------------------
/* ページ作成
/*------------------------------------------------*/
function mywpdb_add_pages()
{
    global $mywpdb_path;
    add_menu_page(
        __('My wpdb'),
        __('My wpdb'),
        'manage_options',
        'mywpdb_page',
        'mywpdb_view',
        'dashicons-calendar-alt',
        100
    );
}
add_action('admin_menu', 'mywpdb_add_pages');

function mywpdb_view()
{
    global $mywpdb_path;
    include($mywpdb_path . "/mywpdb-functions.php");
    include($mywpdb_path . "/mywpdb-variables.php");

    // ---------- ページ読み込み ----------
    include($mywpdb_path . "/view/pages/mywpdb-view.php");
}

/**
 * css読み込み
 */
function mywpdb_load_css()
{
    global $mywpdb_url;
    wp_enqueue_style('mywpdb_css', $mywpdb_url . '/view/assets/css/mywpdb-style.css', false, '1.1', 'all');
}
add_action('admin_enqueue_scripts', 'mywpdb_load_css');


// /**
//  * css読み込み
//  */
// function mywpdb_load_js()
// {
//     global $mywpdb_path;
//     $js_directory = $mywpdb_path . 'view/assets/js/';
//     $js_file_list = glob($js_directory . '*.js');
//     foreach ($js_file_list as $js_file) {
//         $js_file_name = basename($js_file);
//         $js_name = str_replace(".js", "", $js_file_name);
//         $js_file_path = $js_directory . $js_file_name;

//         wp_enqueue_script($js_name, $js_file_path, [], false, true);
//     }
// }
// add_action('admin_enqueue_scripts', 'mywpdb_load_js');
