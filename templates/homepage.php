<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<div class="max-width">
		<h1>An Alarm System for Your Links</h1>
		<p>Monitor pages with your guest posts, ads, and important links. Receive daily reports on the status of those links and pages.</p>
		<div class="signup-form">
			<a class="button" href="https://app.backlinksentry.com/#/signup">Create Free Account</a>
		</div>
		<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/screenshot.png'; ?>" />
	</div>
</section>
<?php get_footer(); ?>