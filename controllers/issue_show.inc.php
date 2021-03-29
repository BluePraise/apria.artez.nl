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



$issue = get_post($id);
if($issue){
	$issue = (object)[
		'ID' => $issue->ID,
		'title' => get_the_title(),
		'subtitle' => get_field('subtitle', $issue->ID),
		'date' => $issue->post_date,
		'content' => apply_filters('the_content', $issue->post_content),
		'authors' => getAuthors($issue->ID),
		'number' => get_field('number'),
		'text_color' => get_field('text_color'),
		'background_color' => get_field('background_color'),
		'background_image' => get_field('background_image'),
		'bibliography' => get_field('bibliography'),
		'issue_authors' => get_field('issue_authors'),
	];
}

$related_posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'meta_key' => 'issue',
    'meta_value' => $issue->ID,
));

$sidebar_posts = array();
foreach($related_posts as $aPost){
	$sidebar_posts[] = extendIssuePost($aPost);
}

$allIssueAutors = array();
foreach ($sidebar_posts as $aPost) {

	foreach($aPost->authors as $aAuthor){
		if(!in_array($aAuthor->name, $allIssueAutors)){
			$allIssueAutors[$aAuthor->name] = $aAuthor;
		}
	}
}

footnotify($issue);

$pageTitle = $issue->title . ' - ' . $pageTitle;

$smarty->assign([
	'issue' => $issue,
	'color' => $issue->text_color ? $issue->text_color : '#000',
	'backgroundcolor' => $issue->background_color ? $issue->background_color : '#fff',
	'background_image' => $issue->background_image ? $issue->background_image['url'] : false,
	'sidebar_posts' => $sidebar_posts,
	'allIssueAutors' => $allIssueAutors,
	'htmlClass' => 'logo-fixed',
]);
