<!-- 個別ページ -->
<?php
/**
 * Template Name: 自己紹介
 */
get_header(); ?>
<!-- トップ画面 -->
<?php get_header(); ?>

<div class="bg">
   <div class="bg-note rotateRight">
      <div></div>
      <div></div>
      <div></div>
   </div>
</div>

<?php get_sidebar() ?>
<div class="content-body">
   <div class="content-wrap">
      <?php if (have_posts()) :
         while (have_posts()) :
            the_post();
            the_content();

            global $numpages;
            if ($numpages !== 1) { //複数ページの場合
               $paged = (get_query_var('page')) ? get_query_var('page') : 1;
               if ($paged !== 1) { //２ページ目以降を表示している場合
                  echo '<div>(' . $paged . '/' . $numpages . ')' . '<a href="' . get_the_permalink() . '">1ページ目から読む</a></div>';
               }
            }
         endwhile;
      endif; ?>
   </div>
</div>

<?php get_footer(); ?>