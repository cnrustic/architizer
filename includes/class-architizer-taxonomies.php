<?php
class Architizer_Taxonomies {
    public function __construct() {
        add_action('init', array($this, 'register_project_taxonomies'));
    }

    public function register_project_taxonomies() {
        // 项目类型分类
        $type_labels = array(
            'name'              => __('项目类型', 'architizer'),
            'singular_name'     => __('项目类型', 'architizer'),
            'search_items'      => __('搜索项目类型', 'architizer'),
            'all_items'         => __('所有项目类型', 'architizer'),
            'parent_item'       => __('父级项目类型', 'architizer'),
            'parent_item_colon' => __('父级项目类型:', 'architizer'),
            'edit_item'         => __('编辑项目类型', 'architizer'),
            'update_item'       => __('更新项目类型', 'architizer'),
            'add_new_item'      => __('添加新项目类型', 'architizer'),
            'menu_name'         => __('项目类型', 'architizer')
        );

        register_taxonomy('project_type', 'project', array(
            'hierarchical'      => true,
            'labels'            => $type_labels,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'project-type')
        ));
    }
} 