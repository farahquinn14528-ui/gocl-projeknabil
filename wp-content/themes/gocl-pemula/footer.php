<?php
/**
 * Footer tema.
 *
 * @package gocl-pemula
 */
?>
</main>

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-cols">
			<div class="footer-col">
				<h3>Tentang GOCL</h3>
				<p>GOCL adalah singkatan dari PT Graha Optima Cipta Lestari. Perusahaan ini bergerak di bidang konsultasi, konstruksi, dan pemilihan material finishing.</p>
			</div>
			<div class="footer-col">
				<h3>Halaman</h3>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Us</a></li>
					<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>">Products</a></li>
					<li><a href="<?php echo esc_url( home_url( '/clients/' ) ); ?>">Clients</a></li>
					<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>">Portfolio</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
				</ul>
			</div>
			<div class="footer-col">
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
			<div class="footer-col">
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
