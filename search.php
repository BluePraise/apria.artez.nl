<?php

/*
Template Name: Search Page
*/

get_header();


global $wp_query, $wpdb;

$args = array(
	'post_type' => 'post',
	's' => get_search_query(),
	'numberposts' => -1,
	'posts_per_page' => -1
);

$aposts = new WP_Query( $args );
$search = get_search_query();

$getPosts = get_posts(array(
    'post_type' => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
	'posts_per_page' => -1,
    's' => $search
));

?>

<main class="content-with-sidebar msnry-sidebar">
	<h1>Results search by <?php echo ucfirst($search); ?></h1> 
	<div class="msnry-view">
		<div class="grid-sizer" style="width: calc(50% - 16px);"></div>
		<?php 

		$searchResults = array();

		if ($aposts->have_posts()) : 

			foreach ($aposts->posts as $aPost) :

				$searchResults[] = extendIssuePost($aPost);

			endforeach;
		endif;

		//var_dump($searchResults);

		$searchResults = getFilter($searchResults);


		if ($getPosts) : 

			foreach ($getPosts as $post) :
				$aPost = extendIssuePost($post);
				//var_dump($aPost); Die();
		?> 
		<article class="search-result grid-item <?php if($aPost->tagIds) { foreach ($aPost->tagIds as $aId) : ?> filter-tag-<?php echo $aId;  endforeach; } ?> <?php if ($aPost->issue_id) { ?> filter-issue-<?php echo $aPost->issue_id; } if($aPost->authors) { foreach ($aPost->authors as $aId): ?> filter-author-<?=$aId->id;  endforeach; } ?>">
			<a href="<?php the_permalink(); ?>">
				<p class="article__date"><?=get_the_date('d-M-Y'); ?></p>
					<h2 class="subtitle"><?php the_title();?></h2>
					
					<?php if(has_post_thumbnail()): ?>
						<figure>
							<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
						</figure>
					<?php endif;?>
					<?php if(get_field('preview_text')): ?>
						<p class="article__excerpt"><?php the_field('preview_text', false); ?></p>
					<?php else: ?>
						<p class="article__excerpt"><?php the_excerpt(); ?></p>
					<?php endif;?>
				</a>	
		</article>
		<?php endforeach; ?>
		</div>
		<?php else : ?>
			No Result Found
		<?php endif; 

	$posts = $searchResults;
	if ($posts->filterableAuthors || $posts->filterableTags || $posts->filterableIssues) : ?>
	<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling">
			<div class="content-wrap">
				<div class="filter">
					<div class="filter__header">
						<span>Filter Results</span> (<?=$posts->total ?>) | <span class="filter-reset js-reset-filter">Clear all filters</span>
					</div>
				<?php if  ($posts->filterableIssues) : ?>
					<div class="filter__group">
						<div class="filter__group-title">By issue</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
					<?php foreach ($posts->filterableIssues as $key=>$aIssue) : ?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_issue_<?=$key?>" data-filter=".filter-issue-<?=$aIssue->id ?>"  value="<?=$aIssue->id ?>" data-type="issue">
								<label for="checkbox_issue_<?=$key?>"> <?=$aIssue->number; ?> <?=$aIssue->title; ?> (<?=$aIssue->count; ?>)</label>
							</div>
					<?php endforeach; ?>
						</div>
					</div>
				<?php endif; 

					if ($posts->filterableAuthors) : ?>

					<div class="filter__group">
						<div class="filter__group-title">By Author</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
						<?php foreach ($posts->filterableAuthors as $key=>$aAuthor) : ?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_author_<?=$key?>" data-filter=".filter-author-<?=$aAuthor->id; ?>"  value="<?=$aAuthor->id; ?>" data-type="author">
								<label for="checkbox_author_<?=$key?>"> <?=$aAuthor->display_name?>  (<?=$aAuthor->count; ?>)</label>
							</div>
						<?php endforeach; ?>

						</div>
					</div>
				<?php endif; 

					if ($posts->filterableTags) : ?>
					<div class="filter__group">
						<div class="filter__group-title">By Tag</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
						<?php foreach ($posts->filterableTags as $key=>$aTag) : ?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_tag_<?=$key?>" data-filter=".filter-tag-<?=$aTag->id; ?>" value="<?=$aTag->id; ?>" data-type="tag">
								<label for="checkbox_tag_<?=$key?>"><?=$aTag->name; ?> (<?=$aTag->count; ?>)</label>
							</div>
					<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
<!-- // {*
// 					<div class="filter__group">
// 						<div class="filter__group-title">{#filter_by_date#}</div>
// 						<div class="filter-clear-button icon">×</div>
// 						<div class="filter-date">from <span>12</span>/<span>2017</span> to <span>03</span>/<span>2018</span></div>
// 					</div>
// *} -->
				</div>

				<!-- // {include "element_footer.tpl" class="hide-on-desktop"} -->
			</div>
		</div>
	</aside>
<?php endif; ?>
</main>
<?php get_footer(); ?>

