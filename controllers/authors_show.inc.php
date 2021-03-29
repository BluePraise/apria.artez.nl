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



require_once __DIR__ . '/element_main.inc.php';



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

$smarty->assign([
	'posts' => $searchResults,
	'surtitle' => $smarty->getConfigVariable('results_author'),
	'term' => get_the_author_meta('display_name'),
]);

$template = "search_results";
