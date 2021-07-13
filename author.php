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

<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">

			<div class="article__head">
				<div class="head__top-line">
					<span class="article__surtitle"> <?=$surtitle; ?>: </span>
				</div>
				<h1 class="article__title"><?php 
				// var_dump($_GET); 
				echo ucfirst($term); ?></h1>
			</div>

			<div class="search-results">

<?php 

if ($searchResults->results) : 

	foreach ($searchResults->results as $aPost) :
?> 

<div class="search-result <?php if($aPost->tag_ids) { foreach ($aPost->tag_ids as $aId) : ?> filter-tag-<?php echo $aId;  endforeach; } if ($aPost->issue_id) { ?> filter-issue-<?php echo $aPost->issue_id; } 
   if($aPost->author_ids) { foreach ($aPost->author_ids as $aId): ?> filter-author-<?=$aId;  endforeach; } ?>"> <a
   href="<?=$aPost->url; ?> " class="result__title"><?=$aPost->title?> <?php if
   ($aPost->subtitle) { ?> <em> <?=$aPost->subtitle ?></em> <?php } ?></a>
   <div class="result__text"> <?=$aPost->previewtext; ?> </div> <div
   class="result__info"> <div class="result__date"><?php echo
   formatDate($aPost->date); ?></div> <ul class="result__meta"> <?php if
   ($aPost->authors) : ?> <li> <?php foreach ($aPost->authors as
   $aAuthor) : ?> <a
   href="<?=$aAuthor->post_url ?>"><?=$aAuthor->name; ?></a> <?php
   endforeach; ?> </li> <?php endif; 

	if ($aPost->tags) :
?>


							<li>
<?php foreach ($aPost->tags as $aTag) : ?>

								<a href="<?=$aTag->url ?>"><?=$aTag->name; ?></a>
<?php endforeach; ?>
							</li>
<?php endif; 
if ($aPost->issue_number) :
?>

							<li>Published in <a href="<?=$aPost->issue_url ?>">ISSUE <?=$aPost->issue_number ?></a></li>
<?php endif; ?>
						</ul>
					</div>
				</div>
<?php endforeach; 

else : ?>
				No Result Found
<?php endif; ?>

			</div>
				<?php get_footer(); ?>
		</div>
	</article>
<?php 

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
								<input class="js-filter" type="checkbox" id="checkbox_issue_<?=$key?>"  value="<?=$aIssue->id ?>" data-type="issue">
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
								<input class="js-filter" type="checkbox" id="checkbox_author_<?=$key?>"  value="<?=$aAuthor->id; ?>" data-type="author">
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
								<input class="js-filter" type="checkbox" id="checkbox_tag_<?=$key?>" value="<?=$aTag->id; ?>" data-type="tag">
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
				<?php get_footer(); ?>
			</div>
		</div>
	</aside>
<?php endif; ?>
</div>

