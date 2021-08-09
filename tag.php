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

$posts = array();
foreach($getPosts as $aPost){
	$posts[] = extendIssuePost($aPost);
}

$searchResults = getFilter($posts);

$pageTitle = ucfirst($tag->name) . ' - ' . $pageTitle;


	$posts = $searchResults;
	$surtitle = "Results tagged by";
	$term = ucfirst($tag->name);


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
				echo $term; ?></h1>
			</div>

			<div class="search-results">
<div class="grid-sizer"></div>
<?php 

if ($searchResults->results) : 

	foreach ($searchResults->results as $aPost) :
?> 

<div class="search-result"> 
<div class="result__date"><?php echo formatDate($aPost->date); ?></div>
	<a
   href="<?=$aPost->url; ?> " class="result__title"><?=$aPost->title?> <?php if
   ($aPost->subtitle) { ?> <em> <?=$aPost->subtitle ?></em> <?php } ?></a>
   <div class="result__text"> <?=$aPost->previewtext; ?> </div> <div
   class="result__info"> 
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

</div>