<div class='search-form-container'>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
        <input type="search" class="search-field" placeholder="<?php _e('Search...', 'blend-app'); ?>" value="" name="s" title="<?php _e('Search for:', 'blend-app'); ?>" />
        <input type="submit" class="search-submit" value='<?php _e('Go', 'blend-app'); ?>' />
    </form>
</div>