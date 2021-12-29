<?php

	// // WP_Query arguments
	$defaultquery_args = array(
		'post_type'         => array( 'issue', 'news', 'post' ),
		'post_status' 		=> 'publish',
		'posts_per_page'    => -1
	);
	$the_query = new WP_Query( $defaultquery_args );
	if( $the_query->have_posts() ):
?>

<ul class="default-view home-grid grid-view">
<div class="grid-sizer" id="grid-sizer"></div>

<?php
	while ( $the_query->have_posts() ) : $the_query->the_post();

	$cats = get_categories();
	$issue_bg = get_field('background_image');
	if($post->post_type == 'issue'):
?>
	<li class="post-item issue">
		<a href="<?php the_permalink(); ?>" style="background-image: url(<?= $issue_bg; ?>);">

	<?php elseif($post->post_type == 'post'): ?>
	<li class="post-item article">

		<?php if(get_field("background")) : ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_field("background"); ?>);">
		<?php elseif(has_post_thumbnail()): ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
		<?php endif; ?>

	<?php elseif($post->post_type == 'news'): ?>
	<li class="post-item news">
		<?php if(get_field("background")) : ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_field("background"); ?>);">
		<?php elseif(has_post_thumbnail()): ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
		<?php endif; ?>

	<?php endif; ?>
		<div class="post-content-wrap">
			<h3><?php the_title(); ?></h3>
				<?php
				if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
				else: ?>

				<p><?php the_author(); ?></p>

				<?php endif; ?>
				<p class="post-type">
					<?php if($post->post_type == 'post'): echo 'Article'; elseif($post->post_type == 'news'): echo 'Open Call'; else: echo $post->post_type; endif;?>
				</p>
			</div>
			</a>
		</li>

	<?php endwhile; ?>
	</ul>
	<?php endif;
		wp_reset_postdata();
	?>
