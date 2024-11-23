<?php
/**
 * The front page template file
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <div class="hero-section">
        <?php
        // 获取特色项目
        $featured_projects = new WP_Query([
            'post_type' => 'project',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);

        if ($featured_projects->have_posts()) : ?>
            <div class="projects-grid">
                <?php while ($featured_projects->have_posts()) : $featured_projects->the_post(); ?>
                    <article class="project-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="project-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="project-info">
                            <h2 class="project-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if ($location = get_field('project_location')) : ?>
                                <div class="project-location"><?php echo esc_html($location); ?></div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
    <!-- End Hero Section -->

</main>

<?php
get_footer();