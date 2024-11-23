<?php
/**
 * The template for displaying project archive pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>
        <header class="page-header">
            <?php
            post_type_archive_title('<h1 class="page-title">', '</h1>');
            ?>
        </header>

        <!-- 添加筛选部分 -->
        <div class="filter-section">
            <?php
            $terms = get_terms([
                'taxonomy' => 'project_type',
                'hide_empty' => true,
            ]);
            if (!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="filter-options">
                    <a href="<?php echo get_post_type_archive_link('project'); ?>" 
                       class="filter-item <?php echo !get_query_var('project_type') ? 'active' : ''; ?>">
                        <?php esc_html_e('全部项目', 'architizer'); ?>
                    </a>
                    <?php foreach ($terms as $term) : ?>
                        <a href="<?php echo get_term_link($term); ?>" 
                           class="filter-item <?php echo get_query_var('project_type') === $term->slug ? 'active' : ''; ?>">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="projects-grid">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', 'project-grid');
            endwhile;
            ?>
        </div>

        <?php
        the_posts_navigation();

    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>

</main>

<?php
get_footer();
?> 