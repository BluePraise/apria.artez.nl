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

function change_wp_search_size($queryVars)
{
	if (isset($_REQUEST['s']))
		$queryVars['posts_per_page'] = -1;
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

