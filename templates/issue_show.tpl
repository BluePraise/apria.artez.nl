{extends file="main.tpl"}
{block name="content"}
	<div class="main-content issue-content" style="color: {$color}; background-color: {$backgroundcolor}">
		<div class="article__background-container hide-on-mobile">
			<div class="article__background">
				{if $background_image}
					<img class="article__background-image animation--rotate" src="{$background_image}" alt=""/>
				{/if}
			</div>
		</div>
		<a href="{get_home_url()}" class="overlay-close-button js-overlay-close-button">
			<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg"
				 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 22 22" xml:space="preserve">
			<path d="M11.7,10.9L22,21.2L21.2,22L10.9,11.7L0.7,22l-0.7-0.7l10.3-10.3L-0.1,0.7l0.7-0.7l10.3,10.3L21.2-0.1L22,0.7
			L11.7,10.9z" fill="{$color}"/>
		</svg>
		</a>

		<div class="issue-header" style="background-color: {$backgroundcolor}">
			{*
					<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop" style="color: {$color};">⠇</div>
			*}
			<div class="main-column">
				<a href="{home_url()}" class="logo">
					<svg class="apria_logo"{if $backgroundcolor} style="background-color: {$backgroundcolor}"{/if}></svg>
				</a>
				{*
				<a href="{home_url()}" class="logo" {if $backgroundcolor}style="background-color: {$backgroundcolor}"{/if}>
					<img src="{$documentroot}wp-content/themes/apria/elements/logo.svg" alt="" />
				</a>
				*}
				<div class="content-wrap hide-on-mobile">
					{include "element_issue_topline.tpl" device="mobile"}
				</div>
			</div>

			<div class="issue-header__gradient" style=";
					background: -moz-linear-gradient(top, {$backgroundcolor|rgba:1} 0%, {$backgroundcolor|rgba:0} 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(top, {$backgroundcolor|rgba:1} 60%,{$backgroundcolor|rgba:0} 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to bottom, {$backgroundcolor|rgba:1} 0%,{$backgroundcolor|rgba:0}; /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$backgroundcolor}}', endColorstr='{$backgroundcolor}00',GradientType=0 ); /* IE6-9 */"></div>
		</div>
		<article class="main-column" style="background-color: {$backgroundcolor}">
			<div class="article__background-mobile hide-on-desktop"{if $background_image} style="background-image: url({$background_image}); opacity: {$opacity}"{/if}></div>
			<div class="content-wrap">
				<div class="article__head">

					{include "element_issue_topline.tpl" device="desktop"}

					<h1 class="article__title balance-text">{$issue->title}</h1>
					{if $issue->subtitle}
						<h2 class="article__subtitle balance-text">{$issue->subtitle}</h2>
					{/if}
				</div>

				{if $issue->issue_authors}
					<div class="issue__authors">
						{$issue->issue_authors}
					</div>
				{elseif $allIssueAutors}
					<div class="issue__authors">
						With contributions from
						{foreach $allIssueAutors as $aAuthor}
							{$aAuthor->name}{if $aAuthor@last}.{else}, {/if}
						{/foreach}
					</div>
				{/if}

				<div class="article__text text--large">
					{$issue->content}
				</div>

				{include "element_article_footer.tpl" authors=$issue->authors footnotes=$issue->footnotes bibliography=$issue->bibliography}

				{include "element_footer.tpl" class="hide-on-mobile" color = "{$color}"}

			</div>
		</article>

		{include "element_sidebar.tpl" sidebar_issue=false sidebar_posts=$sidebar_posts}

	</div>
{/block}
