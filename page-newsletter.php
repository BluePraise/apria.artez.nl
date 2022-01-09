<?php
/*
Template Name: Newsletter

*/



get_header();


?>

<main class="page-view">
	<div class="overlay-close-button js-newsletter-close-button">
		<a href="<?=get_home_url() ?>" >
			<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
		</a>
	</div>

	<article>

		<h1 class="content-title">Subscribe to our newsletter to stay up-to-date with the APRIA Journal and Platform.</h1>

		<?php echo do_shortcode('[mc4wp_form id="4218"]'); ?>

	</article>

</main>

<?php get_footer(); ?>


