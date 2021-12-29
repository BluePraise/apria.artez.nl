<?php // The Query
	$opencall_args = array(
		'post_type'         => array( 'news' ),
		'category_name' 	=> 'open-call-editorial',
		'post_status' 		=> 'publish',
		'posts_per_page'    => -1
	);

	$the_query = new WP_Query( $opencall_args );
	// The Loop
if( $the_query->have_posts() ): ?>

<ul class="open-call-view home-grid grid-view open-call hide">
<div class="grid-sizer"></div>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<li class="post-item open-call-view">
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
					<?php echo $post->post_type; ?>
				</p>
		</div>
		</a>
	</li>

<?php endwhile; ?>
</ul>
<?php endif; wp_reset_postdata();?>
