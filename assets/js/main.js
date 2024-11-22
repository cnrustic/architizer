jQuery(document).ready(function($) {
    // 懒加载初始化
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });

    // 无限加载
    var loading = false;
    var page = 1;
    var $container = $('#projects-container');
    var $loadMoreBtn = $('#load-more-btn');

    function loadMoreProjects() {
        if(loading) return;
        
        loading = true;
        $loadMoreBtn.text('加载中...');

        $.ajax({
            url: architizer_ajax.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_projects',
                nonce: architizer_ajax.nonce,
                page: page + 1
            },
            success: function(response) {
                if(response.success && response.data) {
                    page++;
                    $container.append(response.data);
                    lazyLoadInstance.update();
                    
                    if(response.data.trim() === '') {
                        $loadMoreBtn.hide();
                    }
                } else {
                    $loadMoreBtn.hide();
                }
            },
            error: function() {
                console.log('加载失败');
            },
            complete: function() {
                loading = false;
                $loadMoreBtn.text('加载更多');
            }
        });
    }

    $loadMoreBtn.on('click', loadMoreProjects);

    // 搜索功能
    var searchTimeout;
    $('.search-input').on('input', function() {
        clearTimeout(searchTimeout);
        var query = $(this).val();
        
        searchTimeout = setTimeout(function() {
            if(query.length > 2) {
                $.ajax({
                    url: architizer_ajax.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'search_projects',
                        nonce: architizer_ajax.nonce,
                        query: query
                    },
                    success: function(response) {
                        if(response.success) {
                            $('.search-results').html(response.data).show();
                        }
                    }
                });
            } else {
                $('.search-results').hide();
            }
        }, 500);
    });

    // 点击外部关闭搜索结果
    $(document).on('click', function(e) {
        if(!$(e.target).closest('.search-box').length) {
            $('.search-results').hide();
        }
    });

    // 页脚展开/收起功能
    const $expandBtn = $('.expand-toggle');
    const $footer = $('.site-footer');
    const $body = $('body');
    let isExpanded = false;
    
    if ($('body').hasClass('home')) {
        $expandBtn.on('click', function(e) {
            e.preventDefault();
            isExpanded = !isExpanded;
            $footer.toggleClass('expanded');
            $body.toggleClass('footer-expanded');
            
            // 更新图标方向
            $('.expand-icon').text(isExpanded ? '▲' : '▼');
        });

        // 防止点击页脚时收起
        $footer.on('click', function(e) {
            e.stopPropagation();
        });

        // 点击页面其他区域时收起页脚
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-footer, .expand-footer').length && isExpanded) {
                isExpanded = false;
                $footer.removeClass('expanded');
                $body.removeClass('footer-expanded');
                $('.expand-icon').text('▼');
            }
        });
    }

    // FancyBox 初始化
    if(typeof $.fn.fancybox !== 'undefined') {
        $('[data-fancybox]').fancybox({
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "close"
            ],
            loop: true,
            protect: true
        });
    }

    // 响应式导航菜单
    const $menuToggle = $('.menu-toggle');
    const $navMenu = $('.nav-menu');
    
    $menuToggle.on('click', function() {
        $navMenu.toggleClass('active');
        $(this).toggleClass('active');
    });

    // 滚动时处理头部
    let lastScroll = 0;
    $(window).on('scroll', function() {
        const currentScroll = $(this).scrollTop();
        
        // 向下滚动时隐藏头部，向上滚动时显示
        if(currentScroll > lastScroll && currentScroll > 100) {
            $('.site-header').addClass('header-hidden');
        } else {
            $('.site-header').removeClass('header-hidden');
        }
        
        lastScroll = currentScroll;
    });

    // 窗口调整大小时重计算布局
    $(window).on('resize', function() {
        if(isExpanded) {
            const footerHeight = $footer.outerHeight();
            $body.css('margin-bottom', footerHeight + 'px');
        }
    });
});