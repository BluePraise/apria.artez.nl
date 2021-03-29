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



$content = get_post($id);
if($content){
	$page = (object)[
		'title' => get_the_title(),
		'subtitle' => get_field('subtitle', $id),
		'content' => apply_filters('the_content', $content->post_content),
		'sidebartext' => get_field('sidebar_text', $id),
	];
}

$newsPosts = [];
foreach (get_posts(array(
    'post_type' => 'news',
    'post_status' => 'publish',
    'numberposts' => -1,
    'exclude' => [ $id ],
)) as $aPost) {
	$newsPosts[] = (object)[
		'title' => get_the_title($aPost->ID),
		'subtitle' => get_field('subtitle', $aPost),
		'previewtext' => trim(get_field('preview_text', $aPost)) . ' •••',
		'url' => get_permalink($aPost),
	];
}

$pageTitle = $page->title . ' - ' . $pageTitle;

$smarty->assign([
	'page' => $page,
	'newsPosts' => $newsPosts,
]);

$template = 'pages_show';
