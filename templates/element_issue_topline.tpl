<div class="head__top-line hide-on-{$device}" style="color: {$color}">
	<span class="article__number">{$issue->number|formatIssueNumber}</span>
	<span class="article__date">{$issue->date|formatDate}</span>
	{if $issue->authors}
		<span class="article__authors">
			{foreach $issue->authors as $aAuthor}
				<a href="{$aAuthor->post_url}">{$aAuthor->name}</a>
			{/foreach}
		</span>
	{/if}
</div>
