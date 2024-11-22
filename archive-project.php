<?php get_header(); ?>

<main class="site-main archive-projects">
    <div class="archive-header">
        <h1 class="archive-title"><?php esc_html_e('项目展示', 'architizer'); ?></h1>
        
        <!-- 项目分类筛选 -->
        <div class="project-filters">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'project_type',
                'hide_empty' => true
            ));
            
            if ($terms && !is_wp_error($terms)) : ?>
                <select class="project-type-filter">
                    <option value=""><?php esc_html_e('所有类型', 'architizer'); ?></option>
                    <?php foreach ($terms as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>">
                            <?php echo esc_html($term->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </div>
    </div>

    <!-- 项目列表 -->
    <div class="projects-grid" id="projects-container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'project-card');
            endwhile;
        else : ?>
            <div class="no-projects">
                <p><?php esc_html_e('暂无项目', 'architizer'); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 分页导航 -->
    <?php
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('上一页', 'architizer'),
        'next_text' => __('下一页', 'architizer')
    ));
    ?>
</main>

<?php get_footer(); ?> 