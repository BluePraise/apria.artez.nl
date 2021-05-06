<?php wp_footer(); ?>

<footer>
	<span class="copyright-info">
		&copy;<?php echo esc_html(date("Y") . " " . __("APRIA", THEME_NAME)); ?>
		<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
			<img alt="<?php _e("Creative Commons License", THEME_NAME); ?>"
				 src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png"/>
		</a>
	</span>

	<?php

	// Printing Header Menu
	wp_nav_menu([
			'theme_location' => 'footer_menu',
			'container_class' => 'footer-pages',
			'menu_class' => 'menu-items',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 1,
	]);

	?>

	<?php

	// Social Medias
	$social_medias = get_field("social_media_links", "options");

	if ($social_medias) : ?>
		<span class="social-media">
			<span>
				<?php _e("APRIA on", THEME_NAME); ?>
			</span>
			<?php
			foreach ($social_medias as $social_media) :

				$social_media_link = $social_media['social_media_link'];

				if ($social_media_link) :

					$social_media_link_url = $social_media_link['url'];
					$social_media_link_title = $social_media_link['title'];
					$social_media_link_target = $social_media_link['target'] ? $social_media_link['target'] : '_self';
					?>
					<a href="<?php echo esc_url($social_media_link_url); ?>"
					   target="<?php echo esc_attr($social_media_link_target); ?>"
					   title="<?php echo esc_attr($social_media_link_title); ?>"
					>
						<?php echo esc_html($social_media_link_title); ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</span>
	<?php endif; ?>
</footer>


</body>
</html>
