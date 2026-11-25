<?php
/**
 * Fallback daftar post.
 *
 * @package gocl-pemula
 */

get_header();
?>
<div class="wrap page-wrap">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
			<?php
		endwhile;
		?>
	<?php else : ?>
		<h1 class="page-title">Tidak ada isi</h1>
		<p>Halaman yang dicari tidak ditemukan.</p>
	<?php endif; ?>
</div>
<?php
get_footer();
