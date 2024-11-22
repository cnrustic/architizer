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
    <header class="site-header">
        <div class="site-logo">
            <a href="<?php echo home_url(); ?>">Architizer</a>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu'
            ));
            ?>
        </nav>

        <form class="search-form" role="search" method="get" action="<?php echo home_url(); ?>">
            <input type="search" placeholder="搜索项目" name="s">
        </form>

        <div class="auth-buttons">
            <a href="/login" class="login">登录</a>
            <a href="/register" class="register">注册</a>
        </div>
    </header>
</body>
</html>