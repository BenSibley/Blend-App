<?php

// Load the core theme framework.
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

// theme setup
function blend_app_theme_setup() {
	
    /* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
    
	// add Hybrid core functionality
    add_theme_support( 'hybrid-core-template-hierarchy' );
    add_theme_support( 'loop-pagination' );
	add_theme_support( 'cleaner-gallery' );

    // add functionality from WordPress core
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );

	// add inc folder files
	foreach (glob(trailingslashit( get_template_directory() ) . 'inc/*') as $filename)
	{
		include $filename;
	}

	// load text domain
	load_theme_textdomain('blend-app', get_template_directory() . '/languages');

	// register Primary menu
    register_nav_menus(array(
        'primary' => __('Primary', 'blend-app')
    ));
}
add_action( 'after_setup_theme', 'blend_app_theme_setup', 10 );

// turn off cleaner gallery if Jetpack gallery functions being used
function blend_app_remove_cleaner_gallery() {

	if( class_exists( 'Jetpack' ) && ( Jetpack::is_module_active( 'carousel' ) || Jetpack::is_module_active( 'tiled-gallery' ) ) ) {
		remove_theme_support( 'cleaner-gallery' );
	}
}
add_action( 'after_setup_theme', 'blend_app_remove_cleaner_gallery', 11 );

// register widget areas
function blend_app_register_widget_areas(){

    /* register after post content widget area */
    hybrid_register_sidebar( array(
        'name'         => __( 'Primary Sidebar', 'blend-app' ),
        'id'           => 'sidebar',
        'description'  => __( 'Widgets in this area will be shown in the sidebar next to the main post content', 'blend-app' )
    ) );
}
add_action('widgets_init','blend_app_register_widget_areas');

/* added to customize the comments. Same as default except -> added use of gravatar images for comment authors */
function blend_app_customize_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author">
                <?php
                // if is post author
                if( $comment->user_id === $post->post_author ) {
                    blend_app_profile_image_output();
                } else {
                    echo get_avatar( get_comment_author_email(), 36 );
                }
                ?>
                <div class="author-name">
                    <span><?php comment_author_link(); ?></span>
                    said:
                </div>
            </div>
            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', 'blend-app') ?></em>
                    <br />
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
            <div class="comment-footer">
                <span class="comment-date"><?php comment_date('n/j/Y'); ?></span>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'blend-app' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                <?php edit_comment_link( 'edit' ); ?>
            </div>
        </article>
    <?php
}

/* added HTML5 placeholders for each default field and aria-required to required */
function blend_app_update_fields($fields) {

	// get commenter object
    $commenter = wp_get_current_commenter();

	// are name and email required?
    $req = get_option( 'require_name_email' );

	// required or optional label to be added
	if( $req == 1 ) {
		$label = '*';
	} else {
		$label = ' (optional)';
	}

	// adds aria required tag if required
	$aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="comment-form-author">
            <label class="screen-reader-text">' . __("Your Name", "blend-app") . '</label>
            <input placeholder="' . __("Your Name", "blend-app") . $label . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30" ' . $aria_req . ' />
    	</p>';

    $fields['email'] =
        '<p class="comment-form-email">
            <label class="screen-reader-text">' . __("Your Email", "blend-app") . '</label>
            <input placeholder="' . __("Your Email", "blend-app") . $label . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30" ' . $aria_req . ' />
    	</p>';

    $fields['url'] =
        '<p class="comment-form-url">
            <label class="screen-reader-text">' . __("Your Website URL", "blend-app") . '</label>
            <input placeholder="' . __("Your URL", "blend-app") . ' (optional)" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" />
            </p>';

    return $fields;
}
add_filter('comment_form_default_fields','blend_app_update_fields');

function blend_app_update_comment_field($comment_field) {
	
	$comment_field =
        '<p class="comment-form-comment">
            <label class="screen-reader-text">' . __("Your Comment", "blend-app") . '</label>
            <textarea required placeholder="' . __("Enter Your Comment", "blend-app") . '&#8230;" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
	
	return $comment_field;
}
add_filter('comment_form_field_comment','blend_app_update_comment_field');

