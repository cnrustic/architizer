<?php
class Architizer_Assets {
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function enqueue_styles() {
        // 主样式
        wp_enqueue_style(
            'architizer-style',
            get_stylesheet_uri(),
            array(),
            ARCHITIZER_VERSION
        );

        // 主题样式
        wp_enqueue_style(
            'architizer-main',
            ARCHITIZER_URL . '/assets/css/main.css',
            array(),
            ARCHITIZER_VERSION
        );

        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );
    }

    public function enqueue_scripts() {
        wp_enqueue_script('jquery');
        
        // LazyLoad
        wp_enqueue_script(
            'lazyload',
            ARCHITIZER_URL . '/assets/js/lazyload.min.js',
            array(),
            ARCHITIZER_VERSION,
            true
        );

        // FancyBox
        wp_enqueue_script(
            'fancybox',
            ARCHITIZER_URL . '/assets/js/jquery.fancybox.min.js',
            array('jquery'),
            ARCHITIZER_VERSION,
            true
        );

        // 主题脚本
        wp_enqueue_script(
            'architizer-main',
            ARCHITIZER_URL . '/assets/js/main.js',
            array('jquery'),
            ARCHITIZER_VERSION,
            true
        );

        // 本地化脚本
        wp_localize_script('architizer-main', 'architizer_ajax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('architizer_load_more')
        ));
    }

    public function enqueue_admin_assets() {
        // 管理后台样式
        wp_enqueue_style(
            'architizer-admin',
            ARCHITIZER_URL . '/assets/css/admin.css',
            array(),
            ARCHITIZER_VERSION
        );
    }
} 