<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<h1>Your Stripe Data in Helpscout</h1>
	<p>Blend integrates your Stripe data with Helpscout, so you know who you're talking to, instantly.</p>
	<div class="signup-form">
		<img class="stripe-helpscout" src="<?php echo trailingslashit(get_template_directory_uri()); ?>assets/images/stripe-helpscout.png" />
		<?php echo blend_app_signup_form(); ?>
		<p>Signup to get early access to the app.</p>
	</div>
	<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/primary-image.png'; ?>" />
</section>
<?php get_footer(); ?>