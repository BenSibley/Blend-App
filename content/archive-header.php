<?php
/* Category header */
if( is_home() || is_category() ){

	// get the post categories
	$categories = get_categories();

	$current_category = single_cat_title('', false);

	// comma-separate posts
	$separator = '';

	// create output variable
	$output = '';

	// if there are categories for the post
	if($categories){

		echo '<div class="archive-header">';
		if( is_home() ) {
			echo '<a class="current" href="' . site_url() . '/blog/">All</a>';
		} else {
			echo '<a href="' . site_url() . '/blog/">All</a>';
		}
		foreach($categories as $category) {
			if( $category->name == $current_category ) {
				$output .= '<a class="current" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'blend-app' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			} else {
				// output category name linked to the archive
				$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'blend-app' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
		}
		echo trim($output, $separator);
		echo "</div>";
	}
}
/* Tag header */
elseif( is_tag() ){ ?>
	<div class='archive-header'>
		<i class="fa fa-tag"></i>
		<h2>
			<?php _e('Tag archive for:', 'author'); ?>
			<?php single_tag_title(); ?>
		</h2>
	</div>
<?php
}
/* Author header */
elseif( is_author() ){
	$author = get_userdata(get_query_var('author')); ?>
	<div class='archive-header'>
		<i class="fa fa-user"></i>
		<h2>
			<?php _e('Author archive for:', 'author'); ?>
			<?php echo $author->nickname; ?>
		</h2>
	</div>
<?php
}
/* Date header */
elseif( is_date() ){ ?>
	<div class='archive-header'>
		<i class="fa fa-calendar"></i>
		<h2>
			<?php _e('Date archive for:', 'author'); ?>
			<?php single_month_title(' '); ?>
		</h2>
	</div>
<?php
}