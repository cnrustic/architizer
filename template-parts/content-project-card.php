<article class="project-card">
    <a href="<?php the_permalink(); ?>">
        <?php if(has_post_thumbnail()) : ?>
            <div class="project-thumbnail">
                <?php the_post_thumbnail('medium_large', array('class' => 'lazy')); ?>
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