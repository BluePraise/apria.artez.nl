<?php
/*
Template Name: Open-Call
*/
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


wp_head();

$content = get_post(get_the_ID());
if($content){
	$page = (object)[
		'title' => get_the_title(),
		'subtitle' => get_field('subtitle', $id),
		'content' => apply_filters('the_content', $content->post_content),
		'paragraph_layout' => get_field('paragraph_layout'),
	];
}
?>


<div class="main-content subscribe-content">
	<div class="overlay-close-button">
		<a href="<?=get_home_url(); ?>" class="js-opencall-close-button">
			<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
		</a>
	</div>

	<a href="<?=get_home_url() ?>" class="logo" style="background-color: #">
		<img src="/wp-content/themes/apria/elements/logo.svg" alt="">
	</a>

	<article class="main-column">
		<div class="content-wrap">
			<div class="article__head">
				<h1 class="article__title"> <?=$page->title; ?></h1>
<?php if($page->subtitle): ?>
				<h2 class="article__subtitle"><?=$page->subtitle; ?></h2>
<?php endif; ?>
			</div>

			<div class="article__text<?php if($page->paragraph_layout == 'indents'){ ?>article__text-indents <?php } ?> article__text--open-call">
				<?=$page->content; ?>
			</div>
		</div>
	</article>
</div>

