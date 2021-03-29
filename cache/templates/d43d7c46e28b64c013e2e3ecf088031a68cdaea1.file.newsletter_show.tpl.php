<?php /* Smarty version Smarty-3.1.5, created on 2020-04-25 18:21:53
         compiled from "/data/web/apria/wp-content/themes/apria/templates/newsletter_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9095424105cbeff5db58d43-48724126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd43d7c46e28b64c013e2e3ecf088031a68cdaea1' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/newsletter_show.tpl',
      1 => 1587598551,
      2 => 'file',
    ),
    '881df4bc3b03a3377da7eb495262b8a144dc6956' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/main.tpl',
      1 => 1587759523,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9095424105cbeff5db58d43-48724126',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_5cbeff5de8d3f',
  'variables' => 
  array (
    'meta' => 0,
    'htmlClass' => 0,
    'backgroundcolor' => 0,
    'color' => 0,
    'pageTitle' => 0,
    'og' => 0,
    'size' => 0,
    'scale' => 0,
    'realm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cbeff5de8d3f')) {function content_5cbeff5de8d3f($_smarty_tpl) {?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->tpl_vars['meta']->value->language;?>
" lang="<?php echo $_smarty_tpl->tpl_vars['meta']->value->language;?>
" class="<?php if ($_COOKIE['displayMode']=='picture'){?>picture-view<?php }else{ ?>text-view<?php }?> <?php echo $_smarty_tpl->tpl_vars['htmlClass']->value;?>
<?php if ($_smarty_tpl->tpl_vars['backgroundcolor']->value){?> all-colored" style="background-color:<?php echo $_smarty_tpl->tpl_vars['backgroundcolor']->value;?>
;color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
	<title><?php echo e($_smarty_tpl->tpl_vars['pageTitle']->value);?>
</title>
<?php if ($_smarty_tpl->tpl_vars['og']->value){?>
	<meta property="og:url" content="http<?php if (isHTTPS()){?>s<?php }?>://<?php echo $_SERVER['SERVER_NAME'];?>
<?php echo $_smarty_tpl->tpl_vars['og']->value->url;?>
" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['og']->value->title;?>
" />
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@sculpturecenter">
	<meta name="twitter:title" content="<?php echo $_smarty_tpl->tpl_vars['og']->value->title;?>
" />
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['og']->value->description){?>
	<meta property="Description" content="<?php echo preg_replace('!<[^>]*?>!', ' ', e($_smarty_tpl->tpl_vars['og']->value->description));?>
" />
	<meta property="og:description" content="<?php echo preg_replace('!<[^>]*?>!', ' ', e($_smarty_tpl->tpl_vars['og']->value->description));?>
" />
	<meta name="twitter:description" content="<?php echo preg_replace('!<[^>]*?>!', ' ', e($_smarty_tpl->tpl_vars['og']->value->description));?>
" />
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['og']->value->image){?>
	<meta property="og:image" content="http<?php if (isHTTPS()){?>s<?php }?>://<?php echo $_SERVER['SERVER_NAME'];?>
/<?php echo $_smarty_tpl->tpl_vars['og']->value->image;?>
?w=2000" />
	<meta name="twitter:image" content="http<?php if (isHTTPS()){?>s<?php }?>://<?php echo $_SERVER['SERVER_NAME'];?>
/<?php echo $_smarty_tpl->tpl_vars['og']->value->image;?>
?w=2000" />
<?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(getimagesize($_smarty_tpl->tpl_vars['og']->value->image), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['size']->value[0]&&$_smarty_tpl->tpl_vars['size']->value[1]){?>
<?php $_smarty_tpl->tpl_vars['scale'] = new Smarty_variable(min(2000/$_smarty_tpl->tpl_vars['size']->value[0],2000/$_smarty_tpl->tpl_vars['size']->value[1]), null, 0);?>
	<meta property="og:image:width" content="<?php echo floor($_smarty_tpl->tpl_vars['size']->value[0]*$_smarty_tpl->tpl_vars['scale']->value);?>
" />
	<meta property="og:image:height" content="<?php echo floor($_smarty_tpl->tpl_vars['size']->value[1]*$_smarty_tpl->tpl_vars['scale']->value);?>
" />
<?php }?>
<?php }?>
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
	<!--
		Design by Catalogtree (https://www.catalogtree.net/)
		Technical realization by Systemantics (http://www.systemantics.net/)
	-->
	<?php echo wp_head();?>

</head>
<body>
<?php if (function_exists('gtm4wp_the_gtm_tag')){?>
<?php echo gtm4wp_the_gtm_tag();?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['realm']->value!="issue"&&$_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
<?php echo $_smarty_tpl->getSubTemplate ("element_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<div class="main-content subscribe-content">
	<div class="overlay-close-button js-newsletter-close-button">
		<img src="/wp-content/themes/apria/elements/icon_close_black.svg">
	</div>

	<a href="<?php echo get_home_url();?>
" class="logo" style="background-color: #">
		<img src="/wp-content/themes/apria/elements/logo.svg" alt="">
	</a>

	<article class="main-column">
		<div class="content-wrap">
			<h1 class="article__title"><?php echo $_smarty_tpl->getConfigVariable('subscribe_title');?>
</h1>

			<div class="tnp">
				<form method="post" id="newsletter" action="http://apria.artez.nl/?na=s" onsubmit="return newsletter_check(this)" class="subscribe-form">

					<input type="hidden" name="nlang" value="">
					<div class="tnp-field tnp-field-firstname input-wrap input--half">

						<input class="tnp-firstname form__input" type="text" name="nn" >
						<label class="form__label"><?php echo $_smarty_tpl->getConfigVariable('subscribe__firstname');?>
</label>
					</div>

					<div class="tnp-field tnp-field-lastname input-wrap input--half">

						<input class="tnp-lastname form__input" type="text" name="ns" >
						<label class="form__label"><?php echo $_smarty_tpl->getConfigVariable('subscribe__lastname');?>
</label>
					</div>

					<div class="tnp-field tnp-field-email input-wrap">

						<input class="tnp-email form__input" type="email" name="ne" required>
						<label class="form__label"><?php echo $_smarty_tpl->getConfigVariable('subscribe__email');?>
</label>
					</div>


					<div class="tnp-field tnp-field-button">
						<input class="tnp-submit form__submit" type="submit" value="Subscribe">
					</div>
				</form>
			</div>

		</div>
	</article>
</div>


<?php if ($_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
	<?php echo wp_footer();?>

<?php }?>
</body>
</html>
<?php }} ?>