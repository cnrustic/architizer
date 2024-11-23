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

function architizer_register_menus() {
    register_nav_menus(array(
        'primary' => '主导航',
        'footer-about' => 'Footer About',
        'footer-connect' => 'Footer Connect',
        'footer-join' => 'Footer Join Today',
        'footer-resources' => 'Footer Resources'
    ));
}
add_action('init', 'architizer_register_menus');
function architizer_setup() {
    // 添加缩略图支持
    add_theme_support('post-thumbnails');
    
    // 添加自定义图片尺寸
    add_image_size('project-thumbnail', 600, 400, true);
    
    // 优化项目文章类型注册
    register_post_type('project', [
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        // ... 其他设置
    ]);
}
/**
 * Enqueue scripts and styles.
 */
function architizer_scripts() {
    // 加载主样式文件
    wp_enqueue_style('architizer-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    
    // 加载WordPress默认样式
    wp_enqueue_style('architizer-style', get_stylesheet_uri(), array(), '1.0.0');
    // FancyBox CSS
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), '3.5.7');

    // jQuery (如果需要)
    wp_enqueue_script('jquery');
    
    // FancyBox
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
    
    // LazyLoad
    wp_enqueue_script('lazyload', get_template_directory_uri() . '/assets/js/lazyload.min.js', array(), '17.8.3', true);
    
    // 加载JavaScript文件
    wp_enqueue_script('architizer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);
   
    // 初始化脚本
    wp_add_inline_script('lazyload', '
        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
        });
    ');
}
add_action('wp_enqueue_scripts', 'architizer_scripts');