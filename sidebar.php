<?php
	if($args) {
		$sidebar_issue = $args["sidebar_issue"];
		$sidebar_posts = $args["sidebar_posts"];
	}
	$issue = get_post(get_the_ID());
	if($issue){
		$issue = (object)[
			'ID' 			=> $issue->ID,
			'title' 		=> get_the_title(),
			'subtitle' 		=> get_field('subtitle', $issue->ID),
			'date' 			=> $issue->post_date,
			'content' 		=> apply_filters('the_content', $issue->post_content),
			'authors' 		=> getAuthors($issue->ID),
			'number' 		=> get_field('number'),
			'text_color' 	=> get_field('text_color'),
			'background_color' => get_field('background_color'),
			'background_image' => get_field('background_image'),
			'bibliography' 	=> get_field('bibliography'),
			'issue_authors' => get_field('issue_authors'),
		];
	}
	$issue_ID = get_field('issue')->ID;
	// get the needed variables
	if (get_field('text_color')):
		$issue_text_color = $issue->text_color;
	else:
		$issue_text_color = 'var(--text-color-2)';
	endif;
		$issue_bg_color = $issue->background_color;

?>
<style>

	:root {
		--issue-bg-color: <?php echo $issue_bg_color ?>;
		--issue-text-color: <?php echo $issue_text_color ?>;
	}
	.preview__info {
		color: var(--issue-text-color);
	}
	.article-preview-rule,
	.single .content-with-sidebar aside .article-separator-large {
		background-color: var(--issue-text-color);
	}
</style>

<aside class="sidebar-column affix-placeholder">
	<div class="affix-content">

		<div class="content-wrap">
			<?php if($sidebar_posts): foreach ($sidebar_posts as $aPost): ?>
			<div class="article-preview clickable-block" data-href="<?=$aPost->url; ?>">

				<?php if($aPost->url): ?>
					<a href="<?=$aPost->url; ?>" class="preview__title balance-text"><?=$aPost->title; ?></a>
				<?php else: ?>
						<span class="preview__title balance-text"><?=$aPost->title; ?></span>
				<?php endif;

				if ($aPost->subtitle): ?>
					<div class="preview__subtitle balance-text"><?=$aPost->subtitle; ?></div>
				<?php endif; ?>
					<div class="preview__text">
						<?=$aPost->previewtext; ?>
					</div>
			</div>
			<div class="preview__info">
				<?php if($aPost->date): ?>
					<span class="preview__date"><?php echo date("m-d-Y", strtotime($aPost->date)); ?></span>
				<?php endif;

				if($aPost->authors) : ?>
					<span class="preview__authors">
						<?php foreach($aPost->authors as $aAuthor): ?>
							<a style="color: <?php if(get_field('text_color')): get_field('text_color'); else: echo ('#000'); endif; ?>" href="<?=$aAuthor->post_url;?>"><?=$aAuthor->name; ?></a>
						<?php endforeach; ?>
					</span>
				<?php endif; ?>
			</div>


		<hr class="article-preview-rule"></hr>

	<?php
		endforeach;
		endif;
	?>
		</div>
	</div>
</aside>
