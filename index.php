<?php
get_header();
?>

<main class="site-main">
    <div class="projects-grid">
        <?php
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 12
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                ?>
                <article class="project-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                    </a>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</main>

<?php
get_footer();