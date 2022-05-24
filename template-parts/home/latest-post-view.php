<?php
	// The Query
	$latest_args = array(
		'post_type'         => array( 'post' ),
		'posts_per_page'    => -1,
		'orderby'			=> 'date',
		'order'				=> 'DESC'
	);
	$the_query = new WP_Query( $latest_args );
	$issue_bg = get_field('background_image');

	// The Loop
	if ( $the_query->have_posts() ) : ?>
		<ul class="home-grid latest-articles grid-view hide">
		<div class="grid-sizer"></div>
		<?php while ( $the_query->have_posts() ): $the_query->the_post();

			?>
			<li class="post-item">
				<?php if(has_post_thumbnail()): ?>
					<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
				<?php else: ?>
					<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
				<?php endif; ?>
				<div class="post-content-wrap">
				<h3><?php the_title(); ?></h3>
					<?php
						if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
					else: ?>
						<p><?php the_author(); ?></p>
					<?php endif; ?>
					<p class="post-type">
						<?php if($post->post_type == 'post'): echo 'Article'; else: echo $post->post_type; endif;?>
					</p>
				</div>
				</a>
			</li>
			<?php endwhile; ?>
		</ul>
	<?php else :
		// no posts found
		echo '<p>Sorry, there are no results for this.</p>';
	endif;
	/* Restore original Post Data */
	wp_reset_postdata();
?>
