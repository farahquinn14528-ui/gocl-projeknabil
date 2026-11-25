<?php
/**
 * Halaman biasa.
 *
 * @package gocl-pemula
 */

get_header();
?>
<div class="wrap page-wrap">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="entry">
			<?php the_content(); ?>
		</div>
		<?php
	endwhile;
	?>
</div>
<?php
get_footer();
