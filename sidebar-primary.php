<?php

if( is_page('Homepage') || is_page('keyword-multiplier') ) {
    return;
}
?>

<aside class="sidebar sidebar-primary" id="sidebar-primary" role="complementary">
    <div id="icon-container" class="icon-container">
        <ul class="social-media-icons">
            <li>
                <a href="https://twitter.com/BacklinkSentry" target="_blank">
                    <i class="fa fa-twitter-square"></i>
                </a>
            </li>
            <li>
                <a href="http://www.backlinksentry.com/feed/" target="_blank">
                    <i class="fa fa-rss-square"></i>
                </a>
            </li>
        </ul>
        <div id="search-sidebar" class="search-sidebar">
            <?php echo get_search_form(); ?>
            <button id="search-button" class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div class="bs-sidebar-ad">
        <span>Brought to you by</span>
        <img class='logo' src='<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.png' alt='<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>' />
        <a class="button" href="<?php echo site_url(); ?>">Learn More</a>
    </div>
    <!-- Begin MailChimp Signup Form -->
    <div class="sidebar-blog-optin">
        <form action="//backlinksentry.us9.list-manage.com/subscribe/post?u=d0524a8c838c5729cd2ee68d7&amp;id=a8450123db" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div>
                <h3 class="form-title">Get posts via email</h3>
                <div class="input-container">
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="name@email.com">
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;"><input type="text" name="b_d0524a8c838c5729cd2ee68d7_a8450123db" tabindex="-1" value=""></div>
                <div class="input-container">
                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                </div>
            </div>
        </form>
    </div>
    <!--End mc_embed_signup-->
    <div class="sidebar-categories">
        <?php wp_list_categories(array('show_count' => 1)); ?>
    </div>
</aside><!-- #sidebar-primary -->