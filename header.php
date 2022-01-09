<?php get_template_part('head'); ?>
<?php if(get_field('issue') && is_single()):
	// get the issue variables
	$issue = get_field('issue')->post_type;
	$issue_ID = get_field('issue')->ID;
	// checks if article is related to post type issue
	if($issue === 'issue' ):
		// get the needed variables
		if (get_field('text_color', $issue_ID)):
			$issue_text_color = get_field('text_color', $issue_ID);
		else:
			$issue_text_color = 'var(--text-color-2)';
		endif;
		if (get_field('background_color', $issue_ID)):
			$issue_bg_color = get_field('background_color', $issue_ID);
		endif;
		if (get_field('background_image', $issue_ID)):
			$issue_bg_img = get_field('background_image', $issue_ID);
		endif;
	endif;	?>
	<style>
		:root {
			--issue-text-color: <?php echo $issue_text_color ?>;
			--issue-bg-color: <?php echo $issue_bg_color ?>;
			--issue_bg_img: <?php echo $issue_bg_img ?>;
		}
		.issue-styling {
			background-color: var(--issue-bg-color) !important;
			color: var(--issue-text-color) !important;
		}
		.single .content-with-sidebar header.article-header span,
		h1.content-title,
		.article__text {
			border-bottom: 1px solid var(--issue-text-color);
			color: var(--issue-text-color) !important;
		}
		header.main-header nav.main-navigation ul li {
			border: 1px solid var(--issue-text-color);
		}
		/* just color */
		.aside-excerpt,
		.article-separator,
		h1.content-title, h2.subtitle,
		.single .content-with-sidebar h2.subtitle,
		.single .content-with-sidebar .latest-posts h2,
		.single .content-with-sidebar aside .article__meta,
		header.main-header nav.main-navigation ul li a,
		.content-with-sidebar a {
			color: var(--issue-text-color) !important;
		}
		/* just BG Color */
		.single .content-with-sidebar aside .article-separator-large {
			background-color: var(--issue-text-color);
		}
		.article__text hr {
			color: var(--issue-bg-color);
			background-color: var(--issue-text-color);
			border: 1px solid var(--issue-bg-color);
		}
	</style>
	<body <?php body_class('issue-styling'); ?>>
	<?php else: ?>
		<body <?php body_class(); ?>>
<?php endif; ?>

<?php do_action('wp_body_open'); ?>

<header class="main-header <?php if(get_field('issue')): ?> issue-styling <?php endif; ?>">
	<div class="container">
		<div class="logo-container">
			<a href="<?php echo get_bloginfo('url'); ?>" xlink:href="<?php echo get_bloginfo('url'); ?>"  class="sticky-logo">
				<svg  class="apria_logo" style="background-color: <?php if(get_field('issue')): ?> var(--issue-text-color); <?php endif; ?>var(--text-color-1);"></svg>
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
