<?php
/**
 * Template Name: Film Page
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

//get_header(); ?>

<?php

$my_query = new WP_Query(array(
    'post_type' => 'films',
    'posts_per_page' => 9,
    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
));
			var_dump ($my_query);

?>


	<div id="primary" class="content-area col-sm-12 col-md-121">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_footer(); ?>
