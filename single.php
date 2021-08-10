<?php

get_header();

	$authors = get_coauthors($aIssue->ID);
	if(get_the_tags()){
		$tags = get_the_tags();
		$article_tags = array_map(function ($aTag) {
			return (object)[
				'id' => $aTag->term_id,
				'name' => $aTag->name,
				'url' => get_tag_link($aTag),
			];
		}, $tags);
		//$article->tagIds = array_map(function ($aTag) { return $aTag->term_id; }, $tags);
	}



	$text = removenbsp1(get_the_content());

	$footnotes = array();

	$replace = function ($match) use (&$footnotes) {
		$index = count($footnotes) + 1;
		$footnotes[$index] = $match[2];

		return '<span class="footnote-anchor js-footnote" data-footnoteanchor="'. $index .'">' . $match[1] . '</span>';
	};

	$content = preg_replace_callback('/\[footnote (.*?)\](.*?)\[\/footnote\]/', $replace, $text);
	$footnotes = $footnotes;


?>


<main>
	<article>
		<div class="content-wrap">
			<div class="article__head">
				<div class="head__top-line" >
					<span class="article__date"><?=get_the_date('d-M-Y'); ?></span>
					<span class="article__authors">
			<?php		foreach ($authors as $aAuthor) { ?>
			<a href="<?=get_site_url().'/author/'.$aAuthor->user_nicename.'/'; ?>">
				<?=$aAuthor->display_name; ?> </a>
	
	<?php } ?>
						</span>

<?php 
if(get_field('issue')): 
	//var_dump(get_field('issue'));
	$article_issue = get_field('issue');
	
	?>
					<span class="article__source">
						Published in<br />
						<?=$article_issue->post_title; ?>
					</span>
<?php endif; ?>

<?php if(get_field('doi')): ?>
					<span class="article__issue">
						<a href="https://doi.org/{$article->doi|trim}">
							 <?=get_field('doi'); ?>
						</a>
					</span>
<?php endif; ?>
				</div>
				<h1 class="content-title balance-text"><?php the_title(); ?></h1>
<?php if(get_field('subtitle')): ?>
				<h2 class="article__subtitle balance-text"><?=get_field('subtitle'); ?></h2>
<?php endif; ?>
				<div class="head__bottom-line">



				
<?php if($article_tags): $i = 0; ?>
					<span class="article__tags">
<?php foreach($article_tags as $aTag) { ?>
						<a href="<?=$aTag->url; ?>"><?=$aTag->name; ?></a> 
						<?php if(++$i !== count($article_tags)) {
    echo "/";
  } ?>
<?php } ?>
					</span>
<?php endif; ?>
				
				</div>
			</div>
			<div class="article__text{if $article->paragraph_layout == 'indents'} article__text-indents{/if}">
				<?=$content; ?>
			</div>
<?php /* get_footer('article');*/ ?>
<!-- {include "element_article_footer.tpl" authors=$article->authors footnotes=$article->footnotes bibliography=$article->bibliography} -->
<?php 

$authors = getAuthors(get_the_ID());
if($authors):
?>

			<div class="article__bios">
<?php foreach($authors as $aAuthor) { ?>
				<div class="author-bio">
					<a href="<?=$aAuthor->posts_url; ?>" class="bio__name"><?=$aAuthor->name; ?></a>
					<div class="bio__text">
						<?=$aAuthor->biography; ?>
					</div>
				</div>
<?php } ?>
			</div>
<?php endif; 


if ($footnotes):  ?>
			<div class="article__footnotes">
				<div class="footnotes__headline">References</div>
<?php foreach($footnotes as $aFootnote) { ?>
				<div class="footnote">
					<span class="footnote-up icon js-footnote-up" data-footnotetext="{$aFootnote@iteration}">↑</span>
					<p><?=$aFootnote; ?></p>
				</div>
<?php } ?>
			</div>
<?php endif; ?>

<?php if(get_field('bibliography')): ?>
			<div class="article__bibliography">
				<!-- {$bibliography|shift_headlines:2} -->
				<?=get_field('bibliography'); ?>
			</div>
<?php endif; ?>

<?php get_footer() ?>

		</div>
	</article>
	<?php get_sidebar("", array("sidebar_posts"=> $sidebar_posts, "sidebar_issue" => false)); ?>

</main>


