<?php

get_header();

global $wp_query, $wpdb;

$authorID = get_queried_object_id();
$author_info = get_user_by( 'id',$authorID);
$term = get_the_author_meta('display_name');
$args = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'author',
            'field' => 'display_name',
            'terms' => $term
        )
    ),
);

$author_query = new WP_Query( $args ); ?>


<main class="archive-view">
	<div class="content-container">
	<h1>Articles by: <?= $term ?></h1> 
	<?php if (get_field("biography" , $authorID)): ?>
		<p><?php the_field("biography", $authorID, false); ?></p>
	<?php endif; ?>
	</div>
	<div class="msnry-view">
	<div class="grid-sizer" style="width: 390px;"></div>
	<?php if ( $author_query->have_posts() ) : while ( $author_query->have_posts() ) : $author_query->the_post(); ?>
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