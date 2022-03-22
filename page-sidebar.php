<?php
/*
Template Name: Page with Sidebar
*/


$content = get_post($id);
if($content){
	$page = (object)[
		'content' => apply_filters('the_content', $content->post_content),
	];
}

get_header();?>
<main class="content-with-sidebar page-view">
        <article>
			<div class="content-wrap">
				<h1 class="content-title balance-text">
					<?php the_title(); ?>
				</h1>
                <?php if(get_field('subtitle')) : ?>
			        <h2 class="subtitle balance-text"><?=get_field('subtitle'); ?></h2>
                <?php endif; ?>

				<div class="article__text">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
        <?php if ( is_active_sidebar("rp-right-sidebar")) : ?>
            <aside><?php dynamic_sidebar("rp-right-sidebar"); ?></aside>
        <?php endif; ?>
</main>
<?php get_footer(); ?>
