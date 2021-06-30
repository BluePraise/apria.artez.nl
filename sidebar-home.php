<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling sys-affix">
			<div class="content-wrap">
<?php 

$related_posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'meta_key' => 'issue',
    'meta_value' => false,
));

if($related_posts) { /*
?>
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
<?php */ }  

$newsPosts = [];
foreach (get_posts(array(
    'post_type' => 'news',
    'post_status' => 'publish',
    'numberposts' => 3,
)) as $aPost) {
	$newsPosts[] = (object)[
		'title' => get_the_title($aPost->ID),
		'subtitle' => get_field('subtitle', $aPost),
		'previewtext' => trim(get_field('preview_text', $aPost)) . ' •••',
		'url' => get_permalink($aPost),
	];
}


foreach($newsPosts as $aPost) {

?>
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
<?php foreach($aPost->authors as $aAuthor) { ?>
							<a href="<?=$aAuthor->post_url;?>"><?=$aAuthor->name; ?></a>
<?php } ?>
						</span>
<?php endif; ?>
					</div>
				</div>


				<hr class="article-preview-rule"></hr>
<?php
}

$currentIssuePosts = array();
foreach($related_posts as $aPost){
	$currentIssuePosts[] = extendIssuePost($aPost);
}


if($currentIssuePosts) { 
foreach ($currentIssuePosts as $aPost)  { ?>
<div class="article-preview clickable-block" data-href="<?=$aPost->url; ?>">
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
						<span class="preview__date"><?php echo date("m-d-Y", strtotime($aPost->date)); ?></span>
<?php endif; 
if($aPost->authors) : ?>
						<span class="preview__authors">
<?php foreach($aPost->authors as $aAuthor) { ?>
							<a href="<?=$aAuthor->post_url;?>"><?=$aAuthor->name; ?></a>
<?php } ?>
						</span>
<?php endif; ?>
					</div>
				</div>


				<hr class="article-preview-rule"></hr>

<?php  } 
}
?>

				<!-- {include "element_footer.tpl" class="hide-on-desktop"} -->
			</div>
		</div>
	</aside>