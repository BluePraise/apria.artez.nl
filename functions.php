<?php

// Front end scripts
add_action('wp_enqueue_scripts', function () {
	// wp_deregister_script('');
	wp_dequeue_style('apria_scripts_jquery');
	wp_deregister_script('apria_scripts_jquery');
	wp_dequeue_style('apria_scripts_main');
	wp_deregister_script('apria_scripts_main');
	wp_enqueue_style('apria_styles_main', get_theme_file_uri('styles/main.css'), false);
	wp_enqueue_script('apria_scripts_jquery', get_theme_file_uri('scripts/jquery-latest.min.js'), '', '3.6', true);
	// wp_enqueue_script('jquery-ui');
	wp_enqueue_script('apria_scripts_fastclick', get_theme_file_uri('scripts/fastclick.js'), 'apria_scripts_jquery', '', true);
	wp_enqueue_script('apria_scripts_sysaffix', get_theme_file_uri('scripts/jquery.sys-affix.js'), 'apria_scripts_jquery', '', true);
	wp_enqueue_script('apria_scripts_balancetext', get_theme_file_uri('scripts/balancetext.min.js'), '', '', true);
	wp_enqueue_script('apria_scripts_cookie', get_theme_file_uri('scripts/jquery.cookie.min.js'),'apria_scripts_jquery', '', true);
	wp_enqueue_script('apria_scripts_planck', get_theme_file_uri('scripts/planck.min.js'), '', '',  true);
	wp_enqueue_script('apria_scripts_d3', get_theme_file_uri('scripts/d3.min.js'), '', '', true);
	wp_enqueue_script('apria_scripts_aprialogo', get_theme_file_uri('scripts/apria_logo.js'), '', '', true);
	wp_enqueue_script('apria_new_main_scripts', get_theme_file_uri('scripts/main.js'), 'apria_scripts_jquery', '',  true);
	wp_enqueue_script('apria_new_scripts', get_theme_file_uri('scripts/script.js'), 'apria_scripts_jquery', '0.1', true);
	// wp_localize_script('apria_scripts_main', 'ajax', array(
	// 	'url' => admin_url('admin-ajax.php'),
	// 	'ajax_nonce' => wp_create_nonce('noncy_nonce'),
	// 	'assets_url' => get_stylesheet_directory_uri(),
	// ));
});

// add_image_size('personpreview', 300, 300, true);
// add_image_size('persondetail', 500, false, false);
add_image_size('preview-size', 1024, false, false);

add_theme_support('post-thumbnails');

show_admin_bar(false);


// Register Nav Menus
add_action("after_setup_theme", function () {
	register_nav_menus([
		'header_menu' => 'Header Menu',
		'footer_menu' => 'Footer Menu'
	]);
});

//Add Search Form Into Header Menu
add_filter('wp_nav_menu_items', 'apria_change_nav_menu_items', 10, 2);
function apria_change_nav_menu_items($items, $args) {
	if ('header_menu' == $args->theme_location) {
		$items .= '<li class="menu-item">';
		$items .= get_search_form(false);
		$items .= "</li>";

		// Getting Menu Object
		$menu_object = $args->menu;

		// Header Menu Additional Fields
		$additional_menu_links = get_field("additional_menu_links", $menu_object);

		// Checking Additional Menu Links
		if ($additional_menu_links) {
			foreach ($additional_menu_links as $additional_menu_link) {
				$additional_menu_link_url = $additional_menu_link['additional_link']['url'];
				$additional_menu_link_title = $additional_menu_link['additional_link']['title'];
				$additional_menu_link_target = $additional_menu_link['additional_link']['target'] ? $additional_menu_link['additional_link']['target'] : '_self';

				// Printing additional menu Items (Mobile version)
				$items .= "<li class='menu-item menu-item__spaced hide-on-desktop'>";
				$items .= "<a href='" . esc_url($additional_menu_link_url) . "' target='" . esc_attr($additional_menu_link_target) . "' title='" . esc_attr($additional_menu_link_title) . "'>" . esc_html($additional_menu_link_title) . "</a>";
				$items .= "</li>";
			}
		}

	}

	return $items;
}


/***
 * ACF CUSTOMIZATION
 */

function my_acf_json_save_point($path)
{
	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// Acf Options Pages
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Apria Information',
		'menu_title' => 'Apria Information',
		'menu_slug'  => 'apria-information',
		'capability' => 'edit_posts',
		'capability' => 'edit_posts',
		'position' => '8',
		'icon_url' => 'dashicons-welcome-view-site',
		'redirect' => false
	));

}

// Register Sidebar
add_action('widgets_init', 'apria_register_sidebars');
function apria_register_sidebars()
{

	register_sidebar(array(
		'name' => __("Regular Pages Right Sidebar"),
		'id' => "rp-right-sidebar",
		'description' => 'Right Sidebar on regular pages',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s sidebar__text">',
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar' => '', // WP 5.6
	));
}

// Register custom post types
function create_post_types()
{
	register_post_type('issue',
		[
			'labels' => [
				'name' => __('Issues'),
				'singular_name' => __('Issue')
			],
			'has_archive' => true,
			'public' => true,
			'show_in_rest' => false,
			'supports' => ['title', 'author', 'editor', 'thumbnail'],
			// 'taxonomies'  => [],
		]
	);
	register_post_type('news',
		[
			'labels' => [
				'name' => __('News'),
				'singular_name' => __('News')
			],
			'has_archive' => false,
			'public' => true,
			'show_in_rest' => false,
			'supports' => ['title', 'author', 'editor'],
			// 'taxonomies'  => [],
		]
	);
}


