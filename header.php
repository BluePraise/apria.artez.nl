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

<header>
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

			// Getting Menus Locations (Functionality for Open Call Button)
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
		</div> <!-- .menu -->


		<div class="site-title hide-on-desktop clickable-block" data-href="<?php echo esc_url(home_url()); ?>"
			 style="max-width: 25%;"
		>
			<?php echo esc_html(get_bloginfo()); ?>
		</div>

		<div class="logo-container">
			<a href="<?php echo esc_url(home_url()); ?>" class="logo" style="background-color: #000000">
				<svg class="apria_logo"></svg>
			</a>
		</div>

		<?php

		// Additional Menu Items (DESKTOP)

		// Getting Menus Locations (Functionality for Open Call Button)
		$menus_locations = get_nav_menu_locations();

		// Checking header_menu location
		if (isset($menus_locations['header_menu'])) :

			// Getting Menu Object from Location
			$menu_object = wp_get_nav_menu_object($menus_locations['header_menu']);

			// Header Menu Additional Fields
			$additional_menu_links = get_field("additional_menu_links", $menu_object);

			// Checking Additional Menu Links
			if ($additional_menu_links) :

				?>
				<div class="additional-links hide-on-mobile">
					<ul class="additional-links__list">
						<?php
						foreach ($additional_menu_links as $additional_menu_link) :

							$additional_menu_link_url = $additional_menu_link['additional_link']['url'];
							$additional_menu_link_title = $additional_menu_link['additional_link']['title'];
							$additional_menu_link_target = $additional_menu_link['additional_link']['target'] ? $additional_menu_link['additional_link']['target'] : '_self';

							?>
							<li class="additional-links__item">
								<a href="<?php echo esc_url($additional_menu_link_url); ?>"
								   target="<?php echo esc_attr($additional_menu_link_target); ?>"
								   title="<?php echo esc_attr($additional_menu_link_title); ?>"
								>
									<?php echo esc_html($additional_menu_link_title); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		<?php endif; // Checking header_menu location ?>

		<!-- ------------------------------------------ -->
		<?php

		// Social Medias
		$social_medias = get_field("social_media_links", "options");

		if ($social_medias) : ?>
			<ul class="socialmedia-items">
				<?php
				foreach ($social_medias as $social_media) :

					$social_media_link = $social_media['social_media_link'];
					$social_media_icon = $social_media['social_media_icon'];


					if ($social_media_link) :

						$social_media_link_url = $social_media_link['url'];
						$social_media_link_title = $social_media_link['title'];
						$social_media_link_target = $social_media_link['target'] ? $social_media_link['target'] : '_self';

						?>
						<li class="socialmedia-item">
							<a href="<?php echo esc_url($social_media_link_url); ?>"
							   target="<?php echo esc_attr($social_media_link_target); ?>"
							   title="<?php echo esc_attr($social_media_link_title); ?>"
							>
								<?php if ($social_media_icon) : ?>
									<img src="<?php echo esc_url($social_media_icon['url']); ?>"
										 alt="<?php echo esc_attr($social_media_icon['alt']); ?>"
										 title="<?php echo esc_attr($social_media_icon['title']); ?>">
								<?php else: ?>
									<?php echo esc_html($social_media_link_title); ?>
								<?php endif; ?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop">⠇</div>

	</div> <!-- .main-column -->

	<div class="sidebar-column">
		<?php

		// Getting number of published News
		$published_news = wp_count_posts("news");
		$published_news = $published_news->publish;

		if ($published_news) : ?>
			<div class="site-title site-title--news clickable-block" data-href="<?php echo esc_url(home_url()); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . "/elements/news.svg"); ?>"
					 width="100"
					 alt="<?php _e("News", THEME_NAME) ?>">
			</div>
		<?php else: ?>
			<div class="site-title clickable-block" data-href="<?php echo esc_url(home_url()); ?>"
				 style="max-width: 55%;"
			>
				<?php echo esc_html(get_bloginfo()); ?>
			</div>
		<?php endif; ?>

		<?php

		// Checking header_menu location (Functionality for Open Call Button)
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
					   class="sidebar__open-call js-open-as-overlay"></a>

				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<div class="picture-text-toggle js-picture-text-toggle">
			<div class="toggle-outer">
				<div class="toggle-inner"></div>
			</div>
			<div class="toogle-tooltip">
				<span class="switch-to-picture">
					<?php _e("Switch to Image View", THEME_NAME); ?>
				</span>
				<span class="switch-to-text">
					<?php _e("Switch to Text View", THEME_NAME); ?>
				</span>
			</div>
		</div>
	</div> <!-- .sidebar-column -->

</header>
