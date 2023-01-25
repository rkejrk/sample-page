<?php get_header(); ?>
<div class="bg">
    <div class="bg-center"></div>
    <div class="bg-logo">
        My<br />Work<br />Note
    </div>
    <div class="bg-top-mask type-bg"></div>
    <div class="bg-bottom-mask type-bg"></div>
</div>

<!-- TODO:コンテンツ有にする -->
<?php
$the_query = new WP_Query(array(
    'post_type' => array('post', 'illust'),
    'posts_per_page' => 3,
    'post_status' => 'publish'
));

if ($the_query->have_posts()) :
    $count = 1;
?>
    <div class="new-posts">
        <ul class="img-list">
            <?php while ($count <= 3) : ?>
                <?php if ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" class="bg-image fadeLeft" style="background-image: linear-gradient(270deg, black, transparent), url('<?php if (has_post_thumbnail()) : the_post_thumbnail_url();
                                                                                                                                                                else : echo get_template_directory_uri() . '/assets/images/dummy.svg';
                                                                                                                                                                endif; ?>');">
                            <span class="type-big">
                                <?php the_title() ?>
                            </span>
                            <p><?php the_date('Y/M/D')   ?></p>
                        </a>
                    </li>
                <?php elseif ($count > 3) : ?>
                    <li>
                        <div class="bg-image fadeLeft" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/images/dummy.svg' ?>');">
                            <span class="type-big">empty</span>
                        </div>
                    </li>
                <?php endif; ?>
            <?php $count++;
            endwhile; ?>
        </ul>
    </div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php get_footer(); ?>