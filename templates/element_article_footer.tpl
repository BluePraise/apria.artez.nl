{if $authors}
	<div class="article__bios">
		{foreach $authors as $aAuthor}
			<div class="author-bio">
				<a href="{$aAuthor->posts_url}" class="bio__name">{$aAuthor->name|e}</a>
				<div class="bio__text">
					{$aAuthor->biography}
				</div>
			</div>
		{/foreach}
	</div>
{/if}

{if $footnotes}
	<div class="article__footnotes">
		<div class="footnotes__headline">{#references#}</div>
		{foreach $footnotes as $aFootnote}
			<div class="footnote">
				<span class="footnote-up icon js-footnote-up" data-footnotetext="{$aFootnote@iteration}">↑</span>
				<p>{$aFootnote}</p>
			</div>
		{/foreach}
	</div>
{/if}

{if $bibliography}
	<div class="article__bibliography">
		{$bibliography|shift_headlines:2}
	</div>
{/if}
