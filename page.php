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

							?>
						</div>
						<!-- {include "element_footer.tpl" class="hide-on-desktop"} -->
					</div>
				</div>
			</aside>
		<?php endif; ?>
		<!--
		{else}
		{include "element_sidebar.tpl"}
		{/if}
		-->
	</div>

<?php
get_footer();
