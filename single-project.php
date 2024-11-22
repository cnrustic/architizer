<?php
/**
 * 项目详情页面模板
 */

get_header(); ?>

<main class="single-project">
    <article class="project-content">
        <!-- 项目头部信息 -->
        <header class="project-header">
            <div class="project-title-area">
                <h1><?php the_title(); ?></h1>
                <?php
                // 获取项目类型分类并添加链接
                $project_types = get_the_terms(get_the_ID(), 'project_type');
                if ($project_types && !is_wp_error($project_types)) {
                    echo '<div class="project-types">';
                    foreach ($project_types as $type) {
                        echo '<a href="' . esc_url(get_term_link($type)) . '" class="project-type">' 
                            . esc_html($type->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </header>

        <!-- 项目主图 -->
        <?php if (has_post_thumbnail()): ?>
        <div class="project-featured-image">
            <?php 
            the_post_thumbnail('full', array(
                'loading' => 'eager',
                'class' => 'featured-image'
            )); 
            ?>
        </div>
        <?php endif; ?>

        <!-- 项目详情 -->
        <div class="project-details">
            <div class="project-info-grid">
                <?php
                // 获取所有字段值
                $client = get_field('project_client');
                $location = get_field('project_location');
                $area = get_field('project_area');
                $year = get_field('project_year');
                $status = get_field('project_status');
                $architect = get_field('architect');
                $gallery = get_field('project_gallery');

                // 项目状态
                if($status) : ?>
                    <div class="info-item">
                        <h3>项目状态</h3>
                        <p><?php echo esc_html($status); ?></p>
                    </div>
                <?php endif;

                // 建筑师
                if($architect) : ?>
                    <div class="info-item">
                        <h3>建筑师</h3>
                        <p><?php echo esc_html($architect); ?></p>
                    </div>
                <?php endif;

                // 客户信息
                if($client) : ?>
                    <div class="info-item">
                        <h3>客户</h3>
                        <p><?php echo esc_html($client); ?></p>
                    </div>
                <?php endif;

                // 地点信息
                if($location) : ?>
                    <div class="info-item">
                        <h3>地点</h3>
                        <p><?php echo esc_html($location); ?></p>
                    </div>
                <?php endif;

                // 面积信息
                if($area) : ?>
                    <div class="info-item">
                        <h3>建筑面积</h3>
                        <p><?php echo esc_html($area); ?> m²</p>
                    </div>
                <?php endif;

                // 年份信息
                if($year) : ?>
                    <div class="info-item">
                        <h3>完工年份</h3>
                        <p><?php echo esc_html($year); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 项目描述 -->
            <div class="project-description">
                <?php the_content(); ?>
            </div>

            <!-- 项目团队 -->
            <?php if(have_rows('project_team')): ?>
            <div class="project-team">
                <h2>项目团队</h2>
                <div class="team-grid">
                    <?php while(have_rows('project_team')): the_row(); ?>
                        <div class="team-member">
                            <h3><?php echo esc_html(get_sub_field('name')); ?></h3>
                            <div class="position"><?php echo esc_html(get_sub_field('position')); ?></div>
                            <div class="description"><?php echo esc_html(get_sub_field('description')); ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- 技术规格 -->
            <?php if(have_rows('Technical_Specifications')): ?>
            <div class="technical-specs">
                <h2>技术规格</h2>
                <div class="specs-grid">
                    <?php while(have_rows('Technical_Specifications')): the_row(); ?>
                        <div class="spec-item">
                            <strong><?php echo esc_html(get_sub_field('spec_name')); ?>:</strong>
                            <?php echo esc_html(get_sub_field('spec_value')); ?>
                            <?php if(get_sub_field('unit')): ?>
                                <?php echo esc_html(get_sub_field('unit')); ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- 获奖情况 -->
            <?php if(have_rows('Awards')): ?>
            <div class="awards">
                <h2>获奖情况</h2>
                <div class="awards-list">
                    <?php while(have_rows('Awards')): the_row(); ?>
                        <div class="award-item">
                            <h3><?php echo esc_html(get_sub_field('award_name')); ?></h3>
                            <div class="award-year"><?php echo esc_html(get_sub_field('award_year')); ?></div>
                            <?php if(get_sub_field('award_organization')): ?>
                                <div class="award-org"><?php echo esc_html(get_sub_field('award_organization')); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- 项目图库 -->
            <?php if($gallery) : ?>
            <div class="project-gallery">
                <?php foreach($gallery as $image) : ?>
                    <figure class="gallery-item">
                        <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery">
                            <img src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                 alt="<?php echo esc_attr($image['alt']); ?>"
                                 loading="lazy"
                                 class="gallery-image">
                        </a>
                    </figure>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- 相关项目 -->
        <?php
        $related_args = array(
            'post_type' => 'project',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand'
        );
        $related_projects = new WP_Query($related_args);

        if ($related_projects->have_posts()): ?>
        <div class="related-projects">
            <h2>相关项目</h2>
            <div class="projects-grid">
                <?php while ($related_projects->have_posts()): $related_projects->the_post(); ?>
                    <article class="project-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('class' => 'project-thumbnail')); ?>
                            <?php endif; ?>
                            <div class="project-info">
                                <h3><?php the_title(); ?></h3>
                                <?php 
                                $location = get_field('project_location');
                                if($location) : ?>
                                    <p class="project-location"><?php echo esc_html($location); ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
        <?php 
        wp_reset_postdata();
        endif; 
        ?>

        <!-- 项目导航 -->
        <nav class="project-navigation">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            
            if ($prev_post || $next_post) :
            ?>
            <div class="nav-links">
                <?php if ($prev_post) : ?>
                    <div class="nav-previous">
                        <a href="<?php echo get_permalink($prev_post); ?>">
                            <span class="nav-subtitle">上一个项目</span>
                            <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($next_post) : ?>
                    <div class="nav-next">
                        <a href="<?php echo get_permalink($next_post); ?>">
                            <span class="nav-subtitle">下一个项目</span>
                            <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </nav>
    </article>
</main>

<?php get_footer(); ?>