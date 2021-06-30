<?php
/*
Template Name: Page Home
*/
/*
	APRIA
	Copyright (C) 2018 by Systemantics, Bureau for Informatics
*/
// define('WORDPRESS', true);
//
//
// // Set request variables accordingly
// $_GET = array(
// 	'realm' => 'home',
// 	'action' => 'show',
// );
//
// // Redirect request to main.php controller
// require __DIR__ . '/main.php';

get_header();
?>

<div class="main-content">
	<article class="main-column">
		<div class="home-intro">
			<p><?=get_field("intro_text"); ?></p>
		</div>
<?php $getAllIssues = get_posts(array(
	'post_type' => 'issue',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'number',
    'order' => 'DESC',
));
foreach ($getAllIssues as $aIssue) {
//var_dump($aIssue);
?>
			<div class="home-issue clickable-block" data-href="<?=get_permalink($aIssue->ID)?>">
				<div class="article__preview-background"<?php
// var_dump(get_field('background_image', $aIssue->ID));
				if($aIssue->background_image) { ?> style="background-image: url(<?=get_field('background_image', $aIssue->ID)['url']; ?>);background-color:<?=get_field('background_color', $aIssue->ID); ?>;color:<?=get_field('text_color', $aIssue->ID); } ?>">
					<div class="article__issue article__issue--home balance-text">
						<!-- {$aIssue->number|formatIssueNumber|string_format:#issue_number#} -->

						<?php echo "#".get_field("number", $aIssue->ID); ?>
					</div>
					<a href="<?=get_permalink($aIssue->ID)?>" class="article__title balance-text" style="color:inherit"><?=$aIssue->post_title; ?></a>
<?php if($aIssue->subtitle) { ?>
					<div class="article__subtitle balance-text"><?php echo get_field("subtitle", $aIssue->ID); ?></div>
<?php } ?>
				</div>
				<div class="article__info">
					<div class="article__meta">
						<?php echo "#".get_field("number", $aIssue->ID); ?><br />
						<?php echo   date('F Y', strtotime($aIssue->post_date)); ?>
						<br />
<?php
$authors = get_coauthors($aIssue->ID);

foreach ($authors as $aAuthor) { ?>
		<a href="<?=get_site_url().'/author/'.$aAuthor->user_nicename.'/'; ?>">
			<?=$aAuthor->display_name; ?> </a>

<?php }


//var_dump($authors);

if(get_field("download_pdf", $aIssue->ID)) {
	$pdf = get_field("download_pdf", $aIssue->ID);
?>
						<br><a class="download_pdf" href="<?=$pdf; ?>">Download Print Issue</a>
<?php } ?>
					</div>
					<div class="article__preview-text">
						<?php if(get_field("preview_text", $aIssue->ID)) {
							echo get_field("preview_text", $aIssue->ID);
						}
						else {
							echo wp_trim_words( apply_filters('the_content', $aIssue->post_content), 50 );
						}

						?>

					</div>
				</div>
			</div>

<!-- {if $aIssue@first && count($allIssues) > 1}
			<div class="load-more-issues js-load-more hide-on-desktop">{#prev_issue#}</div>
{/if} -->
<?php }
	get_footer();
?>


	</article>

<?php get_sidebar("home"); ?>
<!-- {include "element_sidebar.tpl" sidebar_posts=$currentIssuePosts} -->

</div>


<?php
