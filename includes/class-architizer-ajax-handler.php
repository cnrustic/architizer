<?php
class Architizer_Ajax_Handler {
    public function __construct() {
        add_action('wp_ajax_load_more_projects', array($this, 'load_more_projects'));
        add_action('wp_ajax_nopriv_load_more_projects', array($this, 'load_more_projects'));
        add_action('wp_ajax_search_projects', array($this, 'search_projects'));
        add_action('wp_ajax_nopriv_search_projects', array($this, 'search_projects'));
    }

    public function load_more_projects() {
        // 验证nonce
        check_ajax_referer('architizer_load_more', 'nonce');
        
        $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
        
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 12,
            'paged' => $page
        );
        
        $query = new WP_Query($args);
        
        ob_start();
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', 'project-card');
            }
            wp_reset_postdata();
        }
        $html = ob_get_clean();
        
        wp_send_json_success(array(
            'html' => $html,
            'hasMore' => $query->max_num_pages > $page
        ));
    }

    public function search_projects() {
        check_ajax_referer('architizer_search', 'nonce');
        
        $query = sanitize_text_field($_POST['query']);
        
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 5,
            's' => $query
        );
        
        $search_query = new WP_Query($args);
        
        $results = array();
        if($search_query->have_posts()) {
            while($search_query->have_posts()) {
                $search_query->the_post();
                $results[] = array(
                    'title' => get_the_title(),
                    'url' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')
                );
            }
            wp_reset_postdata();
        }
        
        wp_send_json_success($results);
    }
} 