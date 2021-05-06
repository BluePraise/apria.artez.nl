{extends file="main.tpl"}
{block name="content"}
	<div class="main-content subscribe-content">
		<div class="overlay-close-button">
			<a href="{get_home_url()}" class="js-opencall-close-button">
				<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
			</a>
		</div>

		<a href="{get_home_url()}" class="logo" style="background-color: #">
			<img src="/wp-content/themes/apria/elements/logo.svg" alt="">
		</a>

		<article class="main-column">
			<div class="content-wrap">
				<div class="article__head">
					<h1 class="article__title">{$page->title}</h1>
					{if $page->subtitle}
						<h2 class="article__subtitle">{$page->subtitle}</h2>
					{/if}
				</div>

				<div class="article__text{if $page->paragraph_layout == 'indents'} article__text-indents{/if} article__text--open-call">
					{$page->content|shift_headlines:2}
				</div>
			</div>
		</article>
	</div>
{/block}
