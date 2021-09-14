<?php get_template_part('head'); ?>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>

<header class="main-header">
	<div class="container">
		<div class="logo-container">
				<a href="<?=get_bloginfo('url'); ?>" class="logo-svg-cover"></a>
			<a xlink:href="<?=get_bloginfo('url'); ?>" target="_blank" class="sticky-logo">
  				<svg  class="apria_logo" style="background-color: var(--text-color-1);"></svg>
  			</a>
		
		</div>
	<?php
		wp_nav_menu([
			'theme_location' => 'header_menu',
			'container' => 'nav',
			'container_class' => 'main-navigation',
			'menu_class' => 'menu',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 1,
			]);

	// Social Medias
		$social_media_group = get_field("social_media_links", "options");

		if ($social_media_group) : ?>
			<ul class="social-list">
				<li class="social-item">
					<a class="youtube" href="<?php echo esc_url($social_media_group['youtube_url']); ?>" title="Click to go to Apria's YouTube"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/icon_youtube.svg" alt="YouTube Icon"></a>
				</li>
				<li class="social-item">
					<a class="instagram" href="<?php echo esc_url($social_media_group['instagram_url']); ?>" title="Click to go to Apria's Instagram"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/icon_instagram.svg" alt="Instagram Icon"></a>
				</li>
				<li class="social-item">
					<a class="facebook" href="<?php echo esc_url($social_media_group['facebook_url']); ?>" title="Click to go to Apria's Facebook Page"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/icon_facebook.svg" alt="Facebook Icon"></a>
				</li>
			</ul>
		<?php endif; ?>
		<div class="search-field hide">
			<form action="/" method="get">
			<input type="search" name="s" class="search-input"/>
		</div>
		<div class="mobile-menu-close-button js-mobile-menu-close-button hide-on-desktop">
				<img src="<?= get_stylesheet_directory_uri(). '/assets/svg/icon_close_highlight.svg'; ?>">
		</div>

	</div><!-- .container -->
		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop">
			<svg fill="#ff0000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="35px" height="35px"><path d="M 0 9 L 0 11 L 50 11 L 50 9 Z M 0 24 L 0 26 L 50 26 L 50 24 Z M 0 39 L 0 41 L 50 41 L 50 39 Z"/></svg>
		</div>


	
</header>
