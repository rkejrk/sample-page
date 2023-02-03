<?php
/*----------------------------------------------------------------------------------------------------
 *
 *
 * Template Name: イラスト
 *
 *
 *--------------------------------------------------------------------------------------------------*/
?>

<div class="content-wrap cate-illust">
    <h1><?php the_title() ?></h1>

    <section class="section-wrap">
        <div class="imag-wrap scroll-render">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dummy.svg">
            <?php endif; ?>
        </div>
        <div class="comment-wrap">
            <ul>
                <?php $date = get_the_date() ?>
                <li class="scroll-render">
                    <strong class="label-text">作成日:<?php echo get_the_date(); ?></strong>
                </li>

                <?php
                // 使用ツール情報取得
                $tool_str = get_post_meta($post->ID, 'illust_tools', true);
                echo '<li class="scroll-render"><p class="label">使用ツール: </p>';
                if (mb_strlen($tool_str) > 0) {
                    echo '<p>' . $tool_str . '</p></li>';
                } else {
                    echo '<p class="unknown">記載なし</p></li>';
                }


                // クライアント情報取得
                $client_str = get_post_meta($post->ID, 'illust_client', true);
                echo '<li class="scroll-render"><p class="label">依頼主: </p>';
                if (mb_strlen($client_str) > 0) {
                    echo '<p>' . $client_str . '</p></li>';
                } else {
                    echo '<p class="unknown">記載なし</p></li>';
                }

                // SNSリンク取得
                $sns_str = get_post_meta($post->ID, 'illust_snsLink', true);
                echo '<li class="scroll-render"><p class="label">リンク: </p>';
                if (mb_strlen($sns_str) > 0) {
                    echo '<p>' . $sns_str . '</p></li>';
                } else {
                    echo '<p class="unknown">記載なし</p></li>';
                }
                ?>

                <li class="content scroll-render">
                    <?php the_content(); ?>
                </li>

            </ul>
        </div>
    </section>

    <div class="post-near">
        <div class="post-pre">
            <?php previous_post_link(); ?>
        </div>
        <div class="post-next">
            <?php next_post_link(); ?>
        </div>
    </div>
</div>