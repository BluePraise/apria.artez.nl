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



$getAllIssues = get_posts(array(
	'post_type' => 'issue',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'number',
    'order' => 'DESC',
));

$allIssues = array();
foreach($getAllIssues as $aIssue){
	$allIssues[] = extendIssue($aIssue);
}

$related_posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'meta_key' => 'issue',
    'meta_value' => false,
));

$currentIssuePosts = array();
foreach($related_posts as $aPost){
	$currentIssuePosts[] = extendIssuePost($aPost);
}

$newsPosts = [];
foreach (get_posts(array(
    'post_type' => 'news',
    'post_status' => 'publish',
    'numberposts' => 3,
)) as $aPost) {
	$newsPosts[] = (object)[
		'title' => get_the_title($aPost->ID),
		'subtitle' => get_field('subtitle', $aPost),
		'previewtext' => trim(get_field('preview_text', $aPost)) . ' •••',
		'url' => get_permalink($aPost),
	];
}

$smarty->assign([
	'allIssues' => $allIssues,
	'currentIssuePosts' => $currentIssuePosts,
	'htmlClass' => 'show-picture-text-toogle',
	'intro' => get_field('intro_text'),
	'newsPosts' => $newsPosts,
]);
