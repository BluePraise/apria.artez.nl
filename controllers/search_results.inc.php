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



$searchResults = array();
while (have_posts()) {
	the_post();

	//Don't search in pages, can't filtered
	if($post->post_type != 'post'){
		continue;
	}

	$searchResults[] = extendIssuePost($post);
}

$searchResults = getFilter($searchResults);

$pageTitle = get_search_query() . ' - ' . $smarty->getConfigVariable('search') . ' - ' . $pageTitle;

$smarty->assign([
	'posts' => $searchResults,
	'surtitle' => $smarty->getConfigVariable('search_results_for'),
	'term' => get_search_query(),
]);
