<?php get_header(); ?>

<main class="site-main taxonomy-projects">
    <div class="taxonomy-header">
        <?php
        $term = get_queried_object();
        ?>
        <h1 class="taxonomy-title"><?php echo esc_html($term->name); ?></h1>
        <?php if ($term->description) : ?>
            <div class="taxonomy-description">
                <?php echo wp_kses_post($term->description); ?>
            </div>
        <?php endif; ?>
        
        <!-- 分类统计 -->
        <div class="taxonomy-meta">
            <?php printf(
                esc_html(_n('%s 个项目', '%s 个项目', $term->count, 'architizer')),
                number_format_i18n($term->count)
            ); ?>
        </div>
    </div>

    <div class="projects-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'project-card');
            endwhile;
        endif;
        ?>
    </div>

    <?php the_posts_pagination(); ?>
</main>

<?php get_footer(); ?> 