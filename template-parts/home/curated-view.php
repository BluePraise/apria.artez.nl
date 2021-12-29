
<?php
	$curated_posts = get_field('curated_posts', 'option');
	if( have_rows('curated_posts', 'option') ):?>

	<ul class="curated-posts curated-by home-grid grid-view hide">
	<div class="grid-sizer"></div>
	<?php
	// Loop through rows.
	while( have_rows('curated_posts', 'option') ) : the_row();
	$post_object = get_sub_field('curated_item');
	if( $post_object ):
		foreach($post_object as $post): ?>
			<li class="post-item issue">
				<?php $issue_bg = get_field('background_image', $post->ID);?>
				<?php if(get_field('background_image', $post->ID)) : ?>
					<a href="<?php the_permalink($post->ID); ?>" style="background-image: url(<?php echo $issue_bg; ?>);">
				<?php elseif(has_post_thumbnail($post->ID)): ?>
					<a href="<?php the_permalink($post->ID); ?>" style="background-image: url(<?php the_post_thumbnail_url($post->ID); ?>);">
				<?php else: ?>
					<a href="<?php the_permalink($post->ID); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
				<?php endif; ?>
				<div class="post-content-wrap">
					<h3><?php the_title(); ?></h3>
					<?php
					if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
					else: ?>
						<p><?php the_author($post->ID); ?></p>
					<?php endif; ?>
						<p class="post-type">
						<?php if($post->post_type == 'post'): echo 'Article'; else: echo $post->post_type; endif;?>
						</p>
				</div>
				</a>
			</li>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endforeach; endif; endwhile;?>
		</ul>
 <?php endif; ?>
