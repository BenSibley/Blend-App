<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<div class="max-width">
		<h1>Your Stripe Data in Helpscout</h1>
		<p>Blend integrates your Stripe data with Helpscout, so you know who you're talking to, instantly.</p>
		<div class="signup-form">
			<?php echo blend_app_signup_form(); ?>
			<p>Signup to get early access to the app.</p>
		</div>
		<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/screenshot.png'; ?>" />
	</div>
</section>
<?php get_footer(); ?>