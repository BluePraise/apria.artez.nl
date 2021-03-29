{extends file="main.tpl"}
{block name="content"}
<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">

			<div class="article__head">
				<div class="head__top-line">
					<span class="article__surtitle">{$surtitle}:</span>
				</div>
				<h1 class="article__title">{$term|ucfirst}</h1>
			</div>

			<div class="search-results">
{if $posts->results}
{foreach $posts->results as $aPost}
				<div class="search-result{foreach $aPost->tag_ids as $aId} filter-tag-{$aId}{/foreach}{if $aPost->issue_id} filter-issue-{$aPost->issue_id}{/if}{foreach $aPost->author_ids as $aId} filter-author-{$aId}{/foreach}">
					<a href="{$aPost->url}" class="result__title">{$aPost->title}{if $aPost->subtitle} <em>{$aPost->subtitle}</em>{/if}</a>
					<div class="result__text">
						{$aPost->previewtext}
					</div>
					<div class="result__info">
						<div class="result__date">{$aPost->date|formatDate}</div>
						<ul class="result__meta">
{if $aPost->authors}
							<li>
{foreach $aPost->authors as $aAuthor}
								<a href="{$aAuthor->post_url}">{$aAuthor->name}</a>{if !$aAuthor@last}, {/if}
{/foreach}
							</li>
{/if}
{if $aPost->tags}
							<li>
{foreach $aPost->tags as $aTag}
								<a href="{$aTag->url}">{$aTag->name}</a>{if !$aTag@last} / {/if}
{/foreach}
							</li>
{/if}
{if $aPost->issue_number}
							<li>Published in <a href="{$aPost->issue_url}">ISSUE {$aPost->issue_number|formatIssueNumber}</a></li>
{/if}
						</ul>
					</div>
				</div>
{/foreach}
{else}
				{#search_no_results#}
{/if}

			</div>
			{include "element_footer.tpl" class="hide-on-mobile"}
		</div>
	</article>

{if $posts->filterableAuthors || $posts->filterableTags || $posts->filterableIssues}
	<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling">
			<div class="content-wrap">
				<div class="filter">
					<div class="filter__header">
						<span>{#filter_results#}</span> ({$posts->total}) | <span class="filter-reset js-reset-filter">{#filter_clear#}</span>
					</div>
{if  $posts->filterableIssues}
					<div class="filter__group">
						<div class="filter__group-title">{#filter_by_issue#}</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
{foreach $posts->filterableIssues as $aIssue}
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_issue_{$aIssue@iteration}"  value="{$aIssue->id}" data-type="issue">
								<label for="checkbox_issue_{$aIssue@iteration}">{$aIssue->number|formatIssueNumber} {$aIssue->title} ({$aIssue->count})</label>
							</div>
{/foreach}
						</div>
					</div>
{/if}
{if $posts->filterableAuthors}
					<div class="filter__group">
						<div class="filter__group-title">{#filter_by_author#}</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
{foreach $posts->filterableAuthors as $aAuthor}
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_author_{$aAuthor@iteration}"  value="{$aAuthor->id}" data-type="author">
								<label for="checkbox_author_{$aAuthor@iteration}">{$aAuthor->display_name} ({$aAuthor->count})</label>
							</div>
{/foreach}

						</div>
					</div>
{/if}
{if $posts->filterableTags}
					<div class="filter__group">
						<div class="filter__group-title">{#filter_by_tags#}</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
{foreach $posts->filterableTags as $aTag}
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_tag_{$aTag@iteration}" value="{$aTag->id}" data-type="tag">
								<label for="checkbox_tag_{$aTag@iteration}">{$aTag->name} ({$aTag->count})</label>
							</div>
{/foreach}
						</div>
					</div>
{/if}
{*
					<div class="filter__group">
						<div class="filter__group-title">{#filter_by_date#}</div>
						<div class="filter-clear-button icon">×</div>
						<div class="filter-date">from <span>12</span>/<span>2017</span> to <span>03</span>/<span>2018</span></div>
					</div>
*}
				</div>
				{include "element_footer.tpl" class="hide-on-desktop"}
			</div>
		</div>
	</aside>
{/if}
</div>
{/block}
