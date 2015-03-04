<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<h1>Stripe Customer Data in Helpscout</h1>
	<p>Blendapp.io integrates your Stripe customer data with Helpscout, so you can provide more personal support, faster</p>
	<div class="signup-form">
		<img class="stripe-helpscout" src="<?php echo trailingslashit(get_template_directory_uri()); ?>assets/images/stripe-helpscout.png" />
		<?php echo blend_app_signup_form(); ?>
		<p>Signup to get early access to the app.</p>
	</div>
	<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/primary-image.png'; ?>" />
</section>
<?php get_footer(); ?>