<div <?php post_class(); ?>>
	<article>
		<?php blend_app_featured_image(); ?>
	    <div class='post-header'>
	        <h1 class='post-title'><?php the_title(); ?></h1>
		    <span class="post-date">
			    Published <?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_date( 'n/j/Y' ) ) ); ?>
			    by <?php the_author(); ?>
		    </span>
	    </div>
	    <div class="post-content">
	        <?php the_content(); ?>
	        <?php wp_link_pages(array('before' => '<p class="singular-pagination">' . __('Pages:','blend-app'), 'after' => '</p>', ) ); ?>
		    <?php get_template_part('content/post-categories'); ?>
		    <?php if ( function_exists( 'echo_ald_crp' ) ) echo_ald_crp(); ?>
		    <div class="after-post-blog-optin">
			    <form action="//backlinksentry.us9.list-manage.com/subscribe/post?u=d0524a8c838c5729cd2ee68d7&amp;id=a8450123db" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll" class="optin-container">
					    <h3 class="form-title">Get New Posts in Your Inbox</h3>
						    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="name@email.com">
						    <div class="response" id="mce-error-response" style="display:none"></div>
						    <div class="response" id="mce-success-response" style="display:none"></div>
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_d0524a8c838c5729cd2ee68d7_a8450123db" tabindex="-1" value=""></div>
					    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
				    </div>
			    </form>
		    </div>
	    </div>
	</article>
</div>
<?php comments_template(); ?>