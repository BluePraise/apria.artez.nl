
<?php // The Query
$issue_args = array(
	'post_type'              => array( 'issue' ),
	'posts_per_page'         => -1
);
$the_query = new WP_Query( $issue_args );

$issue_bg = get_field('background_image');

if ( $the_query->have_posts() ) : ?>

<ul class="apria-journal apria-journal-view issue-view home-grid grid-view hide">
<div class="grid-sizer"></div>
	<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
	<li class="post-item issue">
		<?php if($issue_bg): ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $issue_bg; ?>);">
		<?php elseif(has_post_thumbnail()): ?>
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
