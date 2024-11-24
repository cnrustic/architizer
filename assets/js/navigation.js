/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener('DOMContentLoaded', function() {
    // 获取元素并添加调试日志
    const siteNavigation = document.getElementById('site-navigation');
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');

    console.log('Elements found:', {
        menuToggle: menuToggle,
        mobileMenu: mobileMenu,
        siteNavigation: siteNavigation
    });

    // 移动菜单切换
    if (menuToggle && mobileMenu) {
        // 移动菜单按钮点击事件
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Menu toggle clicked');
            
            // 切换移动菜单状态
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            
            // 输出当前状态
            console.log('Menu state:', {
                buttonActive: this.classList.contains('active'),
                menuActive: mobileMenu.classList.contains('active')
            });
            
            // 更新aria-expanded属性
            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            
            // 控制页面滚动
            document.body.style.overflow = isExpanded ? 'hidden' : '';
        });

        // 点击页面其他区域关闭菜单
        document.addEventListener('click', function(e) {
            const isMenuActive = mobileMenu.classList.contains('active');
            const clickedOutside = !mobileMenu.contains(e.target) && !menuToggle.contains(e.target);
            
            if (isMenuActive && clickedOutside) {
                console.log('Closing menu by outside click');
                
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        // 添加ESC键关闭菜单
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                console.log('Closing menu by ESC key');
                
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });
    } else {
        console.warn('Mobile menu elements not found');
    }

    // 键盘导航支持
    if (siteNavigation) {
        const links = siteNavigation.getElementsByTagName('a');
        const linksWithChildren = siteNavigation.querySelectorAll('.menu-item-has-children > a');

        // 为所有链接添加键盘导航支持
        for (const link of links) {
            link.addEventListener('focus', toggleFocus, true);
            link.addEventListener('blur', toggleFocus, true);
        }

        // 为有子菜单的链接添加特殊处理
        for (const link of linksWithChildren) {
            link.addEventListener('touchstart', function(e) {
                const menuItem = this.parentNode;
                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (const sibling of menuItem.parentNode.children) {
                        if (sibling !== menuItem) {
                            sibling.classList.remove('focus');
                        }
                    }
                    menuItem.classList.toggle('focus');
                }
            });
        }
    }
});

/**
 * 切换焦点状态的辅助函数
 */
function toggleFocus() {
    let self = this;
    while (self.tagName.toLowerCase() !== 'nav') {
        if (self.tagName.toLowerCase() === 'li') {
            self.classList.toggle('focus');
        }
        self = self.parentNode;
    }
}