<?php
/*
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<section id="intro" class="intro">
	<h1>Stripe Integration for Help Scout</h1>
<!--	<h1>Provide More Personal Support, Faster</h1>-->
	<p>Blendapp.io integrates your Stripe customer data with Help Scout, so you can provide more personal support, faster.</p>
	<div class="signup-form">
		<img class="stripe-helpscout" src="<?php echo trailingslashit(get_template_directory_uri()); ?>assets/images/stripe-helpscout.png" />
		<?php echo blend_app_signup_form(); ?>
		<p>Signup to get early access to the app.</p>
	</div>
	<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/primary-image.png'; ?>" />
	<p class="primary-image-caption">The Blendapp.io Help Scout app displays each customer's profile, subscriptions, and payments in your side panel.</p>
</section>
<?php get_footer(); ?>