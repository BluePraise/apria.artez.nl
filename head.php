<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section
 *
 * @package LseTheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<?php 
	if(is_singular('issue')):
		global $post;
		$id = $post->ID;
		$issue = get_post($id);
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
		$issue = $issue;
		$color = $issue->text_color ? $issue->text_color : '#000';
		$backgroundcolor = $issue->background_color ? $issue->background_color : '#fff';
		$background_image = $issue->background_image ? $issue->background_image['url'] : false;
	endif;
	
?>
