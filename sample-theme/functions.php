<?php

// カスタムカテゴリ[illust]の設定：開始=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
// メタ情報の紐づけ
if (!function_exists('set_illust_meta')) {

    function set_illust_meta()
    {
        add_meta_box('illust_meta', '作品情報', 'insert_illust_fields', 'post', 'normal');
    }
}
add_action('admin_menu', 'set_illust_meta');
// 設定項目の表示
if (!function_exists('insert_illust_fields')) {
    function insert_illust_fields()
    {
        global $post;
        echo '<p>利用ツール</p> <input type="text" name="illust_tools" value="' . get_post_meta($post->ID, 'illust_tools', true) . '" size="50" /><br>';
        echo '<p>依頼主</p> <input type="text" name="illust_client" value="' . get_post_meta($post->ID, 'illust_client', true) . '" size="50" /><br>';
        echo '<p>作品リンク</p> <input type="text" name="illust_snsLink" value="' . get_post_meta($post->ID, 'illust_snsLink', true) . '" size="50" /><br>';
    }
}
// カスタムフィールドの値を保存
if (!function_exists('save_illust_fields')) {
    function save_illust_fields($post_id)
    {
        if (!empty($_POST['illust_tools'])) { //題名が入力されている場合
            update_post_meta($post_id, 'illust_tools', $_POST['illust_tools']); //値を保存
        } else { //題名未入力の場合
            delete_post_meta($post_id, 'illust_tools'); //値を削除
        }

        if (!empty($_POST['illust_client'])) {
            update_post_meta($post_id, 'illust_client', $_POST['illust_client']);
        } else {
            delete_post_meta($post_id, 'illust_client');
        }

        if (!empty($_POST['illust_snsLink'])) {
            update_post_meta($post_id, 'illust_snsLink', $_POST['illust_snsLink']);
        } else {
            delete_post_meta($post_id, 'illust_snsLink');
        }
    }
}
add_action('save_post', 'save_illust_fields');
// カスタムカテゴリ[illust]の設定：終了=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


// WP機能の有効化設定=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
if (!function_exists('my_stepup')) {
    function my_stepup()
    {

        // カスタマイズ：タイトルタグの有効化
        add_theme_support('title-tag');

        // メニュー（リンク一覧）有効化
        // 表示方法：https://www.webdesignleaves.com/pr/wp/wp_nav_menus.html
        register_nav_menus(array(
            'navigation' => '付箋メニュー（推奨5個）',
            'footer' => 'フッターメニュー'
        ));

        // 投稿：サムネイル有効化
        // 表示方法：https://codex.wordpress.org/Post_Thumbnails
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(150, 150, true);
        add_image_size('category-thumb', 300, 9999);

        // 投稿：フォーマット有効化
        // 使い方：https://wordpress.org/support/article/post-formats/
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'gallery',
        ));


        // blockエディタ有効化
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
        // プレビューレイアウトの設定
        add_editor_style(get_theme_file_uri() . '/assets/css/style.css');
    }
}
// functions.php読み込み後に実行
add_action('after_setup_theme', 'my_stepup');


// サイドバーの設定=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
if (!function_exists('my_widgetinit')) {
    function my_widgetinit()
    {

        // サイドバー設定
        // 表示方法：https://www.webdesignleaves.com/pr/wp/wp_widgets.html
        if (function_exists('register_sidebar')) {
            register_sidebar(array(
                'name' => 'サイドバー',
                'id' => 'sidebar',
                'description' => 'サイドバーウィジェット',
                'before_widget' => '<div>',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="side-title">',
                'after_title' => '</h3>'
            ));
        }
    }
}
add_action('widgets_init', 'my_widgetinit');


