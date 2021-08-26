<?php

get_header();

global $wp_query, $wpdb;

$authorID = get_queried_object_id();
$author_info = get_user_by( 'id',$authorID);
$getPosts = get_posts(array(
    'post_type' => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
	'author' => $authorID
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

	$posts = $searchResults;
	$surtitle = "Results by author";
	$term = get_the_author_meta('display_name');

?>

<main class="archive-view">
	<h1>Articles by: <?=$author_info->display_name; ?></h1> 
	<?=get_field("biography", 'user_'.$authorID); ?>
	<div class="grid-view msnry-view">
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
	</div>
</main>

<?php get_footer(); 