<footer{if $color} style="color: {$color}"{/if}{if $class} class="{$class}"{/if}>
	<span class="copyright-info">
		©2019 APRIA
		<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
			<img alt="Creative Commons License" style="border-width:0"
				 src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png"/>
		</a>
	</span>
	{if $footerMenu}
		<span class="footer-pages">
			{foreach $footerMenu as $aItem}
				<a href="{$aItem->url}">{$aItem->title}</a>
			{/foreach}
		</span>
	{/if}
	<span class="social-media">
		APRIA on
		<a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a>
		<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a>
		<a href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a>
	</span>
</footer>
