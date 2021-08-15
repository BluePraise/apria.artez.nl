<?php

$text = removenbsp1(get_the_content());

$footnotes = array();

$replace = function ($match) use (&$footnotes) {
	$index = count($footnotes) + 1;
	$footnotes[$index] = $match[2];

	return '<span class="footnote-anchor js-footnote" data-footnoteanchor="'. $index .'">' . $match[1] . '</span>';
};

$content = preg_replace_callback('/\[footnote (.*?)\](.*?)\[\/footnote\]/', $replace, $text);
$footnotes = $footnotes;



$issue = get_post(get_the_ID());
if($issue){
	$issue = (object)[
		'ID' => $issue->ID,
		'title' => get_the_title(),
		'subtitle' => get_field('subtitle', $issue->ID),
		'date' => $issue->post_date,
		'content' => apply_filters('the_content', $issue->post_content),
		'authors' => getAuthors($issue->ID),
		'number' => get_field('number'),
		'text_color' => get_field('text_color'),
		'background_color' => get_field('background_color'),
		'background_image' => get_field('background_image'),
		'bibliography' => get_field('bibliography'),
		'issue_authors' => get_field('issue_authors'),
	];
}

$related_posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'meta_key' => 'issue',
    'meta_value' => $issue->ID,
));

$sidebar_posts = array();
foreach($related_posts as $aPost){
	$sidebar_posts[] = extendIssuePost($aPost);
}

$allIssueAutors = array();
foreach ($sidebar_posts as $aPost) {

	foreach($aPost->authors as $aAuthor){
		if(!in_array($aAuthor->name, $allIssueAutors)){
			$allIssueAutors[$aAuthor->name] = $aAuthor;
		}
	}
}

$pageTitle = $issue->title . ' - ' . $pageTitle;

	$issue = $issue;
	$color = $issue->text_color ? $issue->text_color : '#000';
	$backgroundcolor = $issue->background_color ? $issue->background_color : '#fff';
	$background_image = $issue->background_image ? $issue->background_image['url'] : false;
	$sidebar_posts = $sidebar_posts;
	$allIssueAutors = $allIssueAutors;
	$htmlClass = 'logo-fixed';

?>

<main class="main-content issue-content" style="color: <?=$color ?>; background-color: <?=$backgroundcolor ?>">
	<div class="article__background-container hide-on-mobile">
		<div class="article__background">
			<?php if($background_image): ?>
				<img class="article__background-image animation--rotate"src="<?=$background_image ?>" alt="" />
			<?php endif; ?>
		</div>
	</div>
	<a href="<?=get_home_url(); ?>" class="overlay-close-button js-overlay-close-button">
		<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 22 22" xml:space="preserve">
			<path d="M11.7,10.9L22,21.2L21.2,22L10.9,11.7L0.7,22l-0.7-0.7l10.3-10.3L-0.1,0.7l0.7-0.7l10.3,10.3L21.2-0.1L22,0.7
			L11.7,10.9z" fill="<?=$color ?>"/>
		</svg>
	</a>

	<div class="issue-header" style="background-color: <?=$backgroundcolor ?>">
<!--
		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop" style="color: <?=$color ?>;">⠇</div>
-->
		<div class="main-column logo-fixed">
			<a href="<?=get_home_url() ?>" class="logo">
				<svg class="apria_logo" <?php if($backgroundcolor) : ?> style="background-color: <?=$backgroundcolor ?>" <?php endif; ?> ></svg>
			</a>
			<!--
			<a href="{home_url()}" class="logo" {if $backgroundcolor}style="background-color: {$backgroundcolor}"{/if}>
				<img src="{$documentroot}wp-content/themes/apria/elements/logo.svg" alt="" />
			</a>
			-->
			<div class="content-wrap hide-on-mobile">
			<div class="head__top-line hide-on-mobile" style="color: <?=$color ?>">
					<span class="article__number"><?=$issue->number; ?></span>
					<span class="article__date"><?=$issue->date ?></span>
<?php if($issue->authors) : ?>
					<span class="article__authors">
<?php foreach($issue->authors as $aAuthor): ?>
							<a href="<?=$aAuthor->post_url ?>"> <?=$aAuthor->name; ?></a>
<?php endforeach; ?>
					</span>
<?php endif; ?>
				</div>

			</div>

		</div>
<?php 

	$bg_rgb = aria_hex_rgb($backgroundcolor);

?>
		<div class="issue-header__gradient" style=";
background: -moz-linear-gradient(top,rgba(<?=$bg_rgb?>, 1) 0%, rgba(<?=$bg_rgb?>, 0) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(<?=$bg_rgb?>, 1) 60%,rgba(<?=$bg_rgb?>, 0) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(<?=$bg_rgb?>, 1) 0%,rgba(<?=$bg_rgb?>, 0); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?=$backgroundcolor; ?>', endColorstr='<?=$backgroundcolor;?>00',GradientType=0 ); /* IE6-9 */"></div>
	</div>
	<article class="main-column" style="background-color: <?=$backgroundcolor; ?>">
		<div class="article__background-mobile hide-on-desktop" <?php if ($background_image): ?> style="background-image: url(<?=$background_image?>); opacity: <?=$opacity ?>" <?php endif; ?>></div>
		<div class="content-wrap">
			<div class="article__head">

<div class="head__top-line hide-on-desktop" style="color: <?=$color ?>">
					<span class="article__number"><?=$issue->number; ?></span>
					<span class="article__date"><?=$issue->date ?></span>
<?php if($issue->authors) : ?>
					<span class="article__authors">
<?php foreach($issue->authors as $aAuthor): ?>
							<a href="<?=$aAuthor->post_url ?>"> <?=$aAuthor->name; ?></a>
<?php endforeach; ?>
					</span>
<?php endif; ?>
				</div>

				<h1 class="article__title balance-text"><?=$issue->title ?></h1>
<?php if ($issue->subtitle) : ?>
				<h2 class="article__subtitle balance-text"><?=$issue->subtitle;?></h2>
<?php endif; ?>
			</div>

<?php if($issue->issue_authors) : ?>
			<div class="issue__authors">
				<?= $issue->issue_authors; ?>
			</div>
<?php elseif ($allIssueAutors) : ?>
			<div class="issue__authors">
				With contributions from
<?php foreach($allIssueAutors as $aAuthor) : ?>
				<?=$aAuthor->name ;?>
<?php endforeach; ?>
			</div>
<?php endif; ?>

			<div class="article__text text--large">
				<?=$issue->content ?>
			</div>

<!-- {include "element_article_footer.tpl" authors=$issue->authors footnotes=$issue->footnotes bibliography=$issue->bibliography} -->
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

<?php get_footer('', array("color"=> $color)); ?>


		</div>
	</article>
<?php get_sidebar("", array("sidebar_posts"=> $sidebar_posts, "sidebar_issue" => false)); ?>


</main>

