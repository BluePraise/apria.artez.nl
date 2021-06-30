<?php

/*
	APRIA
	Copyright (C) 2018 by Systemantics, Bureau for Informatics

	Systemantics GmbH
	Bleichstr. 11
	41747 Viersen
	GERMANY

	Web:    www.systemantics.net
	Email:  hello@systemantics.net

	Permission granted to use the files associated with this
	website only on your webserver.

	Changes to these files are PROHIBITED due to license restrictions.
*/



// This is the WordPress adaptor for the Systemantics boilerplate
// All access is handled by main.php (usually triggered from .htaccess)

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


function removenbsp1($s) {
	return str_replace(array('&nbsp;'), ' ', $s);
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


<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">
			<div class="article__head">
				<div class="head__top-line" {if $color} style="color:{$color}"{/if} >
					<span class="article__date"><?=get_the_date('m-d-Y'); ?></span>
					<span class="article__authors">
			<?php		foreach ($authors as $aAuthor) { ?>
			<a href="<?=get_site_url().'/author/'.$aAuthor->user_nicename.'/'; ?>">
				<?=$aAuthor->display_name; ?> </a>
	
	<?php } ?>
						</span>
<?php if(get_field('doi')): ?>
					<span class="article__issue">
						<a href="https://doi.org/{$article->doi|trim}">
							{#current_doi#}: <?=get_field('doi'); ?>
						</a>
					</span>
<?php endif; ?>
				</div>
				<h1 class="article__title balance-text"><?php the_title(); ?></h1>
<?php if(get_field('subtitle')): ?>
				<h2 class="article__subtitle balance-text"><?=get_field('subtitle'); ?></h2>
<?php endif; ?>
				<div class="head__bottom-line">
<?php echo get_field('issue'); if(get_field('issue')): 
	$article_issue = extendIssue(get_field('issue'));
	//var_dump($article_issue);
	?>
					<span class="article__source"{if $color} style="color:{$color}"{/if}>
						Published in<br />
						<a href="">Issue </a>
					</span>
<?php endif; ?>
				
<?php if($article_tags): $i = 0; ?>
					<span class="article__tags"{if $color} style="color:{$color}"{/if}>
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
	<?php get_sidebar("home"); ?>

</div>


