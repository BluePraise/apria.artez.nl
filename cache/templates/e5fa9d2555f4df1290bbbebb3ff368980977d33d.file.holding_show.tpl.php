<?php /* Smarty version Smarty-3.1.5, created on 2019-05-14 10:47:08
         compiled from "/data/web/apria/wp-content/themes/apria/templates/holding_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11466614445cda7cd10b7c25-98517614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5fa9d2555f4df1290bbbebb3ff368980977d33d' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/holding_show.tpl',
      1 => 1557823627,
      2 => 'file',
    ),
    '881df4bc3b03a3377da7eb495262b8a144dc6956' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/main.tpl',
      1 => 1557822716,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11466614445cda7cd10b7c25-98517614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_5cda7cd13672f',
  'variables' => 
  array (
    'meta' => 0,
    'htmlClass' => 0,
    'pageTitle' => 0,
    'og' => 0,
    'size' => 0,
    'scale' => 0,
    'realm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda7cd13672f')) {function content_5cda7cd13672f($_smarty_tpl) {?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->tpl_vars['meta']->value->language;?>
" lang="<?php echo $_smarty_tpl->tpl_vars['meta']->value->language;?>
" class="<?php if ($_COOKIE['displayMode']=='picture'){?>picture-view<?php }else{ ?>text-view<?php }?> <?php echo $_smarty_tpl->tpl_vars['htmlClass']->value;?>
">
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
<?php if ($_smarty_tpl->tpl_vars['realm']->value!="issue"&&$_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
<?php echo $_smarty_tpl->getSubTemplate ("element_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>


	<div class="holder-content">
		<div class="holder-logo"></div>
		<div class="holding-title">
			will be launched<br>
			5 june 2019.
		</div>

		<div class="holding-subtitle">
			Subscribe to our newsletter<br>
			via <a href="mailto:contactapria@artez.nl">contactapria@artez.nl</a>
		</div>

	</div>


<?php if ($_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
	<?php echo wp_footer();?>

<?php }?>
</body>
</html>
<?php }} ?>