// remove allowed tags text after comment form
function blend_app_remove_comments_notes_after($defaults){

    $defaults['comment_notes_after']='';
    return $defaults;
}

add_action('comment_form_defaults', 'blend_app_remove_comments_notes_after');

// excerpt handling
function blend_app_excerpt() {

    // make post variable available
    global $post;

    // make 'read more' setting available
    global $more;

    // check for the more tag
    $ismore = strpos( $post->post_content, '<!--more-->');

    // use the read more link if present
    if($ismore) {
        the_content( __('Continue Reading', 'blend-app') . "<span class='screen-reader-text'>" . get_the_title() . "</span>");
    }
    // otherwise the excerpt is automatic, so output it
    else {
        the_excerpt();
    }
}

// filter the link on excerpts
function blend_app_excerpt_read_more_link($output) {
	global $post;
	return $output . "<p><a class='more-link' href='". get_permalink() ."'>" . __('Continue Reading', 'blend-app') . "<span class='screen-reader-text'>" . get_the_title() . "</span></a></p>";
}

add_filter('the_excerpt', 'blend_app_excerpt_read_more_link');

// switch [...] to ellipsis on automatic excerpt
function blend_app_new_excerpt_more( $more ) {
	return '&#8230;';
}
add_filter('excerpt_more', 'blend_app_new_excerpt_more');

// turns of the automatic scrolling to the read more link 
function blend_app_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'blend_app_remove_more_link_scroll' );

// change the length of the excerpts
function blend_app_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'blend_app_custom_excerpt_length', 99 );

// Adds navigation through pages in the loop
function blend_app_post_navigation() {
    if ( current_theme_supports( 'loop-pagination' ) ) loop_pagination();
}

// for displaying featured images
function blend_app_featured_image() {

	// get post object
	global $post;
	// default to no featured image
	$has_image = false;

	// if post has an image
	if (has_post_thumbnail( $post->ID ) ) {
		// get the full-size version of the image
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		// set $image = the url
		$image = $image[0];
		$has_image = true;
	}
	if ($has_image == true) {

		// on posts/pages display the featued image
		if(is_singular()){
			echo "<div class='featured-image' style=\"background-image: url('".$image."')\"></div>";
		}
		// on blog/archives display with a link
		else {
			echo "
                <div class='featured-image' style=\"background-image: url('".$image."')\">
                    <a href='" . get_permalink() ."'>" . get_the_title() . "</a>
                </div>
                ";
		}
	}
}

// puts site title & description in the title tag on front page
function blend_app_add_homepage_title( $title )
{
    if( empty( $title ) && ( is_home() || is_front_page() ) ) {
        return get_bloginfo( 'title' ) . ' | ' . get_bloginfo( 'description' );
    }
    return $title;
}
add_filter( 'wp_title', 'blend_app_add_homepage_title' );

// fix for bug with Disqus saying comments are closed
if ( function_exists( 'dsq_options' ) ) {
    remove_filter( 'comments_template', 'dsq_comments_template' );
    add_filter( 'comments_template', 'dsq_comments_template', 99 ); // You can use any priority higher than '10'
}

// list social media sites
function blend_app_social_site_list(){

    $social_sites = array('twitter', 'facebook', 'google-plus', 'flickr', 'pinterest', 'youtube', 'vimeo', 'tumblr', 'dribbble', 'rss', 'linkedin', 'instagram', 'reddit', 'soundcloud', 'spotify', 'vine','yahoo', 'behance', 'codepen', 'delicious', 'stumbleupon', 'deviantart', 'digg', 'git', 'hacker-news', 'steam', 'vk', 'weibo', 'tencent-weibo', 'email' );
    return $social_sites;
}

