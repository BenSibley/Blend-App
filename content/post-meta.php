<div id="post-meta" class="post-meta">
	<div class="post-date">
		<i class="fa fa-calendar"></i>
		<a href="<?php echo get_month_link( get_the_date('Y'), get_the_date('n') ); ?>">
			<?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_date( 'n/j/Y' ) ) ); ?>
		</a>
	</div>
	<div class="post-author">
		<i class="fa fa-user"></i>
		<?php the_author_posts_link(); ?>
	</div>
	<div class="post-comments">
		<i class="fa fa-comment"></i>
		<?php
		if( ! comments_open() && get_comments_number() < 1 ) :
			comments_number( __( 'Comments closed', 'blend-app' ), __( 'One Comment', 'blend-app'), __( '% Comments', 'blend-app' ) );
		else :
			echo '<a href="' . get_comments_link() . '">';
				comments_number( __( 'Leave a Comment', 'blend-app' ), __( 'One Comment', 'blend-app'), __( '% Comments', 'blend-app' ) );
			echo '</a>';
		endif;
		?>
	</div>
</div>