<?php wp_footer(); ?>

<footer>
	<span class="copyright-info">
		&copy;<?php echo esc_html(date("Y") . " " . __("APRIA", 'apria')); ?>
		<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
			<img alt="<?php _e("Creative Commons License", 'apria'); ?>"
				 src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png"/>
		</a>
	</span>

	<?php


		wp_nav_menu([
				'theme_location' => 'footer_menu',
				'container_class' => 'footer-pages',
				'menu_class' => 'menu-items',
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth' => 1,
		]);

	?>

</footer>


</body>
</html>
