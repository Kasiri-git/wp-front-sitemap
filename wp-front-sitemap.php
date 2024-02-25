<?php
/*
Plugin Name: WP Front Sitemap
Description: ショートコードで投稿記事一覧を表示させるシンプルなプラグイン
Version: 1.0.0
Author: Kasiri
*/

// メニューリンクを追加
function wp_front_sitemap_menu() {
    add_options_page( 'WP Front Sitemap Settings', 'WP Front Sitemap', 'manage_options', 'wp-front-sitemap-settings', 'wp_front_sitemap_settings_page');
}
add_action('admin_menu', 'wp_front_sitemap_menu');

// 設定ページの内容
function wp_front_sitemap_settings_page() {
    ?>
    <div class="wrap">
        <h2>WP Front Sitemap Settings</h2>
        <p>以下のショートコードを使用して、投稿の一覧を表示できます。</p>
        <p><code>[allpost_list]</code></p>
    </div>
    <?php
}

// ショートコードの処理を行う関数
function wp_front_sitemap_shortcode($atts) {
    // デフォルトのショートコード属性
    $atts = shortcode_atts( array(
        // ここでデフォルトの属性を設定できます
    ), $atts );

    // 投稿のクエリを作成
    $args = array(
        'post_type' => 'post', // 投稿タイプを指定
        'posts_per_page' => -1, // すべての投稿を取得
    );

    $posts_query = new WP_Query( $args );

    // ループして投稿を表示
    if ( $posts_query->have_posts() ) {
        $output = '<ul class="wp-front-sitemap-posts-list">'; // ul要素にclassを追加
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = 'No posts found.';
    }

    // ループ後、リセット
    wp_reset_postdata();

    return $output;
}

// ショートコードを登録
add_shortcode('allpost_list', 'wp_front_sitemap_shortcode');
