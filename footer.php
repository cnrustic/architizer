</div><!-- #page -->
<?php if (is_front_page() || is_home()) : ?>
    <div class="expand-footer">
        <button class="expand-toggle">
            <span>z</span>
            <span class="expand-icon">▼</span>
        </button>
    </div>
<?php endif; ?>
<footer class="site-footer">
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

<?php if (is_front_page() || is_home()) : ?>
<div class="expand-footer">
    <button class="expand-toggle">
        <span>z</span>
        <span class="expand-icon">▼</span>
    </button>
</div>
<?php endif; ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
