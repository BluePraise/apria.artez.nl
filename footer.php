<?php wp_footer(); ?>

<footer>
	<span class="copyright-info">
		&copy;<?php echo esc_html(date("Y") . __("APRIA", THEME_NAME)); ?>
		<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
			<img alt="<?php _e("Creative Commons License", THEME_NAME); ?>" style="border-width:0"
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
			'item_spacing' => 'discard'
	]);

	?>

	<span class="social-media">
		<span>
			<?php _e("APRIA on", THEME_NAME); ?>
		</span>
		<a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a>
		<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a>
		<a href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a>
	</span>
</footer>


</body>
</html>
