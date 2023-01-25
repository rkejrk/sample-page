<!-- サイドナビ -->
<aside class="side-widget fadeLeft">
    <section class="wp-widgets rotateLeft">

        <div class="cate_btns">
            <div>
                <input type="checkbox" id="cate_open_flg" />
                <label for="cate_open_flg">file</label>
            </div>

            <?php
            $categories = get_categories(array(
                'taxonomy' => 'category'
            ));
            if ($categories) : foreach ($categories as $value) : ?>
                    <div>
                        <input type="checkbox" id="cate-<?php echo $value->term_id ?>" />
                        <label class="fadeLeft" for="cate-<?php echo $value->term_id ?>"><?= esc_html($value->name) ?></label>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>


        <ul class="time-line" id="<?php echo get_the_ID() ?>">
        </ul>

        <?php if (is_active_sidebar('sidebar')) : ?>
            <?php dynamic_sidebar('sidebar'); ?>
        <?php endif; ?>
    </section>
</aside>