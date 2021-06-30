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



require_once __DIR__ . '/systemantics.inc.php';



function e($s) {
	return htmlspecialchars($s);
}

function ll($key) {
	return $GLOBALS['smarty']->getConfigVariable($key);
}

function removenbsp($s) {
	return str_replace(array('&nbsp;'), ' ', $s);
}

function myStrftime($format, $timestamp) {
	return strftime(
		str_replace('%b', ll('month_short_'.date('m', $timestamp)), str_replace('%A', ll('weekday_'.date('w', $timestamp)), str_replace('%B', ll('month_'.date('m', $timestamp)), $format))),
		$timestamp
	);
}

function formatDateShort($date) {
	//Jan 2019
	if (is_object($date)) {
		$date = strtotime($date->date);
	}else{
		$date = strtotime($date);
	}

	$formatCode = ll('date_format_short');

	return myStrftime($formatCode, $date);
}

function formatDateLarge($date) {
	//January 2019
	if (is_object($date)) {
		$date = strtotime($date->date);
	}else{
		$date = strtotime($date);
	}

	$formatCode = ll('date_format_large');

	return myStrftime($formatCode, $date);
}

function formatDate($date){
	return date('m-d-Y', strtotime($date));
}

function rgba($hex, $opacity) {
	return 'rgba(' . hexdec(substr($hex, 1, 2)) . ',' . hexdec(substr($hex, 3, 2)) . ',' . hexdec(substr($hex, 5)) . ',' . $opacity . ')';
}

function formatIssueNumber($number){
	return '#'.str_pad($number, 2, '0', STR_PAD_LEFT);
}

function footnotify($item) {
	global $smarty, $documentroot;

	$text = removenbsp($item->content);

	$smarty->assign('documentroot', $documentroot);

	$footnotes = array();

	$replace = function ($match) use (&$footnotes, $smarty) {
		$index = count($footnotes) + 1;
		$footnotes[$index] = $match[2];

		return '<span class="footnote-anchor js-footnote" data-footnoteanchor="'. $index .'">' . $match[1] . '</span>';
	};

	$item->content = preg_replace_callback('/\[footnote (.*?)\](.*?)\[\/footnote\]/', $replace, $text);
	$item->footnotes = $footnotes;

	return $item;
}

if(!function_exists("getAuthors")) {
function getAuthors($post_id){
	return array_map(function ($aAuthor) {
		if (isset($aAuthor->data)) {
			// Regular author
			return (object)[
				'id' => $aAuthor->ID,
				'name' => $aAuthor->data->display_name,
				'biography' => get_field('biography', $aAuthor),
				'post_url' => get_author_posts_url($aAuthor->ID),
			];
		}
		// Co-author
		return (object)[
			'id' => $aAuthor->ID,
			'name' => $aAuthor->display_name,
			'biography' => get_field('biography', $aAuthor->ID),
			'post_url' => get_site_url().'/author/'.$aAuthor->user_nicename.'/',
		];
	}, get_coauthors($post_id));
}
}

if(!function_exists("extendIssuePost")) {
function extendIssuePost($item){

	$previewtext = get_field('preview_text', $item->ID);
	if(!$previewtext){
		$previewtext = wp_trim_words( apply_filters('the_content', $item->post_content), 50 );
	}

	$postIssue = get_field('issue', $item->ID);
	if($postIssue){
		$postIssueNumber = get_field('number', $postIssue->ID);
		$postIssueUrl = get_permalink($postIssue->ID);
	}

	$postTags = get_the_tags($item->ID);
	$tags = array();
	if($postTags){
		foreach ($postTags as $aTag) {
			$tags[] = (object)[
				'id' => $aTag->term_id,
				'name' => $aTag->name,
				'url' => get_tag_link($aTag),
			];
		}
	}

	return (object)[
		'title' => get_the_title($item->ID),
		'subtitle' => get_field('subtitle', $item->ID),
		'url' => get_permalink($item->ID),
		'date' => $item->post_date,
		'previewtext' => $previewtext,
		'authors' => getAuthors($item->ID),
		'issue_id' => $postIssue->ID,
		'issue_number' => $postIssueNumber,
		'issue_url' => $postIssueUrl,
		'tags' => $tags,
		'tagIds' => array_map(function ($aTag) { return $aTag->id; }, $tags),
		'categoryIds' => array_map(function ($aCategory) { return $aCategory->term_id; }, get_the_category($item->ID)),
		'featureImage' => wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'preview-size'),
	];
}
}

function extendIssue($issue){

	$previewtext = get_field('preview_text', $issue->ID);
	if($previewtext){
		$previewtext = "<p>$previewtext</p>";
	} else {
		$previewtext = wp_trim_words( apply_filters('the_content', $issue->post_content), 50 );
	}

	$background_image = get_field('background_image', $issue->ID);

	return (object)[
		'title' => get_the_title($issue),
		'subtitle' => get_field('subtitle', $issue),
		'url' => get_permalink($issue),
		'number' => get_field('number', $issue),
		'date' => $issue->post_date,
		'background_image' => $background_image ? $background_image['url'] : false,
		'background_color' => get_field('background_color', $issue),
		'text_color' => get_field('text_color', $issue),
		'preview_text' => $previewtext,
		'authors' => getAuthors($issue->ID),
		'download_pdf' => get_field('download_pdf', $issue),
	];
}

