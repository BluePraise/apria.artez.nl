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
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>

<header style="position: relative !important; top: unset !important;">
	<div class="main-column">
		<div class="menu">
			<!-- Here will be the Main menu -->
			<?php

			// Printing Header Menu
			wp_nav_menu([
					'theme_location' => 'header_menu',
					'container' => 'false',
					'menu_class' => 'menu-items',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth' => 1,
			]);

			?>

			<div class="mobile-menu-close-button js-mobile-menu-close-button hide-on-desktop">
				<img src="<?php echo esc_url(get_template_directory_uri() . "/elements/icon_close_highlight.svg"); ?>"
					 alt="<?php _e("Mobile Close Icon", THEME_NAME); ?>">
			</div>

			<?php

			// Getting Menus Locations
			$menus_locations = get_nav_menu_locations();

			// Checking header_menu location
			if (isset($menus_locations['header_menu'])) :

				// Getting Menu Object from Location
				$menu_object = wp_get_nav_menu_object($menus_locations['header_menu']);

				// Header Menu Additional Fields
				$open_call_parameters = get_field("open_call_parameters", $menu_object);

				// Checking if we need to show Open Call Button
				if ($open_call_parameters['show_open_call_button']) :

					// Getting Link Parameters
					$open_call_btn_link = $open_call_parameters['open_call_button_link'];

					// Checking if Button link is set
					if ($open_call_btn_link) :

						$open_call_btn_link_url = $open_call_btn_link['url'];
						$open_call_btn_link_title = $open_call_btn_link['title'];
						$open_call_btn_link_target = $open_call_btn_link['target'] ? $open_call_btn_link['target'] : '_self';

						?>

						<a href="<?php echo esc_url($open_call_btn_link_url); ?>"
						   target="<?php echo esc_attr($open_call_btn_link_target); ?>"
						   title="<?php echo esc_attr($open_call_btn_link_title); ?>"
						   class="mobile__open-call js-open-as-overlay"></a>

					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>


		<div class="site-title hide-on-desktop clickable-block" data-href="<?php echo esc_url(home_url()); ?>">
			ArtEZ Platform<br>
			for Research<br>
			Interventions<br>
			of the Arts
		</div>

	</div>
</header>
