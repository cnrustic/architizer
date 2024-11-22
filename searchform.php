<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-wrapper">
        <input type="search" 
               class="search-input" 
               placeholder="<?php echo esc_attr_x('搜索项目...', 'placeholder', 'architizer'); ?>"
               value="<?php echo get_search_query(); ?>" 
               name="s" />
        
        <!-- 限制搜索范围为项目 -->
        <input type="hidden" name="post_type" value="project" />
        
        <button type="submit" class="search-submit">
            <span class="screen-reader-text"><?php echo esc_html_x('搜索', 'submit button', 'architizer'); ?></span>
            <svg class="icon-search" width="20" height="20" viewBox="0 0 20 20">
                <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
            </svg>
        </button>
    </div>
</form> 