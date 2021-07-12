<footer <?php if($args["color"]) { ?> style="color: <?=$args['color'] ;?>" <?php } ?>>

	<span class="copyright-info">©2019 APRIA <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
    <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png" />
   </a>
  </span>
  <?php
  $footerMenu = array();
  $footerMenuItems = wp_get_nav_menu_items('footer-menu');
  if($footerMenuItems){
  	foreach ($footerMenuItems as $aLink) {
  		$footerMenu[] = (object)[
  			'title' => $aLink->title,
  			'url' => $aLink->url,
  		];
  	}
  }


if ($footerMenu) { ?>
	<span class="footer-pages">
<?php foreach($footerMenu as $aItem) { ?>
		<a href="<?=$aItem->url; ?>"> <?=$aItem->title; ?></a>
<?php } ?>
	</span>
<?php }
?>
	<span class="social-media">APRIA on <a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a> <a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a> <a href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a></span>

</footer>
<?php wp_footer(); ?>
</body>
</html>
