    <footer class="page-last">
        <?php
        $defaults = array(
            'menu'            => 'footer',
            'container_id'    => 'footer-menu',
            'fallback_cb'     => 'wp_page_menu',
            'depth'           => 1,
            'theme_location'  => 'footer',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        );
        wp_nav_menu($defaults);
        ?>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>