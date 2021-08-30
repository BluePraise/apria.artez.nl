<?php

/*
	APRIA
	Copyright (C) 2018 by Systemantics, Bureau for Informatics

	Systemantics GmbH
	Bleichstr. 11
	41747 Viersen
	GERMANY

	Web:    www.systemantics.net
	Email:  hello@systemantics.net

	Permission granted to use the files associated with this
	website only on your webserver.

	Changes to these files are PROHIBITED due to license restrictions.
*/



// This is the WordPress adaptor for the Systemantics boilerplate
// All access is handled by main.php (usually triggered from .htaccess)



get_header();

global $wp_query, $wpdb;
$tag = get_queried_object();

$getPosts = get_posts(array(
    'post_type' => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
			'terms' => $tag->term_id,
        )
    )
));

$pageTitle = ucfirst($tag->name) . ' - ' . $pageTitle;


	$posts = $posts;
	$surtitle = "Results tagged by";
	$term = ucfirst($tag->name);


?>

<main class="archive-view">
	<h1>Results tagged by <?php echo $term; ?></h1> 
	<div class=" msnry-view">
	<div class="grid-sizer"></div>
	<?php 
		if ($getPosts) : foreach ($getPosts as $post) :?>
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
	<?php endforeach; endif; ?>
	</div>
</main>

<?php get_footer(); ?>