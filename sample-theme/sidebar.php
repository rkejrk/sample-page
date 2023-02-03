<!-- サイドナビ -->
<aside class="side-widget fadeLeft">
    <section class="wp-widgets rotateLeft">

        <?php if (is_active_sidebar('sidebar')) : ?>
            <?php dynamic_sidebar('sidebar'); ?>
        <?php endif; ?>

        <div class="posts-view">

            <h2>TimeLine</h2>
            <div class="cate_btns">
                <div>
                    <input type="checkbox" id="cate_open_flg" />
                    <label for="cate_open_flg"><i class="fa-solid fa-folder"></i></label>
                </div>

                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'category'
                ));
                if ($categories) : foreach ($categories as $value) : ?>
                        <div>
                            <input type="checkbox" id="cate-<?php echo $value->term_id ?>" />
                            <label class="fadeLeft" for="cate-<?php echo $value->term_id ?>"><i class="fa-solid fa-<?php echo get_option('cat_' . intval($value->term_id))['icon_name'] ?>"></i></label>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>

            <ul class="time-line" id="<?php echo get_the_ID() ?>">
            </ul>
        </div>
    </section>
</aside>