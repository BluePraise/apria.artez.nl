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



// require __DIR__ . '/controllers/element_main.inc.php';



// Front end scripts
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('apria_styles_main', get_theme_file_uri('styles/main.css'), false );
	wp_enqueue_script('apria_scripts_jquery', get_theme_file_uri('scripts/jquery-1.11.3.min.js'), false );
	wp_enqueue_script('apria_scripts_fastclick', get_theme_file_uri('scripts/fastclick.js'), false );
	wp_enqueue_script('apria_scripts_sysaffix', get_theme_file_uri('scripts/jquery.sys-affix.js'), false );
	wp_enqueue_script('apria_scripts_balancetext', get_theme_file_uri('scripts/balancetext.min.js'), false );
	wp_enqueue_script('apria_scripts_cookie', get_theme_file_uri('scripts/jquery.cookie.min.js'), false );
	wp_enqueue_script('apria_scripts_planck', get_theme_file_uri('scripts/planck.min.js'), false );
	wp_enqueue_script('apria_scripts_d3', get_theme_file_uri('scripts/d3.min.js'), false );
	wp_enqueue_script('apria_scripts_aprialogo', get_theme_file_uri('scripts/apria_logo.js'), false );
	wp_enqueue_script('apria_scripts_main', get_theme_file_uri('scripts/main.js'), false );
	wp_localize_script( 'apria_scripts_main', 'ajax', array(
	    'url' =>            admin_url( 'admin-ajax.php' ),
	    'ajax_nonce' =>     wp_create_nonce( 'noncy_nonce' ),
	    'assets_url' =>     get_stylesheet_directory_uri(),
	));
});

// add_image_size('personpreview', 300, 300, true);
// add_image_size('persondetail', 500, false, false);
add_image_size('preview-size', 1024, false, false);

add_theme_support( 'post-thumbnails' );

show_admin_bar(false);

// Register custom post types
function create_post_types() {
	register_post_type('issue',
		[
			'labels' => [
				'name' => __( 'Issues' ),
				'singular_name' => __( 'Issue' )
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
				'name' => __( 'News' ),
				'singular_name' => __( 'News' )
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

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

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
function realhero_ajax_subscribe() {
    check_ajax_referer( 'noncy_nonce', 'nonce' );
    $data = urldecode( $_POST['data'] );
    if ( !empty( $data ) ) :
        $data_array = explode( "&", $data );
        $fields = [];
        foreach ( $data_array as $array ) :
            $array = explode( "=", $array );
            $fields[ $array[0] ] = $array[1];
        endforeach;
    endif;
    if ( !empty( $fields ) ) :
        global $wpdb;

		// check if already exists

		/** @var int $count **/
		$count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}newsletter WHERE email = %s", $fields['ne'] ) );

		if( $count > 0 ) {
	        $output = array(
	            'status'    => 'error',
	            'msg'       => __( 'Already in a database.', THEME_NAME )
	        );
        } elseif( !defined( 'NEWSLETTER_VERSION' ) ) {
            $output = array(
	            'status'    => 'error',
	            'msg'       => __( 'Please install & activate newsletter plugin.', THEME_NAME )
	        );
        } else {
            /**
             * Generate token
             */

            /** @var string $token */
            $token =  wp_generate_password( rand( 10, 50 ), false );
	        $wpdb->insert( $wpdb->prefix . 'newsletter', array(
	                'name'		=> $fields['nn'],
	                'surname' 		=> $fields['ns'],
	                'email'         => $fields['ne'],
	            )
            );

            $opts = get_option('newsletter');
            $opt_in = (int) $opts['noconfirmation'];
            // This means that double opt in is enabled
            // so we need to send activation e-mail

            if ($opt_in == 0) {
                $newsletter = Newsletter::instance();
                $user = NewsletterUsers::instance()->get_user( $wpdb->insert_id );
                NewsletterSubscription::instance()->mail($user->email, $newsletter->replace($opts['confirmation_subject'], $user), $newsletter->replace($opts['confirmation_message'], $user));
            }
	        $output = array(
	            'status'    => 'success',
	            'msg'       => __( 'Thank you!', THEME_NAME )
	        );
		}

    else :
        $output = array(
            'status'    => 'error',
            'msg'       => __( 'An Error occurred. Please try again later.', THEME_NAME  )
        );
    endif;

    wp_send_json( $output );
}
add_action( 'wp_ajax_realhero_subscribe', 'realhero_ajax_subscribe' );
add_action( 'wp_ajax_nopriv_realhero_subscribe', 'realhero_ajax_subscribe' );

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