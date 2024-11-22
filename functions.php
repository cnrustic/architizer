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