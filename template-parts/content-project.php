<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- 项目头部信息 -->
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <div class="project-meta">
            <?php if ($location = get_field('project_location')) : ?>
                <span class="location"><?php echo esc_html($location); ?></span>
            <?php endif; ?>
            <?php if ($architect = get_field('architect')) : ?>
                <span class="architect"><?php echo esc_html($architect); ?></span>
            <?php endif; ?>
        </div>
    </header>

    <!-- 项目图库 -->
    <?php if ($gallery = get_field('project_gallery')) : ?>
        <div class="project-gallery">
            <?php foreach ($gallery as $image) : ?>
                <figure class="gallery-item">
                    <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                </figure>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- 项目详细信息 -->
    <div class="project-details">
        <div class="project-info-grid">
            <!-- 客户信息 -->
            <?php if ($client = get_field('project_client')) : ?>
                <div class="info-item">
                    <h3><?php esc_html_e('客户', 'architizer'); ?></h3>
                    <p><?php echo esc_html($client); ?></p>
                </div>
            <?php endif; ?>

            <!-- 建筑面积 -->
            <?php if ($area = get_field('project_area')) : ?>
                <div class="info-item">
                    <h3><?php esc_html_e('建筑面积', 'architizer'); ?></h3>
                    <p><?php echo esc_html($area); ?> m²</p>
                </div>
            <?php endif; ?>

            <!-- 完工年份 -->
            <?php if ($year = get_field('project_year')) : ?>
                <div class="info-item">
                    <h3><?php esc_html_e('完工年份', 'architizer'); ?></h3>
                    <p><?php echo esc_html($year); ?></p>
                </div>
            <?php endif; ?>

            <!-- 项目状态 -->
            <?php if ($status = get_field('projec_status')) : ?>
                <div class="info-item">
                    <h3><?php esc_html_e('项目状态', 'architizer'); ?></h3>
                    <p><?php echo esc_html($status); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- 项目描述 -->
        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <!-- 项目团队 -->
        <?php if (have_rows('project_team')) : ?>
            <div class="project-team">
                <h3><?php esc_html_e('项目团队', 'architizer'); ?></h3>
                <div class="team-members">
                    <?php while (have_rows('project_team')) : the_row(); ?>
                        <div class="team-member">
                            <span class="name"><?php echo esc_html(get_sub_field('project_team_name')); ?></span>
                            <span class="position"><?php echo esc_html(get_sub_field('project_team_posts')); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 技术规格 -->
        <?php if ($specs = get_field('Technical_Specifications')) : ?>
            <div class="technical-specs">
                <h3><?php esc_html_e('技术规格', 'architizer'); ?></h3>
                <?php echo wp_kses_post($specs); ?>
            </div>
        <?php endif; ?>

        <!-- 获奖情况 -->
        <?php if (have_rows('Awards')) : ?>
            <div class="awards">
                <h3><?php esc_html_e('获奖情况', 'architizer'); ?></h3>
                <div class="awards-list">
                    <?php while (have_rows('Awards')) : the_row(); ?>
                        <div class="award-item">
                            <span class="award-name"><?php echo esc_html(get_sub_field('Name_of_the_award')); ?></span>
                            <span class="award-year"><?php echo esc_html(get_sub_field('Year_of_Award')); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</article> 