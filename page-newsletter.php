<?php
/*
Template Name: Newsletter

*/



// This is the WordPress adaptor for the Systemantics boilerplate
// All access is handled by main.php (usually triggered from .htaccess)

get_header();


?>

<main class="page-view">
	<!-- <div class="overlay-close-button js-newsletter-close-button">
		<a href="<?=get_home_url() ?>" >
			<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
		</a>
	</div> -->

	<article>
	
			<h1 class="content-title">Subscribe to our newsletter to stay up-to-date with the APRIA Journal and Platform.</h1>

			<div class="tnp">
				<form method="post" id="newsletter" action="http://apriawp1.local/?na=s" onsubmit="return newsletter_check(this)" class="subscribe-form">

					<input type="hidden" name="nlang" value="">
					<div class="tnp-field tnp-field-firstname input-wrap input--half">

						<input class="tnp-firstname form__input" type="text" name="nn" >
						<label class="form__label">First name</label>
					</div>

					<div class="tnp-field tnp-field-lastname input-wrap input--half">

						<input class="tnp-lastname form__input" type="text" name="ns" >
						<label class="form__label">Last name</label>
					</div>

					<div class="tnp-field tnp-field-email input-wrap">

						<input class="tnp-email form__input" type="email" name="ne" required>
						<label class="form__label">Email</label>
					</div>


					<div class="tnp-field tnp-field-button">
						<input class="tnp-submit form__submit" type="submit" value="Subscribe">
					</div>
				</form>
			</div>

		
	</article>
	
</main>

<?php get_footer(); ?>


