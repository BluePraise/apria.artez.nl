{extends file="main.tpl"}
{block name="content"}
<div class="main-content subscribe-content">
	<div class="overlay-close-button js-newsletter-close-button">
		<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
	</div>

	<a href="{get_home_url()}" class="logo" style="background-color: #">
		<img src="/wp-content/themes/apria/elements/logo.svg" alt="">
	</a>

	<article class="main-column">
		<div class="content-wrap">
			<h1 class="article__title">{#subscribe_title#}</h1>

			<div class="tnp">
				<form method="post" id="newsletter" action="http://apria.artez.nl/?na=s" onsubmit="return newsletter_check(this)" class="subscribe-form">

					<input type="hidden" name="nlang" value="">
					<div class="tnp-field tnp-field-firstname input-wrap input--half">

						<input class="tnp-firstname form__input" type="text" name="nn" >
						<label class="form__label">{#subscribe__firstname#}</label>
					</div>

					<div class="tnp-field tnp-field-lastname input-wrap input--half">

						<input class="tnp-lastname form__input" type="text" name="ns" >
						<label class="form__label">{#subscribe__lastname#}</label>
					</div>

					<div class="tnp-field tnp-field-email input-wrap">

						<input class="tnp-email form__input" type="email" name="ne" required>
						<label class="form__label">{#subscribe__email#}</label>
					</div>


					<div class="tnp-field tnp-field-button">
						<input class="tnp-submit form__submit" type="submit" value="Subscribe">
					</div>
				</form>
			</div>

		</div>
	</article>
</div>

{/block}
