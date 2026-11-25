<?php
/**
 * Halaman depan.
 *
 * @package gocl-pemula
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="entry entry-home">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;

get_footer();