// associative array of social media sites
function blend_app_social_array(){

	$social_sites = array(
		'twitter' => 'blend_app_twitter_profile',
		'facebook' => 'blend_app_facebook_profile',
		'googleplus' => 'blend_app_googleplus_profile',
		'pinterest' => 'blend_app_pinterest_profile',
		'linkedin' => 'blend_app_linkedin_profile',
		'youtube' => 'blend_app_youtube_profile',
		'vimeo' => 'blend_app_vimeo_profile',
		'tumblr' => 'blend_app_tumblr_profile',
		'instagram' => 'blend_app_instagram_profile',
		'flickr' => 'blend_app_flickr_profile',
		'dribbble' => 'blend_app_dribbble_profile',
		'rss' => 'blend_app_rss_profile',
		'reddit' => 'blend_app_reddit_profile',
		'soundcloud' => 'blend_app_soundcloud_profile',
		'spotify' => 'blend_app_spotify_profile',
		'vine' => 'blend_app_vine_profile',
		'yahoo' => 'blend_app_yahoo_profile',
		'behance' => 'blend_app_behance_profile',
		'codepen' => 'blend_app_codepen_profile',
		'delicious' => 'blend_app_delicious_profile',
		'stumbleupon' => 'blend_app_stumbleupon_profile',
		'deviantart' => 'blend_app_deviantart_profile',
		'digg' => 'blend_app_digg_profile',
		'git' => 'blend_app_git_profile',
		'hacker-news' => 'blend_app_hacker-news_profile',
		'steam' => 'blend_app_steam_profile',
		'vk' => 'blend_app_vk_profile',
		'weibo' => 'blend_app_weibo_profile',
		'tencent-weibo' => 'blend_app_tencent_weibo_profile',
		'email' => 'blend_app_email_profile'
	);
	return $social_sites;
}

// retrieves the attachment ID from the file URL
function blend_app_get_image_id($url) {

    // Split the $url into two parts with the wp-content directory as the separator
    $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

    // Get the host of the current site and the host of the $url, ignoring www
    $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
    $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match
    if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
        return;
    }

    // Now we're going to quickly search the DB for any attachment GUID with a partial path match
    // Example: /uploads/2013/05/test-image.jpg
    global $wpdb;

    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

    // Returns null if no attachment is found
    return $attachment[0];
}

function blend_app_profile_image_output(){

    // use User's profile image, else default to their Gravatar
    if(get_the_author_meta('blend_app_user_profile_image')){

        // get the id based on the image's URL
        $image_id = blend_app_get_image_id(get_the_author_meta('blend_app_user_profile_image'));

        // retrieve the thumbnail size of profile image
        $image_thumb = wp_get_attachment_image($image_id, 'thumbnail');

        // display the image
        echo $image_thumb;

    } else {
        echo get_avatar( get_the_author_meta( 'ID' ), 36 );
    }
}

function blend_app_wp_backwards_compatibility() {

	// not using this function, simply remove it so use of "has_image_size" doesn't break < 3.9
	if( get_bloginfo('version') < 3.9 ) {
		remove_filter( 'image_size_names_choose', 'hybrid_image_size_names_choose' );
	}
}
add_action('init', 'blend_app_wp_backwards_compatibility');

/*
 * Set the date format for new users.
 * Needs to be done this way so that the date defaults to the right format, but can
 * still be changed from the Settings menu
 */
function blend_app_set_date_format() {

	// if the date format has never been set by blend_app, set it
	if( get_option('blend_app_date_format_origin') != 'updated' ) {
		update_option('date_format', 'F j, Y');

		// add option so never updates date format again. Allows users to change format.
		add_option('blend_app_date_format_origin', 'updated');
	}
}
add_action( 'init', 'blend_app_set_date_format' );

