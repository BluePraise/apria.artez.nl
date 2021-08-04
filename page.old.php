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



$content = get_post($id);
if($content){
	$page = (object)[
		'title' => get_the_title(),
		'subtitle' => get_field('subtitle', $id),
		'content' => apply_filters('the_content', $content->post_content),
		'sidebartext' => get_field('sidebar_text', $id),
	];
}

$postDefaultSidebarText = get_post(295);
$defaultSidebarText = apply_filters('the_content', $postDefaultSidebarText->post_content);

$pageTitle = $page->title . ' - ' . $pageTitle;

?>
<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">
			<h1 class="article__title balance-text"><?php the_title(); ?></h1>
<?php if(get_field('subtitle')) : ?>
			<h2 class="article__subtitle balance-text"><?=get_field('subtitle'); ?></h2>
<?php endif; ?>

			<div class="article__text">
				<?php the_content(); ?>
			</div>
			<?php get_footer(); ?>
		</div>
	</article>

<?php if ($defaultSidebarText || get_field('sidebar_text')) : ?>
	<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling">
			<div class="content-wrap">
				<div class="sidebar__text">
<?php if(get_field('sidebar_text')) :
			echo get_field('sidebar_text');
elseif ($defaultSidebarText):
					echo $defaultSidebarText;
endif; ?>
				</div>
				<?php get_footer("", array("class" => "hide-on-desktop")); ?>
			</div>
		</div>
	</aside>
<?php 
	
	endif;
?>
</div>