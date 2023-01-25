<!-- トップ画面 -->
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="bg">
    <div class="bg-note rotateRight">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<?php if (have_posts()) :
    while (have_posts()) : ?>
        <?php the_post();
        $current_id = get_the_ID(); ?>
        <div class="content-body">
            <?php if ('image' == get_post_format($post->ID)) : ?>
                <?php get_template_part('single', get_post_format()); ?>

            <?php else : ?>
                <div class="content-wrap">


                    <h1><?php the_title() ?></h1>
                    <?php the_content("続きを読む", true); ?>

                    <?php
                    wp_link_pages(array(
                        'before'      => '<div class="page-links"><span class="page-links-title">ページ：</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ));
                    ?>

                    <?php the_posts_pagination(array('screen_reader_text' => ' ')); ?>


                    <div class="post-near">
                        <div class="post-pre">
                            <?php previous_post_link(); ?>
                        </div>
                        <div class="post-next">
                            <?php next_post_link(); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>

<?php endwhile;
endif; ?>


<div class="preview-widget">
    <div class="preview-list">
        <?php
        $data = near_posts($current_id);

        // HTML表示処理
        if (!empty($data['prevID'])) :
            echo '<a href="' . get_permalink($data['prevID']) . '" id="pre-back"></a>';
        else:
            echo '<div></div>';
        endif;


        foreach($data['posts'] as $id):
            if (!empty($id)) :
        ?>
                <div class="img" onclick="openLink('<?php echo get_permalink($id) ?>')" style="background-image: url(
                    <?php echo has_post_thumbnail($id) ? get_the_post_thumbnail_url($id) : get_template_directory_uri() . "/assets/images/dummy.svg"; ?>
                    );">
                    <p class="tip"><?php echo get_the_title($id) ?></p>
                </div>
        <?php
            endif;
        endforeach;

        if (!empty($data['nextID'])) :
            echo '<a href="' . get_permalink($data['nextID']) . '" id="pre-next"></a>';
        else:
            echo '<div></div>';
        endif;
        ?>
    </div>
</div>


<?php get_footer(); ?>