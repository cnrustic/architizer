<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<header id="masthead" class="site-header">
    <div class="container">
        <!-- Logo -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- 主导航 -->
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <!-- 右侧菜单 -->
        <div class="header-right">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-right',
                'menu_id'        => 'right-menu',
                'menu_class'     => 'right-nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
            <?php if (!is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wp_registration_url()); ?>" class="register-btn">
                    <?php esc_html_e('注册', 'architizer'); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- 移动端菜单按钮 -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
</body>
</html>