<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section
 *
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

	<?php
		wp_nav_menu([
			'theme_location' => 'header_menu',
			'container' => 'nav',
			'menu_class' => 'main-navigation',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 1,
			]);

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
</header>
