<?php get_header(); ?>

<main class="site-main error-404">
    <div class="error-content">
        <h1 class="error-title"><?php esc_html_e('页面未找到', 'architizer'); ?></h1>
        
        <div class="error-description">
            <p><?php esc_html_e('抱歉，您访问的页面不存在或已被移除。', 'architizer'); ?></p>
        </div>

        <!-- 推荐项目 -->
        <div class="suggested-projects">
            <h2><?php esc_html_e('推荐项目', 'architizer'); ?></h2>
            
            <div class="projects-grid">
                <?php
                $args = array(
                    'post_type' => 'project',
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                );
                
                $query = new WP_Query($args);
                
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('template-parts/content', 'project-card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <div class="error-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                <?php esc_html_e('返回首页', 'architizer'); ?>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?> 