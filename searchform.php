<form action="<?php echo get_home_url(); ?>" method="get" class="search-form">
	<label for="search" class="form__label form__label--clickable">
		<?php _e("Search", "apria"); ?>
	</label>
	<input type="text" name="s" class="form__input" value="" id="search">
	<button type="submit" class="form__submit icon">→</button>
	<div class="form-border"></div>
</form>
