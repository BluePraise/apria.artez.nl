
<?php wp_footer(); ?>
<?php
	$issue_id 			= get_post(get_the_ID());
	$background_color 	= get_field('background_color', $issue_id);
?>
<footer style="background-color: <?= $background_color; ?>">
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

<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
</body>
</html>
