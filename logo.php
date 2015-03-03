<?php
    if( is_page('Keyword Multiplier') ) {
        $logo = get_template_directory_uri() . '/assets/images/logo-dark-beta-small.png';
    } else {
        $logo = get_template_directory_uri() . '/assets/images/logo-white-beta-small.png';
    }
?>
<h1 id='site-title' class='site-title'>
    <span class='screen-reader-text'><?php echo get_bloginfo('name'); ?></span>
    <a href='<?php echo esc_url( home_url() ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>'>
        <img class='logo' src='<?php echo $logo; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>' />
    </a>
</h1>