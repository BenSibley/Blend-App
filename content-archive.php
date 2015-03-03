<div <?php post_class(); ?>>
	<article>
		<?php blend_app_featured_image(); ?>
		<div class='post-header'>
			<h1 class='post-title'>
				<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
		</div>
		<div class="post-content">
			<?php blend_app_excerpt(); ?>
		</div>
	</article>
</div>