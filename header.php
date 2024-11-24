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
        <!-- 搜索框 -->
        <?php get_template_part('searchform'); ?>
        <!-- 右侧菜单 -->
        <!-- 认证按钮 -->
    <div class="auth-buttons">
        <?php if (is_user_logged_in()) : ?>
            <?php
            $current_user = wp_get_current_user();
            $avatar = get_avatar_url($current_user->ID, array('size' => 48));
            ?>
            <div class="user-menu">
                <button class="user-menu-toggle">
                    <div class="user-avatar">
                        <img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>">
                    </div>
                    <span><?php echo esc_html($current_user->display_name); ?></span>
                    <svg width="12" height="12" viewBox="0 0 12 12">
                        <path d="M6 8L2 4h8l-4 4z" fill="currentColor"/>
                    </svg>
                </button>
                <div class="user-dropdown">
                    <a href="<?php echo esc_url(get_edit_profile_url()); ?>" class="user-dropdown-item">
                        <?php esc_html_e('个人资料', 'architizer'); ?>
                    </a>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="user-dropdown-item">
                        <?php esc_html_e('退出登录', 'architizer'); ?>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="login-btn">
                <?php esc_html_e('登录', 'architizer'); ?>
            </a>
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
        <!-- 移动端菜单 -->
        <div class="mobile-menu">
            <?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>
            <div class="mobile-auth">
                <?php if (!is_user_logged_in()) : ?>
                    <a href="<?php echo wp_login_url(); ?>" class="mobile-login-btn">登录</a>
                    <a href="<?php echo wp_registration_url(); ?>" class="mobile-register-btn">注册</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>