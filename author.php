<?php

get_header();

global $wp_query, $wpdb;

$authorID = get_the_author_meta('ID');

$getPosts = get_posts(array(
    'post_type' => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
));

$posts = array();
foreach($getPosts as $aPost){

	$thisPost = extendIssuePost($aPost);
	$append = false;

	foreach($thisPost->authors as $aAuthor){
		if($aAuthor->id == $authorID){
			$append = true;
		}
	}

	if($append){
		$posts[] = $thisPost;
	}
}

$searchResults = getFilter($posts);

$pageTitle = get_the_author_meta('display_name') . ' - ' . $pageTitle;


	$posts = $searchResults;
	$surtitle = "Results by author";
	$term = get_the_author_meta('display_name');

?>

<main class="page-view msnry-view grid-view">
	<div class="grid-sizer"></div>
	<?php 
		if ($getPosts) : 

			foreach ($getPosts as $post) :
		?>
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
</main>

<?php get_footer(); ?>

