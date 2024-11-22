<?php
class Architizer_Post_Types {
    public function __construct() {
        add_action('init', array($this, 'register_project_post_type'));
    }

    public function register_project_post_type() {
        $labels = array(
            'name'               => __('项目', 'architizer'),
            'singular_name'      => __('项目', 'architizer'),
            'menu_name'          => __('项目', 'architizer'),
            'add_new'            => __('添加项目', 'architizer'),
            'add_new_item'       => __('添加新项目', 'architizer'),
            'edit_item'          => __('编辑项目', 'architizer'),
            'new_item'           => __('新项目', 'architizer'),
            'view_item'          => __('查看项目', 'architizer'),
            'search_items'       => __('搜索项目', 'architizer'),
            'not_found'          => __('未找到项目', 'architizer'),
            'not_found_in_trash' => __('回收站中未找到项目', 'architizer')
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_rest'        => true, // Gutenberg 编辑器支持
            'menu_icon'           => 'dashicons-building',
            'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
            'rewrite'             => array('slug' => 'projects'),
            'menu_position'       => 5,
            'capability_type'     => 'post'
        );

        register_post_type('project', $args);
    }
} 