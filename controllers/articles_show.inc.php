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



if (have_posts()) {
	$article = new stdclass;
	the_post();
	ob_start();
	the_content();
	$article->content = ob_get_contents();
	ob_end_clean();

	$article->ID = get_the_ID();
	$article->title = get_the_title();
	$article->subtitle = get_field('subtitle');
	$article->doi = get_field('doi');
	$titleParts = explode(': ', $article->title);
	if (count($titleParts) == 2) {
		$article->subtitle = $titleParts[1];
		$article->title = $titleParts[0];
	}
	ob_start();
	coauthors_posts_links();
	$article->authors_links = ob_get_contents();
	ob_end_clean();
	$article->date = get_the_date();

	$article->authors = getAuthors($article->ID);
	$article->paragraph_layout = get_field('paragraph_layout');
	$article->bibliography = get_field('bibliography');

	if(get_the_tags()){
		$tags = get_the_tags();
		$article->tags = array_map(function ($aTag) {
			return (object)[
				'id' => $aTag->term_id,
				'name' => $aTag->name,
				'url' => get_tag_link($aTag),
			];
		}, $tags);
		$article->tagIds = array_map(function ($aTag) { return $aTag->term_id; }, $tags);
	}

	$article->categoryIds = array_map(function ($aCategory) { return $aCategory->term_id; }, get_the_category());

	$article->issue = get_field('issue', $article->ID);
	if ($article->issue) {
		$article->issue = extendIssue($article->issue);

		// If in issue, get related posts from issue

		$related_posts = get_posts(array(
		    'post_type' => 'post',
		    'post_status' => 'publish',
		    'numberposts' => -1,
		    'meta_key' => 'issue',
		    'meta_value' => $article->issue->ID,
		));

	} else if($article->tags){
		// If not in issue, get related posts from the tags

		$tagIds = array();
		foreach ($article->tags as $aTag) {
			$tagIds[] = $aTag->id;
		}

		$related_posts = get_posts(array(
			'post_type' => 'post',
		    'post_status' => 'publish',
		    'numberposts' => -1,
		    'orderby' => 'date',
		    'post__not_in' => array(get_the_id()),
		    'tag__in' => $tagIds,
		));
	}

	if ($related_posts) {
		$article->related_posts = array_map(function ($aPost) use ($article) {
			$thisPost = extendIssuePost($aPost);

			$thisPost->relevance = count(array_intersect($thisPost->tagIds, $article->tagIds));

			// Boost articles if they’re in the same series
			if (array_intersect($thisPost->categoryIds, $article->categoryIds)) {
				$thisPost->relevance = $thisPost->relevance + 100000;
			}

			// Boost articles if they’re part of an issue
			// if($thisPost->issue_id){
			// 	$thisPost->relevance = $thisPost->relevance + 10000;
			// }

			return $thisPost;
		}, $related_posts);

		usort($article->related_posts, function ($a, $b) {
			if ($a->relevance == $b->relevance) {
				return strcmp($b->date, $a->date);
			}

			return $b->relevance - $a->relevance;
		});

		// var_dump(array_map(function ($aPost) { return $aPost->relevance; }, $article->related_posts));
	}

	footnotify($article);

	$smarty->assign([
		'article' => $article,
		'htmlClass' => 'show-picture-text-toogle',
	]);

	if ($article->issue) {
		$smarty->assign([
			'color' => $article->issue->text_color ? $article->issue->text_color : false,
			'backgroundcolor' => $article->issue->background_color ? $article->issue->background_color : false,
			'background_image' => $article->issue->background_image ? $article->issue->background_image : false,
		]);
	}

	$pageTitle = $article->title . ' - ' . $pageTitle;
}
