<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package campfire
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'campfire' ); ?></a>

	<header id="masthead" class="site-header <?php if ( has_post_thumbnail() ) { ?>hero <?php }	?>">
		<div class="site-branding">
			<?php
			if ( is_front_page() ) :
				the_custom_logo();
			elseif (get_theme_mod( 'secondary_logo' )) :
			?>
				<a href="http://localhost/" class="custom-logo-link" rel="home" itemprop="url">
					<img src="<?php echo get_theme_mod( 'secondary_logo' ); ?>" class="custom-logo" />
				</a>
			<?php
			else : 
				the_custom_logo();
			endif;
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$campfire_description = get_bloginfo( 'description', 'display' );
			if ( $campfire_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $campfire_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
		<?php if ( has_post_thumbnail() ) { ?>
			<?php campfire_post_thumbnail(); ?>
			<div id="tri-01" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-02" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-03" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-04" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-05" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-06" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>
			<div id="tri-07" class="triangle">
				<svg width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" >
					<polygon id="triangle" points="100,0 0,200 200,200" style="fill:#000;"/>
				</svg>
			</div>	
		<?php }	?>
		<div class="title">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<p><?php echo get_post_meta($post->ID, "meta-description", true) ?></p>
		</div>
</header><!-- #masthead -->
