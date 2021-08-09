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
get_header(); ?>
<main>
	<article>
		<header>
			<h1 class="content-title"><?php the_title(); ?></h1>
			<h2 class="subtitle"><?php the_field('subtitle'); ?></h2>
			<?php
				$tag_list = get_the_tag_list( '<ul class="tag-list"><li>', '</li><li>', '</li></ul>' );

				if ( $tag_list && ! is_wp_error( $tag_list ) ):
					echo $tag_list;
				endif;
			?>
		</header>
	</article>
</main>
<?php get_footer(); ?>
