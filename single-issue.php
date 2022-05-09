<?php
get_template_part('head');

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
		'ID' 				=> $issue->ID,
		'title' 			=> get_the_title(),
		'subtitle' 			=> get_field('subtitle', $issue->ID),
		'date' 				=> $issue->post_date,
		'content' 			=> apply_filters('the_content', $issue->post_content),
		'authors' 			=> getAuthors($issue->ID),
		'number' 			=> get_field('number'),
		'text_color' 		=> get_field('text_color'),
		'background_color' 	=> get_field('background_color'),
		'background_image' 	=> get_field('background_image'),
		'bibliography' 		=> get_field('bibliography'),
		'issue_authors' 	=> get_field('issue_authors'),
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
	$color = $issue->text_color ? $issue->text_color : 'var(--text-color-1)';
	$backgroundcolor = $issue->background_color ? $issue->background_color : 'var(--text-color-1)';
	$background_image = $issue->background_image ? $issue->background_image : false;
	$sidebar_posts = $sidebar_posts;
	$allIssueAutors = $allIssueAutors;
	$htmlClass = 'logo-fixed';
?>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>

<main class="main-content issue-content" style="color: <?=$color ?>; background-color: <?=$backgroundcolor ?>">
	<?php if($background_image): ?>
	<div class="article__background-container hide-on-mobile">
		<div class="article__background">
				<img class="article__background-image animation--rotate"src="<?=$background_image ?>" alt="" />
			</div>
		</div>
	<?php endif; ?>
	<a href="<?=get_home_url(); ?>" class="overlay-close-button js-overlay-close-button">
		<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 22 22" xml:space="preserve">
			<path d="M11.7,10.9L22,21.2L21.2,22L10.9,11.7L0.7,22l-0.7-0.7l10.3-10.3L-0.1,0.7l0.7-0.7l10.3,10.3L21.2-0.1L22,0.7
			L11.7,10.9z" fill="<?=$color ?>"/>
		</svg>
	</a>

	<div class="issue-header" style="background-color: <?=$backgroundcolor ?>">
	<div class="main-column logo-fixed">
		<a href="<?=get_home_url() ?>" class="logo">
			<svg class="apria_logo" <?php if($backgroundcolor): ?> style="background-color: <?=$backgroundcolor ?>" <?php endif; ?> ></svg>
		</a>

	</div> <!-- .main-column.logo-fixed -->
	<div class="content-wrap hide-on-mobile meta-info">
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
	<?php  $bg_rgb = aria_hex_rgb($backgroundcolor); ?>
	<div class="issue-header__gradient" style=";
		background: -moz-linear-gradient(top,rgba(<?=$bg_rgb?>, 1) 0%, rgba(<?=$bg_rgb?>, 0) 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, rgba(<?=$bg_rgb?>, 1) 60%,rgba(<?=$bg_rgb?>, 0) 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, rgba(<?=$bg_rgb?>, 1) 0%,rgba(<?=$bg_rgb?>, 0); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?=$backgroundcolor; ?>', endColorstr='<?=$backgroundcolor;?>00',GradientType=0 ); /* IE6-9 */"></div>
	</div>
	<div class="content-with-sidebar page-view">
		<?php if(get_field('wide_image')): ?>
			<figure class="full-width-banner" data-image-url="<?php the_field('wide_image'); ?>">
				<img class="issue-banner-image" src="<?php the_field('wide_image'); ?>" alt="<?=$issue->title ?>">
			</figure>
		<?php endif; ?>
		<article class="main-column <?php if(get_field('wide_image')): ?>fix-margin-top<?php endif; ?>" style="background-color: <?=$backgroundcolor; ?>">
			<div class="article__background-mobile hide-on-desktop" <?php if ($background_image): ?> style="background-image: url(<?=$background_image?>); opacity: <?=$opacity ?>" <?php endif; ?>></div>
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
					</div><!-- .head__top-line -->


						<h1 class="article__title balance-text"><?=$issue->title ?></h1>
						<?php if ($issue->subtitle) : ?>
							<h2 class="article__subtitle balance-text"><?=$issue->subtitle;?></h2>
						<?php endif; ?>
				</div><!-- .article__head -->

				<?php if($issue->issue_authors) : ?>
					<div class="issue__authors"><?= $issue->issue_authors; ?></div>
				<?php elseif ($allIssueAutors) : ?>
					<div class="issue__authors">
						<span>With contributions from</span>
						<?php foreach($allIssueAutors as $aAuthor) : ?>
							<?=$aAuthor->name ;?>
						<?php endforeach; ?>
					</div> <!-- .issue__authors -->
				<?php endif; ?>

				<?php //List of Related Articles

							$related_issue_article = get_field('related_issue_article'); if( $related_issue_article ): ?>
							<ul class="issue__related_posts">
								<?php foreach( $related_issue_article as $post ):

									// Setup this post for WP functions (variable must be named $post).
									setup_postdata($post); ?>
									<li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
							<?php
							// Reset the global post object so that the rest of the page works correctly.
							wp_reset_postdata(); ?>
					<?php endif; ?>

				<div class="article__text text--large">
					<?php echo apply_filters('the_content', $content) ; ?>
				</div>

				<?php
					$authors = getAuthors(get_the_ID());
					if($authors):
				?>
				<div class="article__bios">
					<?php foreach($authors as $aAuthor) : ?>
						<div class="author-bio">
							<a href="<?=$aAuthor->posts_url; ?>" class="bio__name"><?=$aAuthor->name; ?></a>
							<div class="bio__text"><?=$aAuthor->biography; ?></div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php
					endif; // end if $authors
					if ($footnotes):
				?>
				<div class="article__footnotes">
					<details>
						<summary class="footnotes__headline">References</summary>
						<?php foreach($footnotes as $key => $aFootnote) : ?>
							<div class="footnote">
								<span class="footnote-up icon js-footnote-up" data-footnotetext="<?= $key ?>">↑ <?= $key ?></span>
								<p><?=$aFootnote; ?></p>
							</div>
						<?php endforeach; ?>
						</details>
					</div><!-- article__footnotes -->
				<?php endif; // end if $footnotes?>

				<?php if(get_field('bibliography')): ?>
					<div class="article__bibliography">
						<!-- {$bibliography|shift_headlines:2} -->
						<?=get_field('bibliography'); ?>
					</div>
				<?php endif; ?>

		</article>
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

	<aside class="sidebar-column affix-placeholder <?php if(get_field('wide_image')): ?>fix-margin-top<?php endif; ?>">
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

	</div>

</main>

<?php get_footer();?>
