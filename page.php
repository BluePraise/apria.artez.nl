<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 **/

// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_subtitle = get_field("subtitle");
$page_sidebar_text = get_field("sidebar_text");

get_header(); ?>

	<div class="main-content">
		<article class="main-column">
			<div class="content-wrap">
				<h1 class="article__title balance-text">
					<?php the_title(); ?>
				</h1>
				<?php if ($page_subtitle) : ?>
					<h2 class="article__subtitle balance-text">
						<?php echo esc_html($page_subtitle); ?>
					</h2>
				<?php endif; ?>

				<div class="article__text">
					<?php the_content(); ?>
				</div>
				<!-- {include "element_footer.tpl" class="hide-on-mobile"} -->
			</div>
		</article>

		<?php

		if ($page_sidebar_text) : ?>
			<aside class="sidebar-column affix-placeholder">
				<div class="affix-content js-affix-scrolling">
					<div class="content-wrap">
						<div class="sidebar__text">
							<?php

							dynamic_sidebar("rp-right-sidebar");



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
				<?php get_footer(); ?>
			</div>
		</div>
	</aside>
<?php 
	else :
		get_sidebar("home");
	endif;
?>
</div>