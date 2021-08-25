<?php
/*
Template Name: Newsletter
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

get_header();


?>

<div class="main-content subscribe-content">
	<div class="overlay-close-button js-newsletter-close-button">
		<a href="<?=get_home_url() ?>" >
			<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
		</a>
	</div>

	<article class="main-column">
		<div class="content-wrap">
			<h1 class="article__title">Subscribe to our newsletter to stay up-to-date with the APRIA Journal and Platform.</h1>

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

		</div>
	</article>
</div>




