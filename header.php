<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$meta->language}" lang="{$meta->language}" class="show-picture-text-toogle text-view" >
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
	<title><?php wp_title(); ?></title>

	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
	<!--
		Design by Catalogtree (https://www.catalogtree.net/)
		Technical realization by Systemantics (http://www.systemantics.net/)
	-->
	<?php wp_head(); ?>
</head>
<body>
<?php $path = ABSPATH ?>
  <header>
  	<div class="main-column">
  		<div class="menu">
        <ul class="menu-items">
      <?php
      wp_nav_menu(
          array(
            'menu' => "Main Menu",
            'container'  => '',
            'items_wrap' => '%3$s',

          )
        );
        ?>
        <li class="menu-item">
          <form action="<?=get_home_url(); ?>" method="get" class="search-form">
            <label class="form__label form__label--clickable">Search</label>
            <input type="text" name="s" class="form__input" value="">
            <button type="submit" class="form__submit icon">→</button>
            <div class="form-border"></div>
          </form>
        </li>
        <li class="menu-item menu-item__spaced hide-on-desktop">
          <a href="https://periodical.networkcultures.org/">PARAZINE</a>
        </li>
      </ul>

  			<div class="mobile-menu-close-button js-mobile-menu-close-button hide-on-desktop">
  				<img src="<?=$path; ?>wp-content/themes/apria/elements/icon_close_highlight.svg">
  			</div>


  		<a href="{$opencall}" class="mobile__open-call js-open-as-overlay"></a>

  		</div>

  		<div class="site-title hide-on-desktop clickable-block" data-href="<?=get_home_url();?>">
  		ArtEZ Platform<br />for Research<br />Interventions<br />of the Arts
  		</div>

  		<div class="logo-container">
  			<a href="<?=get_home_url();?>" class="logo" style="background-color: #000000">
  				<svg class="apria_logo" style="background-color: #000"></svg>
  			</a>

  			<!-- <a href="<?=get_home_url();?>" class="logo"style="background-color: #000">
  				<img src="<?=$path; ?>wp-content/themes/apria/elements/logo.svg" alt="" />
  			</a> -->

  		</div>

  		<div class="additional-links hide-on-mobile">
  			<ul class="additional-links__list">
  				<li class="additional-links__item">
  					<a href="https://periodical.networkcultures.org/">PARAZINE</a>
  				</li>
  			</li>
  		</div>

  		<ul class="socialmedia-items">
  			<li class="socialmedia-item">
  				<a href="https://www.facebook.com/APRIAjournalandplatform/">
            <img src="<?=get_stylesheet_directory_uri(); ?>/elements/icon_facebook.svg" />
  				</a>
  			</li>

  			<li class="socialmedia-item">
  				<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">
  			  <img src="<?=get_stylesheet_directory_uri(); ?>/elements/icon_youtube.svg" />
        </a>
  			</li>

  			<li class="socialmedia-item">
  				<a href="https://www.instagram.com/apria_journal_and_platform/">
            <img src="<?=get_stylesheet_directory_uri(); ?>/elements/icon_instagram.svg" />
          </a>
  			</li>
  		</ul>

  		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop">⠇</div>
  	</div>

  	<div class="sidebar-column">
  <?php if($newsPosts) { ?>
  		<div class="site-title site-title--news clickable-block" data-href="<?php bloginfo('url'); ?>">
  			<img src="<?=$path; ?>wp-content/themes/apria/elements/news.svg" width="100" alt="News">
  		</div>
 <?php } else { ?>
  		<div class="site-title clickable-block" data-href="<?php bloginfo('url'); ?>">
  			<?php bloginfo( 'name' ); ?>
  		</div>
  <?php } ?>

  <?php if($showOpenCallButton) { ?>
  		<a href="{$opencall}" class="sidebar__open-call js-open-as-overlay"></a>
  <?php } ?>

<?php if(is_front_page() || is_single()) : ?>
  		<div class="picture-text-toggle js-picture-text-toggle">
  			<div class="toggle-outer">
  				<div class="toggle-inner"></div>
  			</div>
  			<div class="toogle-tooltip">
  				<span class="switch-to-picture">Switch to image view</span>
  				<span class="switch-to-text">Switch to text view</span>
  			</div>
  		</div>
<?php endif; ?>		  
  	</div>


</header>
