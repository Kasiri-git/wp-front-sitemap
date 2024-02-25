ZIPファイルをダウンロードして、そのままWordPressにインストールしたら有効化してください。  
ショートコード張ったところに投稿されているすべての記事一覧がテキストリンクで一覧表示されます。  
```
[allpost_list]
```  
投稿のクエリ
```PHP
    // 投稿のクエリを作成
    $args = array(
        'post_type' => 'post', // 投稿タイプを指定
        'posts_per_page' => -1, // すべての投稿を取得
    );
```
出力されるコード
```PHP
    if ( $posts_query->have_posts() ) {
        $output = '<ul class="wp-front-sitemap-posts-list">';
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = 'No posts found.';
    }
```
出力されるHTMLコードには
class="wp-front-sitemap-posts-list
独自のclassが割り当てられています
