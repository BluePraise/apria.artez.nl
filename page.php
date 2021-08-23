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

get_header(); 
?>

	<main class="main-content">
		<article>
			<header class="article-header">
				<h1 class="content-title balance-text"><?php the_title(); ?></h1>
				<?php if ($page_subtitle) : ?>
					<h2 class="subtitle balance-text"><?php echo esc_html($page_subtitle); ?></h2>
				<?php endif; ?>
			</header>
			<div class="article__text">
				<?php the_content(); ?>
			</div>
		</article>
	</main>


<?php $content = get_post($id);
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

</div>

<?php get_footer(); ?>