<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">

		<?php 
                    if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                        the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); 
                    endif;
                  ?>

		<h1 class="entry-title "><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php unite_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		
		$country = wp_get_post_terms( get_the_ID(), 'country', true );
				
		$coun = "";
		
		if (!empty($country)){
			foreach ($country as $count){
				
				$coun .= $count->name .', ';
			}
			
			$count = substr($coun,0, -2);
		}
		
		
		$genres = wp_get_post_terms( get_the_ID(), 'genre', true );
				
		$gen = "";
		
		if (!empty($genres)){
			foreach ($genres as $genre){
				
				$gen .= $genre->name .', ';
			}
			
			$gen = substr($gen,0, -2);
		}
		
		
		$ticket = get_post_meta( get_the_ID(), 'ticket_price', true);
		$release = get_post_meta( get_the_ID(), 'release_date', true);
		?>
		<p>&nbsp;</p>
		<div class="clear"></div>
		<div class="col-md-6">
		<strong>Country</strong> : <?= $count; ?>
		</div>
		
		<div class="col-md-6">
		<strong>Ticket Price</strong> : <?= $ticket; ?>
		</div>
		
		
		<div class="col-md-6">
		<strong>Genre</strong> : <?= $gen; ?>
		</div>
		
		<div class="col-md-6">
		<strong>Release Date</strong> : <?= date('F j, Y', strtotime($release));; ?>
		</div>
		
		
		<?php
		//	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),				'after'  => '</div>',			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta" style="display: none">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'unite' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'unite' ) );

			if ( ! unite_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'unite' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
		<?php unite_setPostViews(get_the_ID()); ?>
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
