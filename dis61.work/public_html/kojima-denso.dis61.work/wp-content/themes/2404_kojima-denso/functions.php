<?php
/**
 * AUGUSTALAB_REC_202311 functions and definitions
 *
 * @package WordPress
 * @subpackage augustalab
 */

//-----------------------------------------------------------------------------------//
// 初期設定
//-----------------------------------------------------------------------------------//
define('THEMEURL',       get_stylesheet_directory_uri().'/');
define('THEMEASSETS',    THEMEURL.'assets/');
define('THEMEIMG',       THEMEASSETS.'img');
define('THEMECSS',       THEMEASSETS.'css');
define('THEMEJS',        THEMEASSETS.'js');
define('THEMELIB',       THEMEASSETS.'lib');

define('THEMEDIR',       get_stylesheet_directory().'/');
define('THEMEDIRASSETS', THEMEDIR.'assets/');
define('THEMEDIRIMG',    THEMEDIRASSETS.'img');
define('THEMEDIRCSS',    THEMEDIRASSETS.'css');
define('THEMEDIRJS',     THEMEDIRASSETS.'js');
define('THEMEDIRLIB',    THEMEDIRASSETS.'lib');


//-----------------------------------------------------------------------------------//
// CSS・JS読み込み
//-----------------------------------------------------------------------------------//
function my_enqueue_styles() {
    wp_enqueue_style('style'           , THEMECSS.'/style.css'            , '', date('YmdHi', filemtime(THEMEDIR.'/style.css'))          , 'all' );
    wp_enqueue_style('slick'           , THEMECSS.'/slick.css'            , '', '1.8.1'                                                  , 'all' );

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0');
    wp_enqueue_script('slick' , THEMEJS.'/slick.min.js', '1.8.1');
    wp_enqueue_script('script', THEMEJS.'/script.js'          , array('jquery'), date('YmdHi', filemtime(THEMEDIRJS.'/script.js')), true);
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_styles' );


//-----------------------------------------------------------------------------------//
// カスタムメニュー
//-----------------------------------------------------------------------------------//
function my_regist_menus() { 
    register_nav_menus( array( 
        'global-nav'   => 'グローバルメニュー',
    ) );
}
add_action( 'after_setup_theme', 'my_regist_menus' );


//-----------------------------------------------------------------------------------//
// アイキャッチ画像有効化
//-----------------------------------------------------------------------------------//
add_theme_support('post-thumbnails');


//-----------------------------------------------------------------------------------//
// wp_nav_menuのli, aに任意のクラスを追加
//-----------------------------------------------------------------------------------//
// wp_nav_menuのliにclass追加
function my_nav_add_class_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes['class'] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'my_nav_add_class_li', 1, 3);

// wp_nav_menuのaにclass追加
function my_nav_add_class_link($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}
add_filter('nav_menu_link_attributes', 'my_nav_add_class_link', 1, 3);


//-----------------------------------------------------------------------------------//
// 投稿のクラス変更
//-----------------------------------------------------------------------------------//
function my_post_has_archive( $args, $post_type ) {
    if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['label'] = '商品(Welcart用)'; //管理画面左ナビに「投稿」の代わりに表示される
    }
    return $args;
}
add_filter( 'register_post_type_args', 'my_post_has_archive', 10, 2 );


//-----------------------------------------------------------------------------------//
// ページネーション出力関数
// $pages : 全ページ数
// $paged : 現在のページ
// $range : 左右に何ページ表示するか
// $show_only : 1ページしかない時に表示するかどうか
//-----------------------------------------------------------------------------------//
function my_pagination( $pages, $paged, $range = 1, $show_only = false ) {

    $pages = ( int ) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    if ( $show_only && $pages === 1 ) {
        // １ページのみで表示設定が true の時

        echo '<div class="pagination-type1">';
        echo '<div class="pagination-type1__inner">';
        echo '<div class="pagination"><span class="current pager">1</span></div>';
        return;
    }

    if ( $pages === 1 ) return;    // １ページのみで表示設定もない場合

    if ( 1 !== $pages ) {
        //２ページ以上の時
        echo '<div class="pagination-type1">';
        echo '<div class="pagination-type1__inner">';

        if ( $paged > $range + 1 ) {
            // 「最初へ」 の表示
            echo '<div class="pagination-type1__first">';
            echo '<a href="'.get_pagenum_link( 1 ).'" class="pagination-type1__first-link"></a>';
            echo '</div>';
        }
        if ( $paged > 1 ) {
            // 「前へ」 の表示
            echo '<div class="pagination-type1__prev">';
            echo '<a href="'.get_pagenum_link( $paged - 1 ).'" class="pagination-type1__prev-link"></a>';
            echo '</div>';
        }
        
        echo '<ul class="pagination-type1__list">';
        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( 
                ($paged != 1 && $i <= $paged + $range && $i >= $paged - $range) ||
                ($paged == 1 && $i <= $range * 2 + 1)
             ) {
                // $paged +- $range 以内であればページ番号を出力
                if ( $paged === $i ) {
                    echo '<li class="pagination-type1__item current">', $i ,'</li>';
                } else {
                    echo '<li class="pagination-type1__item ">';
                    echo '<a href="'.get_pagenum_link( $i ).'" class="pagination-type1__item-link">'.$i.'</a>';
                    echo '</li>';
                }
            }
        }
        echo '</ul>';

        if ( $paged < $pages ) {
            // 「次へ」 の表示
            echo '<div class="pagination-type1__next">';
            echo '<a href="'.get_pagenum_link( $paged + 1 ).'" class="pagination-type1__next-link"></a>';
            echo '</div>';
        }
        if ( $paged + $range < $pages ) {
            // 「最後へ」 の表示
            echo '<div class="pagination-type1__last">';
            echo '<a href="'.get_pagenum_link( $pages ).'" class="pagination-type1__last-link"></a>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
}


//-----------------------------------------------------------------------------------//
// カスタム投稿
//-----------------------------------------------------------------------------------//
//require_once(THEMEDIR.'inc/cpt/news.php');