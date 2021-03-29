{extends file="main.tpl"}
{block name="content"}
<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">
			<div class="article__head">
				<div class="head__top-line"{if $color} style="color:{$color}"{/if}>
					<span class="article__date">{$article->date|formatDate}</span>
					<span class="article__authors">{$article->authors_links}</span>
{if $article->doi}
					<span class="article__issue">
						<a href="https://doi.org/{$article->doi|trim}">
							{#current_doi#}: {$article->doi|trim}
						</a>
					</span>
{/if}
				</div>
				<h1 class="article__title balance-text">{$article->title|e}</h1>
{if $article->subtitle}
				<h2 class="article__subtitle balance-text">{$article->subtitle|e}</h2>
{/if}
				<div class="head__bottom-line">
{if $article->issue}
					<span class="article__source"{if $color} style="color:{$color}"{/if}>
						Published in<br />
						<a href="{$article->issue->url|e}">Issue {$article->issue->number|formatIssueNumber}</a>
					</span>
{/if}
					{strip}
{if $article->tags}
					<span class="article__tags"{if $color} style="color:{$color}"{/if}>
{foreach $article->tags as $aTag}
						<a href="{$aTag->url|e}">{$aTag->name|e}</a>{if !$aTag@last} / {/if}
{/foreach}
					</span>
{/if}
					{/strip}
				</div>
			</div>
			<div class="article__text{if $article->paragraph_layout == 'indents'} article__text-indents{/if}">
				{$article->content}
			</div>

{include "element_article_footer.tpl" authors=$article->authors footnotes=$article->footnotes bibliography=$article->bibliography}

			{include "element_footer.tpl" class="hide-on-mobile"}
		</div>
	</article>

{include "element_sidebar.tpl" sidebar_issue=$article->issue sidebar_posts=$article->related_posts}

</div>
{/block}