function getCoAuthorDisplayName($author){
	if($author->display_name){
		return $author->display_name;
	}else if($author->first_name || $author->last_name){
		return $author->first_name . ' ' . $author->last_name;
	}else if($author->nicname){
		return $author->nicname;
	}else{
		return $author->post_title;
	}
}

function getCorrectAuthor($author){
	global $wpdb;

	//get regular author
	$getAuthor = get_user_by('slug', substr($author->slug, 4));

	if(!$getAuthor){
		//get coauthors author
		$query = $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key=%s AND meta_value=%s;", 'cap-user_login', substr($author->slug, 4) );
		$post_id = $wpdb->get_var( $query );

		if($post_id){

			$getAuthor = get_post($post_id);

		}else{
			return false;
		}
	}

	return (object)[
		'ID' => $getAuthor->ID,
		'display_name' => getCoAuthorDisplayName($getAuthor),
	];
}

function getFilter($results){

	//get all authors with posts from coauthors taxonomy
	$getAuthors = get_terms('author', array(
		'orderby' => 'name',
		'hide_empty' => true,
		'number' => 20,
	));


	$filterableAuthors = array();
	foreach($getAuthors as $aAuthor){

		$aAuthor = getCorrectAuthor($aAuthor);

		$filterableAuthors[$aAuthor->ID] = (object)[
			'id' => $aAuthor->ID,
			'display_name' => $aAuthor->display_name,
			'count' => 0,
		];
	}

	//get all tags with posts
	$getTags = get_terms('post_tag', array(
		'orderby' => 'name',
		'hide_empty' => true,
	));

	$filterableTags = array();
	foreach ($getTags as $aTag) {
		$filterableTags[$aTag->term_id] = (object)[
			'id' => $aTag->term_id,
			'name' => ucfirst($aTag->name),
			'count' => 0,
		];
	}

	//get all issues
	$getIssues = get_posts(array(
		'post_type' => 'issue',
	    'post_status' => 'publish',
	    'numberposts' => -1,
	    'orderby' => 'number',
	    'order' => 'DESC',
	));

	$filterableIssues = array();
	foreach($getIssues as $aIssue){
		$filterableIssues[$aIssue->ID] = (object)[
			'id' => $aIssue->ID,
			'number' => get_field('number', $aIssue),
			'title' => get_the_title($aIssue),
			'count' => 0,
		];
	}

	foreach ($results as $aResult) {

		//count result by same author
		foreach ($aResult->authors as $aAuthor) {
			if($filterableAuthors[$aAuthor->id]){
				$filterableAuthors[$aAuthor->id]->count = $filterableAuthors[$aAuthor->id]->count + 1;
			}
		}

		//store author ids to result
		$aResult->author_ids = array();
		foreach ($aResult->authors as $aAuthor) {
			$aResult->author_ids[$aAuthor->id] = $aAuthor->id;
		}

		//count result by same tag
		foreach ($aResult->tags as $aTag) {
			if($filterableTags[$aTag->id]){
				$filterableTags[$aTag->id]->count = $filterableTags[$aTag->id]->count + 1;
			}
		}

		//store tag ids to result
		$aResult->tag_ids = array();
		foreach ($aResult->tags as $aTag) {
			$aResult->tag_ids[$aTag->id] = $aTag->id;
		}

		//count result by same issue
		if($filterableIssues[$aResult->issue_id]){
			$filterableIssues[$aResult->issue_id]->count = $filterableIssues[$aResult->issue_id]->count + 1;
		}
	}

	// var_dump($aResult);


	return (object)[
		'filterableAuthors' => $filterableAuthors,
		'filterableTags' => $filterableTags,
		'filterableIssues' => $filterableIssues,
		'total' => count($results),
		'results' => $results,
	];

}



$mainMenu = array();
$mainMenuItems = wp_get_nav_menu_items('main-menu');
if($mainMenuItems){
	foreach ($mainMenuItems as $aLink) {
		$mainMenu[] = (object)[
			'title' => $aLink->title,
			'url' => $aLink->url,
		];
	}
}

$footerMenu = array();
$footerMenuItems = wp_get_nav_menu_items('footer-menu');
if($footerMenuItems){
	foreach ($footerMenuItems as $aLink) {
		$footerMenu[] = (object)[
			'title' => $aLink->title,
			'url' => $aLink->url,
		];
	}
}

//get current issue
$getCurrentIssue = @reset(get_posts(array(
    'post_type' => 'issue',
    'post_status' => 'publish',
    'numberposts' => 1,
    'orderby' => 'number',
    'order' => 'DESC',
)));

if($getCurrentIssue){
	$currentIssue = (object)[
		'number' => get_field('number', $getCurrentIssue->ID),
		'url' => get_permalink($getCurrentIssue),
	];
}

$smarty->assign([
	'mainMenu' => $mainMenu,
	'footerMenu' => $footerMenu,
	'currentIssue' => $currentIssue,
	'newsletter' => get_page_link(301),
	'opencall' => get_page_link(990),
	'showOpenCallButton' => get_post_status(990) == 'publish' ? true : false,
]);
