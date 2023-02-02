<!-- 404エラー画面 -->
<?php get_header(); ?>


<div class="content-body rotateRight">
    <div class="content-wrap">
        <?php if (have_posts()) : ?>
            <?php if (!$_GET['s']) { ?>
                <p>検索キーワードが未入力です</p>
                
                <?php } else { ?>
                    <h1 class="page-title">
                        「<?php echo esc_html($_GET['s']); ?>」の検索結果：<?php echo $wp_query->found_posts; ?>件
                    </h1>
                    
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
            <?php } ?>
        <?php else : ?>
            <p>検索されたキーワードに一致する記事はありませんでした</p>
            
        <?php endif; ?>
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>