function blend_app_output_svg($svg) {

    if( $svg == 'calendar' ) {

        $svg = '<svg width="61px" height="60px" viewBox="0 0 61 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				    <desc>Calendar icon</desc>
				    <g id="Homepage" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				        <g id="Artboard-4" sketch:type="MSArtboardGroup" transform="translate(-609.000000, -1044.000000)" fill="#21313D">
				            <g id="benefits" sketch:type="MSLayerGroup" transform="translate(0.000000, 891.000000)">
				                <g id="benefit-2" transform="translate(460.000000, 110.000000)" sketch:type="MSShapeGroup">
				                    <g id="1419143744_calendar" transform="translate(149.500000, 43.000000)">
				                        <g id="calendar_1_">
				                            <path d="M55.00125,5.625 L46.875,5.625 L46.875,1.875 C46.875,0.838125 46.036875,0 45,0 C43.963125,0 43.125,0.838125 43.125,1.875 L43.125,5.625 L31.875,5.625 L31.875,1.875 C31.875,0.838125 31.035,0 30,0 C28.965,0 28.125,0.838125 28.125,1.875 L28.125,5.625 L16.875,5.625 L16.875,1.875 C16.875,0.838125 16.035,0 15,0 C13.965,0 13.125,0.838125 13.125,1.875 L13.125,5.625 L5.000625,5.625 C2.23875,5.625 0,7.861875 0,10.62375 L0,54.999375 C0,57.76125 2.23875,60 5.000625,60 L55.00125,60 C57.763125,60 60,57.76125 60,54.999375 L60,10.62375 C60,7.861875 57.763125,5.625 55.00125,5.625 L55.00125,5.625 Z M56.25,54.999375 C56.25,55.689375 55.689375,56.25 55.00125,56.25 L5.000625,56.25 C4.310625,56.25 3.75,55.689375 3.75,54.999375 L3.75,10.62375 C3.75,9.935625 4.310625,9.375 5.000625,9.375 L13.125,9.375 L13.125,13.125 C13.125,14.161875 13.965,15 15,15 C16.035,15 16.875,14.161875 16.875,13.125 L16.875,9.375 L28.125,9.375 L28.125,13.125 C28.125,14.161875 28.965,15 30,15 C31.035,15 31.875,14.161875 31.875,13.125 L31.875,9.375 L43.125,9.375 L43.125,13.125 C43.125,14.161875 43.963125,15 45,15 C46.036875,15 46.875,14.161875 46.875,13.125 L46.875,9.375 L55.00125,9.375 C55.689375,9.375 56.25,9.935625 56.25,10.62375 L56.25,54.999375 L56.25,54.999375 Z" id="Shape"></path>
				                            <rect id="Rectangle-path" x="13.125" y="22.5" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="13.125" y="31.875" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="13.125" y="41.25" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="26.25" y="41.25" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="26.25" y="31.875" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="26.25" y="22.5" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="39.375" y="41.25" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="39.375" y="31.875" width="7.5" height="5.625"></rect>
				                            <rect id="Rectangle-path" x="39.375" y="22.5" width="7.5" height="5.625"></rect>
				                        </g>
				                    </g>
				                </g>
				            </g>
				        </g>
				    </g>
				</svg>';
    } elseif( $svg == 'upwards-arrow' ) {

        $svg = '<svg width="61px" height="36px" viewBox="0 0 61 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				    <desc>Upwards arrow icon</desc>
				    <g id="Homepage" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				        <g id="Artboard-4" sketch:type="MSArtboardGroup" transform="translate(-229.000000, -1061.000000)">
				            <g id="benefits" sketch:type="MSLayerGroup" transform="translate(0.000000, 891.000000)">
				                <g id="benefit-1" transform="translate(80.000000, 110.000000)" sketch:type="MSShapeGroup">
				                    <g id="1419144858_ic_trending_up_48px" transform="translate(143.500000, 42.000000)">
				                        <path d="M48,18 L54.885,24.885 L40.245,39.51 L28.245,27.51 L6,49.755 L10.245,54 L28.245,36 L40.245,48 L59.115,29.115 L66,36 L66,18 L48,18 Z" id="Shape" fill="#21313D"></path>
				                        <path d="M0,0 L72,0 L72,72 L0,72 L0,0 Z" id="Shape"></path>
				                    </g>
				                </g>
				            </g>
				        </g>
				    </g>
				</svg>';
    } elseif( $svg == 'clock' ) {

        $svg = '<svg width="61px" height="60px" viewBox="0 0 61 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				    <desc>Clock icon</desc>
				    <g id="Homepage" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				        <g id="Artboard-4" sketch:type="MSArtboardGroup" transform="translate(-988.000000, -1046.000000)" fill="#21313D">
				            <g id="benefits" sketch:type="MSLayerGroup" transform="translate(0.000000, 891.000000)">
				                <g id="benefit-3" transform="translate(839.000000, 110.000000)" sketch:type="MSShapeGroup">
				                    <g id="1419143394_time" transform="translate(149.500000, 45.000000)">
				                        <g id="Group">
				                            <path d="M29.9534257,0.0774653465 C13.4188515,0.0774653465 0.0128316832,13.4834851 0.0128316832,30.0180594 C0.0128316832,46.5527525 13.4188515,59.9586535 29.9534257,59.9586535 C46.488,59.9586535 59.8940198,46.5527525 59.8940198,30.0180594 C59.8940198,13.4834851 46.488,0.0774653465 29.9534257,0.0774653465 L29.9534257,0.0774653465 Z M29.957882,56.4725164 C15.3732828,56.4725164 3.50788119,44.6071147 3.50788119,30.0225156 C3.50788119,15.438031 15.3732828,3.57251485 29.957882,3.57251485 C44.5424811,3.57251485 56.4078827,15.438031 56.4078827,30.0225156 C56.4078827,44.6072292 44.5425956,56.4725164 29.957882,56.4725164 L29.957882,56.4725164 Z" id="Shape"></path>
				                            <path d="M29.9534257,32.5131089 L14.9831287,32.5131089 L14.9831287,35.0081584 L32.4484752,35.0081584 L32.4484752,10.1600792 L29.9534257,10.1600792 L29.9534257,32.5131089 Z" id="Shape"></path>
				                        </g>
				                    </g>
				                </g>
				            </g>
				        </g>
				    </g>
				</svg>';
    } elseif( $svg == 'menu-icon' ) {

        $svg = '<svg width="24px" height="20px" viewBox="0 0 24 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				    <desc>Menu toggle icon</desc>
				    <g id="Homepage" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				        <g id="Artboard-4" sketch:type="MSArtboardGroup" transform="translate(-1152.000000, -32.000000)" fill="#152B3C">
				            <g id="sidebar" sketch:type="MSLayerGroup" transform="translate(23.000000, 0.000000)">
				                <path d="M1153.00003,48.9999964 C1153.00003,48.4531208 1152.5469,47.9999952 1152.00003,47.9999952 L1130,47.9999952 C1129.45313,47.9999952 1129,48.4531208 1129,48.9999964 L1129,50.9999988 C1129,51.5468745 1129.45313,52 1130,52 L1152.00003,52 C1152.5469,52 1153.00003,51.5468745 1153.00003,50.9999988 L1153.00003,48.9999964 Z M1153.00003,40.9999869 C1153.00003,40.4531112 1152.5469,39.9999857 1152.00003,39.9999857 L1130,39.9999857 C1129.45313,39.9999857 1129,40.4531112 1129,40.9999869 L1129,42.9999893 C1129,43.5468649 1129.45313,43.9999905 1130,43.9999905 L1152.00003,43.9999905 C1152.5469,43.9999905 1153.00003,43.5468649 1153.00003,42.9999893 L1153.00003,40.9999869 Z M1153.00003,32.9999774 C1153.00003,32.4531017 1152.5469,31.9999762 1152.00003,31.9999762 L1130,31.9999762 C1129.45313,31.9999762 1129,32.4531017 1129,32.9999774 L1129,34.9999797 C1129,35.5468554 1129.45313,35.9999809 1130,35.9999809 L1152.00003,35.9999809 C1152.5469,35.9999809 1153.00003,35.5468554 1153.00003,34.9999797 L1153.00003,32.9999774 Z" id="" sketch:type="MSShapeGroup"></path>
				            </g>
				        </g>
				    </g>
				</svg>';
    }

    return $svg;
}

function blend_app_signup_form() { ?>

    <div id="mc_embed_signup">
        <form action="//blendapp.us10.list-manage.com/subscribe/post?u=92c585bebdcda06856ba8ec9e&amp;id=f01e5cfeb3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll" class="input-container">
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="john@gmail.com">
                <div style="position: absolute; left: -5000px;"><input type="text" name="b_92c585bebdcda06856ba8ec9e_f01e5cfeb3" tabindex="-1" value=""></div>
                <input type="submit" value="Signup" name="subscribe" id="mc-embedded-subscribe" class="button">
            </div>
        </form>
    </div>

<?php }