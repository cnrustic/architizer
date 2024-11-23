<?php
// 定义常量
define('ARCHITIZER_VERSION', '1.0.0');
define('ARCHITIZER_PATH', get_template_directory());
define('ARCHITIZER_URL', get_template_directory_uri());

// 加载核心类文件
require_once ARCHITIZER_PATH . '/includes/class-architizer-post-types.php';
require_once ARCHITIZER_PATH . '/includes/class-architizer-taxonomies.php';
require_once ARCHITIZER_PATH . '/includes/class-architizer-ajax-handler.php';
require_once ARCHITIZER_PATH . '/includes/class-architizer-assets.php';

// 初始化类
function architizer_init() {
    // 实例化各个类
    new Architizer_Post_Types();
    new Architizer_Taxonomies();
    new Architizer_Ajax_Handler();
    new Architizer_Assets();
}
add_action('after_setup_theme', 'architizer_init');

/**
 * 注册导航菜单
 */
function architizer_register_menus() {
    register_nav_menus(array(
        'menu-1' => esc_html__('主菜单', 'architizer'),
        'menu-right' => esc_html__('右侧菜单', 'architizer'),  // 修复了逗号
        'primary' => esc_html__('主导航', 'architizer'),
        'footer-about' => esc_html__('Footer About', 'architizer'),
        'footer-connect' => esc_html__('Footer Connect', 'architizer'),
        'footer-join' => esc_html__('Footer Join Today', 'architizer'),
        'footer-resources' => esc_html__('Footer Resources', 'architizer')
    ));
}
add_action('init', 'architizer_register_menus');

/**
 * 主题设置
 */
function architizer_setup() {
    // 添加缩略图支持
    add_theme_support('post-thumbnails');
    
    // 添加自定义图片尺寸
    add_image_size('project-thumbnail', 600, 400, true);
    
    // 添加主题支持
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
}
add_action('after_setup_theme', 'architizer_setup');

/**
 * 加载脚本和样式
 */
function architizer_scripts() {
    // 样式文件
    wp_enqueue_style('architizer-main', ARCHITIZER_URL . '/assets/css/main.css', array(), ARCHITIZER_VERSION);
    wp_enqueue_style('architizer-style', get_stylesheet_uri(), array(), ARCHITIZER_VERSION);
    wp_enqueue_style('fancybox', ARCHITIZER_URL . '/assets/css/jquery.fancybox.min.css', array(), '3.5.7');

    // JavaScript 文件
    wp_enqueue_script('jquery');
    wp_enqueue_script('fancybox', ARCHITIZER_URL . '/assets/js/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
    wp_enqueue_script('lazyload', ARCHITIZER_URL . '/assets/js/lazyload.min.js', array(), '17.8.3', true);
    wp_enqueue_script('architizer-navigation', ARCHITIZER_URL . '/assets/js/navigation.js', array(), ARCHITIZER_VERSION, true);

    // 初始化 LazyLoad
    wp_add_inline_script('lazyload', '
        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
        });
    ');
}
add_action('wp_enqueue_scripts', 'architizer_scripts');