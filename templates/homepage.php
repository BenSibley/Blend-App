<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<div class="max-width">
		<h1>More Personal Support at a Glance</h1>
		<p>Blend integrates your Stripe data with Helpscout, so you know who you're talking to, instantly.</p>
		<div class="signup-form">
			<?php echo blend_app_signup_form(); ?>
		</div>
		<p>We're busy building now, but we'll be launching very soon. Signup to get early access to the app.</p>
		<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/screenshot.png'; ?>" />
	</div>
</section>
<?php get_footer(); ?>