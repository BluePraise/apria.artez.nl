<?php
/*
Template Name: Newsletter

*/



// This is the WordPress adaptor for the Systemantics boilerplate
// All access is handled by main.php (usually triggered from .htaccess)

get_header();


?>

<main class="page-view">
	<div class="overlay-close-button js-newsletter-close-button">
		<a href="<?=get_home_url() ?>" >
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/icon_close_black.svg">
		</a>
	</div>

	<article>

			<h1 class="content-title">Subscribe to our newsletter to stay up-to-date with the APRIA Journal and Platform.</h1>


				<!-- Begin APRIA Mailchimp Signup Form -->
<div id="mc_embed_signup">
    <form action="https://artez.us20.list-manage.com/subscribe/post?u=900faf96fb1c9ed5b73a7586b&amp;id=4baf0f7cd7" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
        <div id="mc_embed_signup_scroll">
		<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
		<div class="mc-field-group input-wrap input--half">
			<input type="text" value="" name="FNAME" class="form__input" id="mce-FNAME">
			<label for="mce-FNAME" class="form__label">First Name </label>
		</div>
		<div class="mc-field-group input-wrap input--half">
			<input type="text" value="" name="LNAME" class="form__input" id="mce-LNAME">
			<label for="mce-LNAME" class="form__label">Last Name </label>
		</div>
		<div class="mc-field-group input-wrap">
			<input type="email" value="" name="EMAIL" class="form__input required email" id="mce-EMAIL">
			<label for="mce-EMAIL" class="form__label">Email Address  <span class="asterisk">*</span></label>
		</div>
		<div id="mce-responses" class="clear foot">
			<div class="response" id="mce-error-response" style="display:none"></div>
			<div class="response" id="mce-success-response" style="display:none"></div>
		</div>                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		<div style="position: absolute; left: -5000px;" aria-hidden="true">
			<input type="text" name="b_900faf96fb1c9ed5b73a7586b_4baf0f7cd7" tabindex="-1" value=""></div>
			<div class="optionalParent">
				<div class="clear foot tnp-field-button">
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button form__submit">
				</div>
			</div>
		</div>
	</form>
</div><!--End mc_embed_signup-->


	</article>

</main>

<?php get_footer(); ?>


