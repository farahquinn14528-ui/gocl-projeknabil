<?php
/**
 * Header tema.
 *
 * @package gocl-pemula
 */
$gocl_assets = get_stylesheet_directory_uri() . '/assets';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo esc_url( $gocl_assets . '/favicon.webp' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
	<div class="wrap">
		<a href="https://smmp.gocl.co.id/" target="_blank" rel="noopener">Project Portal</a>
	</div>
</div>

<header class="site-header">
	<div class="wrap">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( $gocl_assets . '/logo.webp' ); ?>" alt="GOCL BY nabil">
			<span class="logo-suffix">BY nabil</span>
		</a>
	</div>
</header>

<nav class="site-nav">
	<div class="wrap">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'utama',
				'container'      => false,
				'menu_class'     => 'menu',
			)
		);
		?>
	</div>
</nav>

<main class="site-main">