// アセットファイル読み込み=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
if (!function_exists('my_enqueue_scripts')) {
    function my_enqueue_scripts()
    {
        //JS
        wp_enqueue_script('my_js', get_theme_file_uri() . '/assets/js/script.js', array(), false, true);
        wp_enqueue_script('api_request', get_theme_file_uri() . '/assets/js/rest_req.js', array(), false, true);
        //CSS
        wp_enqueue_style('my-google-font', '//fonts.googleapis.com/css?family=Raleway', false, null, 'all');
        wp_enqueue_style('animation', get_theme_file_uri() . '/assets/css/anim.css', array());
        wp_enqueue_style('style', get_theme_file_uri() . '/assets/css/style.css', array());
    }
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');



// ショートコード[JSでSVGを出力する]=＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
function my_shortcode_ex2js_handler($atts, $content = null)
{
    $str = <<<eot
    <svg id="bg-image" width="100%" height="100%" viewbox="0 0 200 200" style="background-color:#d4d4d4;">
    </svg>
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }

        #dkjsfkl {
            width: 100%;
            height: 100%;
            background: black;
            z-index: -2;
            color: rgb(60, 20, 144)
        }
    </style>

    <script>
        var svg = document.getElementById("bg-image");

        for (let i = 0; i < getRandomInt(5, 10); i++) {
            // 図形を生成
            var type = getFigureType();
            console.log(type)
            var width = getRandomInt(50, 600);
            var height = getRandomInt(50, 600);
            var r = getRandomInt(100, 200);
            var g = getRandomInt(100, 200);
            var rotate = getRandomInt(0, 360);
            console.log(window.width)
            var x = getRandomInt(-500, 500);
            var y = getRandomInt(-500, 500);
            const child = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
            child.setAttribute("width", width);
            child.setAttribute("height", height);
            child.setAttribute("fill", 'rgb' + r + g + ',144)');
            // child.setAttribute("x", x);
            // child.setAttribute("y", y);
            child.setAttribute("transform", 'rotate(' + rotate+ ')');
            // svgで表示
            svg.appendChild(child);
        }

        /**
         * 2値の間で乱数を生成する
         **/
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min) + min); //The maximum is exclusive and the minimum is inclusive
        }

        function getFigureType() {
            type_list = ['rect', 'circle', 'ellipse'];
            return type_list[getRandomInt(0, 2)]
        }
    </script>
    eot;
    return $str;
}
add_shortcode('my-shortcode_ex2js', 'my_shortcode_ex2js_handler');



add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/my/get_posts', array(
        'methods' => 'GET',
        'callback' => 'my_posts_api',
    ));
});
function my_posts_api()
{

    $contents = array(); //return用の配列を準備
    $myQuery = new WP_Query(); //取得したいデータを設定
    $myQuery->query(array(
        'post_type' => array('post'),
        'orderby'          => 'date',
        'order'            => 'DESC',
    ));
    if ($myQuery->have_posts()) :
        while ($myQuery->have_posts()) : $myQuery->the_post();
            array_push($contents, array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "date" => get_the_date(),
                "category" => get_the_category(),
                "link" => get_the_permalink(),
                "image" => get_the_post_thumbnail_url()
            ));
        endwhile;
    endif;
    return $contents; // WP REST APIを利用するときはjsonで返ってくる様に設定されているので、json_encodeは必要ありません。
}

function near_posts(int $id)
{

    $postlist = get_posts(array(
        'numberposts'      => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post'
    ));
    $posts = array();
    foreach ($postlist as $post) {
        $posts[] += $post->ID;
    }
    // 現在の記事のIndexを取得
    $current = array_search($id, $posts);
    
    // 前後取得
    $prevID = $current !== 0? $posts[$current - 1]: null;
    $nextID = $current !== (count($posts) - 1)?$posts[$current + 1]: null;
    // 取得する最初のインデックス
    $start_index = 0;
    if ($current > 3) {
        $start_index = $current - 3;
    }
    // 現在の記事を削除して6件に絞りこむ
    array_splice($posts, $current, 1);
    $posts = array_slice($posts, $start_index, 6);

    return array(
        'prevID' => $prevID,
        'nextID' => $nextID,
        'posts' => $posts
    );
}
