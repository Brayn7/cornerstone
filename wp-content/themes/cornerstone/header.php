<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cornerstone
 */

$logo = get_theme_mod('menu_logo');

?>
<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head();?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body <?php body_class();?>>
<div id="page" class="site grid-container full">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'cornerstone');?></a>
		<header id="masthead" class="site-header title-bar">

			<div class="site-branding title-bar-left">

				<div class="title-bar-title">
					<?php the_custom_logo();?>
				</div>
				<?php

if (is_front_page() && is_home()): ?>
					<h1 class="site-title "><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a></h1>
				<?php else: ?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a></p>
				<?php
endif;

$description = get_bloginfo('description', 'display');
if ($description || is_customize_preview()): ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
endif;?>
				<div class="menu-btn title-bar-right d-inline-block">
					<a data-toggle="offCanvas" aria-controls="primary-menu" aria-expanded="true">
						menu
					</a>
				</div>
			</div><!-- .site-branding -->
			<div class="off-canvas position-left" id="offCanvas" data-off-canvas>
				<div class="logo">
					<a href="/">
						<img src="<?=$logo;?>" alt="">
					</a>
				</div>
				<nav id="site-navigation" class="main-navigation">
					<?php

wp_nav_menu(array(
	'theme_location' => 'menu-1',
	'menu_id' => 'primary-menu',
));

?>
				</nav><!-- #site-navigation -->
			</div> <!-- #off-canvas menu -->


		</header><!-- #masthead -->

	<div id="content" class="site-content off-canvas-content grid-container full" data-off-canvas-content>
