<div class="article-preview {$classNames}{if $aPost->url} clickable-block" data-href="{$aPost->url}{/if}">
	<div class="preview__background-container">

		<div class="preview__background-image">
			{if $aPost->featureImage}
				<img src="{$aPost->featureImage[0]}" alt=""/>
			{else}
				<img src="/wp-content/themes/apria/elements/preview_image_placeholder.jpg?w=400" alt="">
			{/if}
		</div>

		{if $aPost->url}
			<a href="{$aPost->url}" class="preview__title balance-text">{$aPost->title}</a>
		{else}
			<span class="preview__title balance-text">{$aPost->title}</span>
		{/if}
		{if $aPost->subtitle}
			<div class="preview__subtitle balance-text">{$aPost->subtitle}</div>
		{/if}
		<div class="preview__text">
			{$aPost->previewtext}
		</div>
	</div>
	<div class="preview__info"{if $color} style="color: {$color};"{/if}>
		{if $aPost->date}
			<span class="preview__date">{$aPost->date|formatDate}</span>
		{/if}
		{if $aPost->authors}
			<span class="preview__authors">
				{foreach $aPost->authors as $aAuthor}
					<a href="{$aAuthor->post_url}">{$aAuthor->name}</a>
				{/foreach}
			</span>
		{/if}
	</div>
</div>
