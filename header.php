<!DOCTYPE html>

<!--[if IE 9 ]><html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<title><?php wp_title( ' | ' ); ?></title>
    <?php wp_head(); ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" />

</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
<div class="overflow-container">

<!--skip to content link-->
<a class="skip-content" href="#main"><?php _e('Skip to content', 'blend-app'); ?></a>

<header class="site-header" id="site-header" role="banner">

	<div id="title-container" class="title-container">
		<?php get_template_part('logo')  ?>
	</div>

<!--	<button id="toggle-navigation" class="toggle-navigation">-->
<!--		<i class="fa fa-bars"></i>-->
<!--	</button>-->

<!--	--><?php //get_template_part( 'menu', 'primary' ); ?>

</header>
<section id="main" class="main" role="main">