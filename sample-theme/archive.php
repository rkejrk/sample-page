<!-- 投稿一覧 -->
<?php get_header(); ?>

<div class="content-body">
    <div class="content-wrap">
        
        <?php if (have_posts()) : ?>
            <!-- アクセスされたページ種別でタイトルの文字を調整 -->
            <?php
            $page_title = "";
            if (is_category()) {
                $page_title = "カテゴリー「" . single_cat_title("", false) . "」";
            }
            if (is_tag()) {
                $page_title = "タグ「" . single_tag_title("", false) . "」";
            }
            if (is_date()) {
                $page_title = get_the_date("Y年n月");
            }
            ?>

<!-- タイトルを出力 -->
<h1><?php echo $page_title; ?>の記事一覧</h1>

<div class=" search-result">
    <?php while (have_posts()) : the_post(); ?>
    
    
    <article onclick="openLink('<?php the_permalink(); ?>')">
                        <ul class="meta">
                            <li class="res-item-time"><?php the_time('Y/m/d'); ?></li>
                            <?php if (has_category()) : ?>
                                <li class="res-item-cate"><?php the_category() ?></li>
                            <?php endif; ?>
                            <li class="res-item-title"><?php the_title(); ?></li>
                        </ul>

                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                                <?php endif; ?>
                            </a>
                            
                            <div class="text">
                            <?php the_excerpt() ?>
                        </div>
                    </article>


                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <div class="page-links">
            <?php
            global $wp_query;
            $big = 999999999;
            echo paginate_links(array(
                "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
                "total" => $wp_query->max_num_pages,
                "current" => max(1, get_query_var("paged")),
                "mid_size" => 1,
                'prev_text'=> __('&laquo;'),
                'next_text'=> __('&raquo;'),
            ));
            ?>
        </div>
        
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>