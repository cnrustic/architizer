</div><!-- #page -->
<?php if (is_front_page() || is_home()) : ?>
    <div class="expand-footer">
        <button class="expand-toggle">
            <div class="footer-logo">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" width="20" height="20">';
                }
                ?>
            </div>
            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
<?php endif; ?>
<footer id="colophon" class="site-footer">
    <div class="footer-content">
        <!-- About 栏目 -->
        <div class="footer-column">
            <h4>about</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-about',
                'container' => false,
                'menu_class' => 'footer-menu'
            ));
            ?>
        </div>

        <!-- Connect 栏目 -->
        <div class="footer-column">
            <h4>connect</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-connect',
                'container' => false,
                'menu_class' => 'footer-menu'
            ));
            ?>
        </div>

        <!-- Join Today 栏目 -->

        <!-- Resources 栏目 -->
        <div class="footer-column">
            <h4>resources</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-resources',
                'container' => false,
                'menu_class' => 'footer-menu'
            ));
            ?>
        </div>

        <!-- Brand 栏目 -->
        <div class="footer-brand">
            <h4>Architizer</h4>
            <p>Architizer is how architects find building products.</p>
            <div class="social-icons">
                <!-- 社交媒体图标 -->
            </div>
        </div>
    </div>

    <!-- 版权信息 -->
    <div class="footer-bottom">
        <div class="copyright">
            <span>&copy; <?php echo date('Y'); ?> Architizer, Inc. All rights reserved.</span>
            <a href="/privacy">Privacy</a>
            <a href="/terms">Terms of Use</a>
            <a href="/cookie-policy">Cookie Policy</a>
            <a href="/do-not-sell">Do Not Sell or Share my Personal Information</a>
        </div>
    </div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const expandToggle = document.querySelector('.expand-toggle');
    const siteFooter = document.querySelector('.site-footer');
    const body = document.body;

    if (expandToggle && siteFooter) {
        expandToggle.addEventListener('click', function() {
            siteFooter.classList.toggle('expanded');
            body.classList.toggle('footer-expanded');
            
            // 更新按钮文字和图标
            const isExpanded = siteFooter.classList.contains('expanded');
            expandToggle.innerHTML = isExpanded ? 
                'Footer <svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 8L2 4h8L6 8z" fill="currentColor"/></svg>' : 
                'Footer <svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 4L2 8h8L6 4z" fill="currentColor"/></svg>';
        });
    }
});
</script>
<?php if (is_front_page() || is_home()) : ?>
<div class="expand-footer">
    <button class="expand-toggle">
    <div class="footer-logo">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" width="20" height="20">';
                }
                ?>
            </div>
        <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
    </button>
</div>
<?php endif; ?>
</div><!-- #page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const expandToggle = document.querySelector('.expand-toggle');
    const siteFooter = document.querySelector('.site-footer');
    const body = document.body;

    if (expandToggle && siteFooter) {
        expandToggle.addEventListener('click', function() {
            siteFooter.classList.toggle('expanded');
            body.classList.toggle('footer-expanded');
        });
    }
});
</script>
<?php wp_footer(); ?>
</body>
</html>
