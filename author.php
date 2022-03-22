<?php

get_header();

global $wp_query, $wpdb;

$authorID = get_queried_object_id();

?>


<main class="author-view page-view">
	<div class="content-container">
		<h1>Articles by: <?= get_the_author_meta(); ?></h1>
		<?php if (get_field("biography" , $authorID)): ?>
			<p><?php the_field("biography", $authorID, false); ?></p>
		<?php endif; ?>
	</div>
	<div class="msnry-view">
	<?php if (have_posts() ) : while (have_posts() ) : the_post(); ?>
	<article class="grid-item">
		<a href="<?php the_permalink(); ?>">
			<p class="article__date"><?=get_the_date('d-M-Y'); ?></p>
				<h2 class="subtitle"><?php the_title();?></h2>

				<?php if(has_post_thumbnail()): ?>
					<figure>
						<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
					</figure>
				<?php endif;?>
				<?php if(get_field('preview_text')): ?>
					<p class="article__excerpt"><?= get_field('preview_text'); ?></p>
				<?php else: ?>
					<p class="article__excerpt"><?php the_excerpt(); ?></p>
				<?php endif;?>
			</a>
	</article>
	<?php endwhile; endif; ?>
	</div>
</main>

<?php get_footer();
