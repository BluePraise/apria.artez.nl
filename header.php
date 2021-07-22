<?php get_template_part('head'); ?>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>

<header>
	<div class="container">

	<?php
		wp_nav_menu([
			'theme_location' => 'header_menu',
			'container' => 'nav',
			'menu_class' => 'main-navigation',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 1,
			]);

	// Social Medias
		$social_media_group = get_field("social_media_links", "options");

		if ($social_media_group) : ?>
			<ul class="social-list">
				<li class="social-item">
					<a class="youtube" href="<?php echo esc_url($social_media_group['youtube_url']); ?>" title="Click to go to Apria's YouTube"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff2020" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg></a>
				</li>
				<li class="social-item">
					<a class="twitter" href="<?php echo esc_url($social_media_group['twitter_url']); ?>" title="Click to go to Apria's Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff2020" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
				</li>
				<li class="social-item">
					<a class="facebook" href="<?php echo esc_url($social_media_group['facebook_url']); ?>" title="Click to go to Apria's Facebook Page"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff2020" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
				</li>
			</ul>
		<?php endif; ?>
		</div>
</header>
