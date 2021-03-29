{if $sidebar_issue || $sidebar_posts || $newsPosts}
	<aside class="sidebar-column{if $newsPosts} sidebar-column--news{/if} affix-placeholder">
		<div class="affix-content{if $realm == "issue"} js-affix-scrolling-issue{else} js-affix-scrolling{/if}">
			<div class="content-wrap">
{if $sidebar_issue}
				<div class="issue-preview clickable-block" data-href="{$sidebar_issue->url}?color=ffffff&amp;bgcolor=000000&amp;opacity=0.2&amp;image=background_02.svg">
					<div class="preview__background"{if $sidebar_issue->background_image} style="background-image: url({$sidebar_issue->background_image});background-color:{$sidebar_issue->background_color};color:{$sidebar_issue->text_color}"{/if}>
						<a href="{$sidebar_issue->url}" class="preview__title balance-text">{$sidebar_issue->title}</a>
						<div class="preview__subtitle balance-text">{$sidebar_issue->subtitle}</div>
					</div>
					<div class="preview__info">
						<span class="preview__date">{$sidebar_issue->date|formatDateShort}</span>
{if $sidebar_issue->authors}
						<span class="preview__authors">
{foreach $sidebar_issue->authors as $aAuthor}
							<a href="{$aAuthor->post_url}">{$aAuthor->name}</a>
{/foreach}
						</span>
{/if}
					</div>
				</div>
{/if}

{foreach $newsPosts as $aPost}
{include "element_sidebar_post.tpl" classNames="article-preview--news"}
{if $aPost@last}
				<hr class="article-preview-rule"></hr>
{/if}
{/foreach}

{foreach $sidebar_posts as $aPost}
{include "element_sidebar_post.tpl"}
{/foreach}

				{include "element_footer.tpl" class="hide-on-desktop"}
			</div>
		</div>
	</aside>
{/if}
