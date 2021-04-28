<header style="display:none;">
	<div class="main-column">
		<div class="menu">
			<ul class="menu-items">
				{foreach $mainMenu as $aItem}
					<li class="menu-item"{if $color} style="color:{$color}"{/if}><a
								href="{$aItem->url}">{$aItem->title}</a></li>
				{/foreach}
				<li class="menu-item"{if $color} style="color:{$color}"{/if}>
					<a href="{$newsletter}" class="js-open-as-overlay">{#menu_subscribe#}</a>
				</li>
				{if $currentIssue}
					<li class="menu-item"{if $color} style="color:{$color}"{/if}>
						<a href="{$currentIssue->url}">
							{#current_issue#}
						</a>
					</li>
				{/if}
				<li class="menu-item"{if $color} style="color:{$color}"{/if}>
					<form action="{get_home_url()}" method="get" class="search-form">
						<label class="form__label form__label--clickable">{#search#}</label>
						<input type="text" name="s" class="form__input" value="">
						<button type="submit" class="form__submit icon">→</button>
						<div class="form-border"></div>
					</form>
				</li>
				<li class="menu-item menu-item__spaced hide-on-desktop">
					<a href="https://periodical.networkcultures.org/">PARAZINE</a>
				</li>
			</ul>
			<div class="mobile-menu-close-button js-mobile-menu-close-button hide-on-desktop">
				<img src="{$documentroot}wp-content/themes/apria/elements/icon_close_highlight.svg">
			</div>

			{if $showOpenCallButton}
				<a href="{$opencall}" class="mobile__open-call js-open-as-overlay"></a>
			{/if}
		</div>

		<div class="site-title hide-on-desktop clickable-block" data-href="{$homeUrl}">
			{#side_title#}
		</div>

		<div class="logo-container">
			<a href="{home_url()}" class="logo" style="background-color: #000000">
				<svg class="apria_logo"{if $color != 'ffffff'} style="background-color: #{$color}"{/if}></svg>
			</a>
			{*
			<a href="{home_url()}" class="logo" {if $color != 'ffffff'}style="background-color: #{$color}"{/if}>
				<img src="{$documentroot}wp-content/themes/apria/elements/logo.svg" alt="" />
			</a>
			*}
		</div>

		<div class="additional-links hide-on-mobile">
			<ul class="additional-links__list">
				<li class="additional-links__item">
					<a href="https://periodical.networkcultures.org/">PARAZINE</a>
				</li>
			</ul>
		</div>

		<ul class="socialmedia-items">
			<li class="socialmedia-item">
				<a href="https://www.facebook.com/APRIAjournalandplatform/">{capture "svg"}
						{include "../elements/icon_facebook.svg"}
					{/capture}{$xcolor = $color|default:"#ff2020"}{$smarty.capture.svg|trim|replace:"#ff2020":$xcolor}</a>
			</li>

			<li class="socialmedia-item">
				<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">{capture "svg"}
						{include "../elements/icon_youtube.svg"}
					{/capture}{$xcolor = $color|default:"#ff2020"}{$smarty.capture.svg|trim|replace:"#ff2020":$xcolor}</a>
			</li>

			<li class="socialmedia-item">
				<a href="https://www.instagram.com/apria_journal_and_platform/">{capture "svg"}
						{include "../elements/icon_instagram.svg"}
					{/capture}{$xcolor = $color|default:"#ff2020"}{$ycolor = $backgroundcolor|default:"#ffffff"}{$smarty.capture.svg|trim|replace:"#ff2020":'--fgcolor--'|replace:"#ffffff":'--bgcolor--'|replace:"--fgcolor--":$xcolor|replace:"--bgcolor--":$ycolor}</a>
			</li>
		</ul>

		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop">⠇</div>
	</div>

	<div class="sidebar-column">
		{if $newsPosts}
			<div class="site-title site-title--news clickable-block" data-href="{$homeUrl}">
				<img src="{$documentroot}wp-content/themes/apria/elements/news.svg" width="100" alt="News">
			</div>
		{else}
			<div class="site-title clickable-block" data-href="{$homeUrl}">
				{#side_title#}
			</div>
		{/if}

		{if $showOpenCallButton}
			<a href="{$opencall}" class="sidebar__open-call js-open-as-overlay"></a>
		{/if}

		<div class="picture-text-toggle js-picture-text-toggle">
			<div class="toggle-outer"{if $color} style="background-color:{$color}"{/if}>
				<div class="toggle-inner"{if $backgroundcolor} style="background-color:{$backgroundcolor}"{/if}></div>
			</div>
			<div class="toogle-tooltip">
				<span class="switch-to-picture">{#switch_to_picture#}</span>
				<span class="switch-to-text">{#switch_to_text#}</span>
			</div>
		</div>
	</div>
</header>
