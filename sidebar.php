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

?>

<aside class="sidebar-column <?php if($newsPosts): ?> sidebar-column--news<?php endif; ?> affix-placeholder">
		<div class="affix-content <?php if($realm == "issue"): ?> js-affix-scrolling-issue <?php else: ?> js-affix-scrolling <?php endif; ?>">
			<div class="content-wrap">
			<?php if($sidebar_issue) : ?>
				<div class="issue-preview clickable-block" data-href="<?=$sidebar_issue->url?>?color=ffffff&amp;bgcolor=000000&amp;opacity=0.2&amp;image=background_02.svg">
					<div class="preview__background" <?php if($sidebar_issue->background_image) { ?> style="background-image: url(<?=$sidebar_issue->background_image; ?>);background-color:<?=$sidebar_issue->background_color ?>;color: <?=$sidebar_issue->text_color ?>" <?php } ?>>
						<a href="<?=$sidebar_issue->url; ?>" class="preview__title balance-text"> <?=$sidebar_issue->title ?></a>
						<div class="preview__subtitle balance-text"> <?=$sidebar_issue->subtitle; ?></div>
					</div>
					<div class="preview__info">
						<span class="preview__date"> <?=formatDateShort($sidebar_issue->date); ?></span>
						<?php if ($sidebar_issue->authors) : ?>
						<span class="preview__authors">
<?php foreach ($sidebar_issue->authors as $aAuthor) : ?>
							<a href="<?=$aAuthor->post_url; ?>"> <?=$aAuthor->name; ?></a>
<?php endforeach; ?>
						</span>
<?php endif; ?>
					</div>
				</div>
<?php endif; ?>

<?php 

if($newsPosts) :
	foreach ($newsPosts as $aPost) : ?>
<!-- {include "element_sidebar_post.tpl" classNames="article-preview--news"} -->
		<div class="article-preview article-preview--news  clickable-block" data-href="<?=$aPost->url; ?>">
			<div class="preview__background-container">
				<div class="preview__background-image">
				<?php if($aPost->featureImage): ?>
					<img src="<?=$aPost->featureImage[0]; ?>"  alt="" />
				<?php else: ?>
					<img src="/wp-content/themes/apria/elements/preview_image_placeholder.jpg?w=400" alt="">
				<?php endif; ?>
				</div>

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
						<span class="preview__date">{$aPost->date|formatDate}</span>
				<?php endif; 
					if($aPost->authors) : ?>
						<span class="preview__authors">
							<?php foreach($aPost->authors as $aAuthor) : ?>
								<a href="<?=$aAuthor->post_url;?>"><?=$aAuthor->name; ?></a>
							<?php endforeach; ?>
						</span>
					<?php endif; ?>
					</div>
				</div>
				<hr style="background:<?=$sidebar_issue->$background_color ?>" class="article-preview-rule"></hr>

<?php endforeach; endif; ?>

<?php 
if($sidebar_posts): 

foreach ($sidebar_posts as $aPost): ?>

<div class="article-preview clickable-block" data-href="<?=$aPost->url; ?>">
<style>
	<?php var_dump($sidebar_issue); ?>
</style>

					<div class="preview__background-container">

						<div class="preview__background-image">
<?php if($aPost->featureImage): ?>
							<img src="<?=$aPost->featureImage[0]; ?>"  alt="" />
<?php else: ?>
							<img src="/wp-content/themes/apria/elements/preview_image_placeholder.jpg?w=400" alt="">
<?php endif; ?>
						</div>

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
				<span style="color: <?php if(get_field('text_color')): get_field('text_color'); else: echo ('#000'); endif; ?>" class="preview__date"><?php echo date("m-d-Y", strtotime($aPost->date)); ?></span>
				<?php endif; 
					if($aPost->authors) : ?>
						<span class="preview__authors">
							<?php foreach($aPost->authors as $aAuthor): ?>
								<a style="color: <?php if(get_field('text_color')): get_field('text_color'); else: echo ('#000'); endif; ?>" href="<?=$aAuthor->post_url;?>"><?=$aAuthor->name; ?></a>
							<?php endforeach; ?>
						</span>
					<?php endif; ?>
					</div>
				</div>
				

				<hr style="background:<?php if(get_field('text_color')): get_field('text_color'); else: echo ('#000'); endif; ?>" class="article-preview-rule"></hr>

<?php endforeach; 
endif;
?>

				
			</div>
		</div>
	</aside>

	<?php get_footer(); ?>