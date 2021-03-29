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

$smarty->assign([
	'posts' => $searchResults,
	'surtitle' => $smarty->getConfigVariable('results_tag'),
	'term' => $tag->name,
]);

$template = "search_results";
