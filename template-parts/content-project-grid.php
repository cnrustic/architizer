<?php
/**
 * Template part for displaying project in grid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('project-grid-item'); ?>>
    <div class="project-card">
        <?php if (has_post_thumbnail()) : ?>
            <div class="project-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large', array('class' => 'project-image')); ?>
                </a>
                <?php 
                // 获取项目类型并显示
                $project_types = get_the_terms(get_the_ID(), 'project_type');
                if ($project_types && !is_wp_error($project_types)) : ?>
                    <div class="project-types">
                        <?php foreach ($project_types as $type) : ?>
                            <span class="project-type"><?php echo esc_html($type->name); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="project-info">
            <h2 class="project-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            
            <div class="project-meta">
                <?php if ($location = get_field('project_location')) : ?>
                    <span class="project-location">
                        <?php echo esc_html($location); ?>
                    </span>
                <?php endif; ?>
                
                <?php if ($architect = get_field('architect')) : ?>
                    <span class="project-architect">
                        <?php echo esc_html($architect); ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($status = get_field('projec_status')) : ?>
                <div class="project-status">
                    <span class="status-badge <?php echo sanitize_title($status); ?>">
                        <?php echo esc_html($status); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article> 