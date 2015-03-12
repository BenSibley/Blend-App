<?php
/*
 * Template Name: Homepage Paid
 */
?>

<?php get_header(); ?>

	<section id="top" class="top">
		<div class="heading">
			<h1>Stripe Integration for Help Scout</h1>
			<p>Blendapp.io integrates your Stripe customer data with Help Scout, so you can provide more personal support, faster.</p>
		</div>
		<a class="button sign-up" href="#">Sign up</a>
		<a class="button learn-more" href="#">Learn More</a>
		<img class="primary-image" src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/primary-image.png'; ?>" />
	</section>
	<section id="benefit-1" class="benefit-1">
		<div class="heading">
			<h2>Close Support Tickets Faster</h2>
			<p>Blendapp.io integrates your Stripe customer data with Help Scout, so you can provide more personal support, faster.</p>
		</div>
		<div class="message">
			<div class="user">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/sarah.png'; ?>" />
				<p><span>Sarah</span> started the conversation</p>
			</div>
			<div class="question">
				<p>Never got download</p>
				<p>Hey, I just purchased, but I never received my download...?</p>
			</div>
		</div>
		<div class="steps without-blendapp">
			<h3>Without Blendapp.io</h3>
			<img src="<?php echo get_template_directory_uri() . '/assets/images/cancel.png'; ?>" />
			<ol>
				<li>Copy customer's email</li>
				<li>Go to stripe.com</li>
				<li>Login</li>
				<li>Search for customer's email</li>
				<li>Click on payment info</li>
				<li>Verify payment was received</li>
				<li>Resend download</li>
			</ol>
		</div>
		<div class="steps with-blendapp">
			<h3>With Blendapp.io</h3>
			<img src="<?php echo get_template_directory_uri() . '/assets/images/checkmark.png'; ?>" />
			<ol>
				<li>Verify payment was received</li>
				<li>Resend download</li>
			</ol>
		</div>
	</section>
	<section id="benefit-2" class="benefit-2">
		<div class="heading">
			<h2>Provide More Personal Support</h2>
			<p>Customer data enables support agents to WOW customers</p>
		</div>
		<div class="features">
			<ul>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/calendar-icon.png'; ?>" />
					<h3>Trial-end dates</h3>
					<p>Offer extended trials to users who haven't upgraded and are near the end of their trial.</p>
					<span>+ Conversions</span>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/line-graph-icon.png'; ?>" />
					<h3>Recent Purchases</h3>
					<p>Recommend annual subscriptions and savings based on customers' recent purchases.</p>
					<span>+ Cash flow</span>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/clock-icon.png'; ?>" />
					<h3>Soon-to-expire Credit Cards</h3>
					<p>Notify a customer if their credit card will expire soon, so they don't miss a payment.</p>
					<span>+ Revenue</span>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/heart-icon.png'; ?>" />
					<h3>"Customer since" dates</h3>
					<p>Recognize long-time customers, and show them your appreciation.</p>
					<span>+ Loyalty</span>
				</li>
			</ul>
		</div>
	</section>
	<section id="how-it-works" class="how-it-works">
		<div class="heading">
			<h2>Get Started in 3 Minutes</h2>
			<p>You're about 3 minutes away from Stripe data in your Help Scout dashboard</p>
		</div>
		<div class="document">
			<div class="dog-ear"></div>
			<h3>How it Works</h3>
			<ol>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/1-circle.png'; ?>" />
					<h4>Create an Account</h4>
					<p>All we need is an email and password.</p>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/2-circle.png'; ?>" />
					<h4>Connect with Stripe</h4>
					<p>We've got a shiny blue button waiting for you.</p>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/3-circle.png'; ?>" />
					<h4>Add to Help Scout</h4>
					<p>We'll give you a special URL to paste into your Help Scout dashboard.</p>
				</li>
				<li>
					<img class="icon" src="<?php echo get_template_directory_uri() . '/assets/images/checkmark-circle.png'; ?>" />
					<p>All new and previous customer emails now display your Stripe customer data.</p>
				</li>
			</ol>
		</div>
	</section>
	<section id="pricing" class="pricing">
		<div class="heading">
			<h2>Improve Your Support Today</h2>
			<p>Sign up now and get our 60-day money back guarantee</p>
		</div>
		<div class="purchase-form">
			<h3>$9/month</h3>
			<p>Save time while you WOW your customers</p>
			<a href="#">Sign up Now</a>
			<p>Try it out, risk-free for 60 days.</p>
		</div>
		<p>Improve the speed and quality of your support for less than $0.30/day</p>
	</section>
	<section id="faq" class="faq">
		<div class="heading">
			<h2>FAQ</h2>
		</div>
		<ul>
			<li>
				<h3>Q. Is this secure? I take my customer's data very seriously.</h3>
				<p>We do too. That's why we use a secure, read-only connection to access your Stripe account.</p>
			</li>
			<li>
				<h3>Q. Can I use my subscription for more than one Stripe or Help Scout account?</h3>
				<p>Your subscription allows you to connect one Stripe account to as many Help Scout accounts as you'd like.</p>
			</li>
			<li>
				<h3>Q. Does it matter how many Help Scout users I have?</h3>
				<p>Nope, the more the merrier!</p>
			</li>
			<li>
				<h3>Q. I have TONS of customers. Will this be an issue?</h3>
				<p>No, connecting your Stripe account only takes seconds, and everything after that will be instant.</p>
			</li>
			<li>
				<h3>Q. What's your refund policy?</h3>
				<p>If you're not satisfied, for any reason at all, within 60 days of your initial purchase, we will fully refund your payment. No questions asked.</p>
			</li>
		</ul>
		<p><a href="">Okay, got it! I'm ready to buy</a></p>
		<p>If you have any other questions, or want deeper insight on any topic, please contact us at team@blendapp.io</p>
	</section>
<?php get_footer(); ?>