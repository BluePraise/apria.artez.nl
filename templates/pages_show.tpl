{extends file="main.tpl"}
{block name="content"}
	<div class="main-content">
		<article class="main-column">
			<div class="content-wrap">
				<h1 class="article__title balance-text">
					{$page->title}
				</h1>
				{if $page->subtitle}
					<h2 class="article__subtitle balance-text">{$page->subtitle}</h2>
				{/if}

				<div class="article__text">
					{$page->content}
				</div>
				{include "element_footer.tpl" class="hide-on-mobile"}
			</div>
		</article>

		{* If we have Def Sidebar Text (Special Post - Stupid desicion) or Sidebar text for this Page (ACF Field) *}
		{if $defaultSidebarText || $page->sidebartext}
			<aside class="sidebar-column affix-placeholder">
				<div class="affix-content js-affix-scrolling">
					<div class="content-wrap">
						<div class="sidebar__text">
							{if $page->sidebartext}
								{$page->sidebartext}
							{elseif $defaultSidebarText}
								{$defaultSidebarText}
							{/if}
						</div>
						{include "element_footer.tpl" class="hide-on-desktop"}
					</div>
				</div>
			</aside>
		{else}
			{include "element_sidebar.tpl"}
		{/if}
	</div>
{/block}
