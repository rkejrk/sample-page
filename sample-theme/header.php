<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <meta name="description" content="" />

    <?php wp_head(); ?>
</head>

<body>
    <nav class="clip-menu">
        <div class="collapse">
            <button class="clip-item" onclick="menuOpen()">MENU</button>
        </div>

        <?php
        $defaults = array(
            'echo'            => true,
            'menu'            => 'navigation',
            'menu_class' => 'menu-list',
            'fallback_cb'     => 'wp_page_menu',
            'depth'           => 0,
            'theme_location'  => 'navigation',
            'items_wrap'      => '<ul id="%1$s" class="%2$s" disabled="disabled">%3$s</ul>'
        );
        wp_nav_menu($defaults);
        ?>
    </nav>