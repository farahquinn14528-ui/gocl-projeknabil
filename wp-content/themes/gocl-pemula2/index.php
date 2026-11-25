<?php
/**
 * Satu-satunya template tema: header, nav, isi, footer.
 *
 * @package gocl-pemula
 */

$nav    = array(
	''           => 'Home',
	'about-us'   => 'About Us',
	'products'   => 'Products',
	'clients'    => 'Clients',
	'portfolio'  => 'Portfolio',
	'contact'    => 'Contact',
);
$assets = get_stylesheet_directory_uri() . '/assets';
$slug   = is_front_page() ? '' : ( is_404() ? null : get_post_field( 'post_name' ) );

$link = function ( $s ) {
	return esc_url( home_url( '/' . ( $s ? "$s/" : '' ) ) );
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo esc_url( $assets . '/favicon.webp' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar"><div class="wrap"><a href="https://smmp.gocl.co.id/" target="_blank" rel="noopener">Project Portal</a></div></div>

<header class="site-header">
	<div class="wrap">
		<a href="<?php echo $link( '' ); ?>"><img src="<?php echo esc_url( $assets . '/logo.webp' ); ?>" alt="GOCL"></a>
	</div>
</header>

<nav class="site-nav">
	<div class="wrap">
		<?php foreach ( $nav as $s => $label ) : ?>
			<a class="<?php echo $s === $slug ? 'on' : ''; ?>" href="<?php echo $link( $s ); ?>"><?php echo esc_html( $label ); ?></a>
		<?php endforeach; ?>
	</div>
</nav>

<main class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			if ( is_front_page() ) {
				echo '<div class="entry entry-home">';
				the_content();
				echo '</div>';
			} else {
				echo '<div class="wrap page-wrap"><h1 class="page-title">' . esc_html( get_the_title() ) . '</h1></div>';
				echo '<div class="entry">';
				the_content();
				echo '</div>';
			}
		endwhile;
	else :
		?>
		<div class="wrap page-wrap">
			<h1 class="page-title">Halaman tidak ditemukan</h1>
			<p>Halaman yang dicari tidak ada. Kembali ke <a href="<?php echo $link( '' ); ?>">Home</a>.</p>
		</div>
		<?php
	endif;
	?>
</main>

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-cols">
			<div>
				<h3>Tentang GOCL</h3>
				<p>GOCL adalah singkatan dari PT Graha Optima Cipta Lestari. Perusahaan ini bergerak di bidang konsultasi, konstruksi, dan pemilihan material finishing.</p>
			</div>
			<div>
				<h3>Halaman</h3>
				<ul>
					<?php foreach ( $nav as $s => $label ) : ?>
						<li><a href="<?php echo $link( $s ); ?>"><?php echo esc_html( $label ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
				<h3>Produk</h3>
				<ul>
					<li>Polyflor</li>
					<li>Tarkett</li>
					<li>LX Hausys</li>
					<li>Suminoe</li>
					<li>Tandus</li>
					<li>VOX</li>
				</ul>
			</div>
			<div>
				<h3>Hubungi Kami</h3>
				<p>Menara 165, Lantai 14, Unit E<br>Jl. Tb Simatupang Kav. 1<br>
				<a href="https://wa.me/6281234898998">+62 812-3489-8998</a><br>
				<a href="mailto:contact@gocl.co.id">contact@gocl.co.id</a></p>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="wrap">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> PT Graha Optima Cipta Lestari. Dibuat dengan WordPress.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
