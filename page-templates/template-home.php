<?php
/**
 * Template Name: 首页模板
 * 
 * 这是网站的首页模板
 */

get_header(); ?>

<main class="site-main">
    <!-- 特色项目区域 -->
    <section class="featured-projects">
        <div class="featured-grid">
            <?php
            // 获取特色项目
            $featured_args = array(
                'post_type' => 'project',
                'posts_per_page' => 3,
                'meta_key' => 'featured_project',
                'meta_value' => 'yes'
            );
            $featured_query = new WP_Query($featured_args);
            
            if($featured_query->have_posts()) :
                while($featured_query->have_posts()) : $featured_query->the_post();
            ?>
                <article class="featured-project <?php echo $featured_query->current_post === 0 ? 'main-feature' : ''; ?>">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()) : ?>
                            <div class="project-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="project-content">
                            <div class="project-meta">
                                <?php
                                $terms = get_the_terms(get_the_ID(), 'project_type');
                                if($terms && !is_wp_error($terms)) {
                                    foreach($terms as $term) {
                                        echo '<span class="category">' . esc_html($term->name) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <h2 class="project-title"><?php the_title(); ?></h2>
                            <?php 
                            $location = get_field('project_location');
                            if($location) : ?>
                                <div class="project-location"><?php echo esc_html($location); ?></div>
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- 项目列表区域 -->
    <section class="projects-grid" id="projects-container">
        <?php
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 12,
            'paged' => 1
        );
        $query = new WP_Query($args);
        
        if($query->have_posts()) :
            while($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/content', 'project-card');
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </section>

    <!-- 加载更多按钮 -->
    <div class="load-more" data-page="1">
        <button id="load-more-btn">加载更多</button>
    </div>
</main>

<?php get_footer(); ?>