add_action('init', 'create_post_types');


function change_wp_search_size($queryVars) {
    if ( isset($_REQUEST['s']) ) {
        $queryVars['posts_per_page'] = -1;

 }
    return $queryVars;
}

add_filter('request', 'change_wp_search_size');

/**
 * Ajax newsletter
 *
 * @url http://www.thenewsletterplugin.com/forums/topic/ajax-subscription
 */
function realhero_ajax_subscribe()
{
	check_ajax_referer('noncy_nonce', 'nonce');
	$data = urldecode($_POST['data']);
	if (!empty($data)) :
		$data_array = explode("&", $data);
		$fields = [];
		foreach ($data_array as $array) :
			$array = explode("=", $array);
			$fields[$array[0]] = $array[1];
		endforeach;
	endif;
	if (!empty($fields)) :
		global $wpdb;

		// check if already exists

		/** @var int $count * */
		$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}newsletter WHERE email = %s", $fields['ne']));

		if ($count > 0) {
			$output = array(
				'status' => 'error',
				'msg' => __('Already in a database.', THEME_NAME)
			);
		} elseif (!defined('NEWSLETTER_VERSION')) {
			$output = array(
				'status' => 'error',
				'msg' => __('Please install & activate newsletter plugin.', THEME_NAME)
			);
		} else {
			/**
			 * Generate token
			 */

			/** @var string $token */
			$token = wp_generate_password(rand(10, 50), false);
			$wpdb->insert($wpdb->prefix . 'newsletter', array(
					'name' => $fields['nn'],
					'surname' => $fields['ns'],
					'email' => $fields['ne'],
				)
			);

			$opts = get_option('newsletter');
			$opt_in = (int)$opts['noconfirmation'];
			// This means that double opt in is enabled
			// so we need to send activation e-mail

			if ($opt_in == 0) {
				$newsletter = Newsletter::instance();
				$user = NewsletterUsers::instance()->get_user($wpdb->insert_id);
				NewsletterSubscription::instance()->mail($user->email, $newsletter->replace($opts['confirmation_subject'], $user), $newsletter->replace($opts['confirmation_message'], $user));
			}
			$output = array(
				'status' => 'success',
				'msg' => __('Thank you!', THEME_NAME)
			);
		}

	else :
		$output = array(
			'status' => 'error',
			'msg' => __('An Error occurred. Please try again later.', THEME_NAME)
		);
	endif;

	wp_send_json($output);
}

add_action('wp_ajax_realhero_subscribe', 'realhero_ajax_subscribe');
add_action('wp_ajax_nopriv_realhero_subscribe', 'realhero_ajax_subscribe');
add_theme_support('title-tag');
add_action('after_theme_setup', 'theme_features');

add_filter( 'render_block', function( $content, $block ) {
	if( 'core/image' !== $block['blockName'] )
		return $content;

	$alt = get_post_meta( $block['attrs']['id'], '_wp_attachment_image_alt', true );
	if( empty( $alt ) )
		return $content;

	// Empty alt
	if( false !== strpos( $content, 'alt=""' ) ) {
		$content = str_replace( 'alt=""', 'alt="' . $alt . '"', $content );

	// No alt
	} elseif( false === strpos( $content, 'alt="' ) ) {
		$content = str_replace( 'src="', 'alt="' . $alt . '" src="', $content );
	}

	return $content;
}, 10, 2 );

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

if(!function_exists("getFilter")) {

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
		if($aResult->authors) {
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
	}

		//count result by same tag
	if($aResult->tags) {
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
		'total' => count($results) ,
		'results' => $results,
	];

}
}


if(!function_exists("getCorrectAuthor")) {
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
}

if(!function_exists("getCoAuthorDisplayName")) {
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

}

function aria_hex_rgb($hex) {
	
list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
return "{$r}, {$g}, {$b}";
}

function removenbsp1($s) {
	return str_replace(array('&nbsp;'), ' ', $s);
}

if(!function_exists("removenbsp")) {
function removenbsp($s) {
	return str_replace(array('&nbsp;'), ' ', $s);
}
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


function e($s) {
	return htmlspecialchars($s);
}

function ll($key) {
	return $GLOBALS['smarty']->getConfigVariable($key);
}


function myStrftime($format, $timestamp) {
	return strftime(
		str_replace('%b', ll('month_short_'.date('m', $timestamp)), str_replace('%A', ll('weekday_'.date('w', $timestamp)), str_replace('%B', ll('month_'.date('m', $timestamp)), $format))),
		$timestamp
	);
}



function rgba($hex, $opacity) {
	return 'rgba(' . hexdec(substr($hex, 1, 2)) . ',' . hexdec(substr($hex, 3, 2)) . ',' . hexdec(substr($hex, 5)) . ',' . $opacity . ')';
}

function formatIssueNumber($number){
	return '#'.str_pad($number, 2, '0', STR_PAD_LEFT);
}

if(!function_exists("footnotify")) {
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
