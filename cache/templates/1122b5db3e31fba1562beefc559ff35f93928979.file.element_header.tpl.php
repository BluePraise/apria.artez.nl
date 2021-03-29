<?php /* Smarty version Smarty-3.1.5, created on 2021-03-29 19:00:47
         compiled from "/Users/mchetrit/Dropbox/Work/° APRIA/APRIA_WP/wp-content/themes/apria/templates/element_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:596459612606207bfc197d6-17681143%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1122b5db3e31fba1562beefc559ff35f93928979' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/° APRIA/APRIA_WP/wp-content/themes/apria/templates/element_header.tpl',
      1 => 1594792200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '596459612606207bfc197d6-17681143',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainMenu' => 0,
    'color' => 0,
    'aItem' => 0,
    'newsletter' => 0,
    'currentIssue' => 0,
    'documentroot' => 0,
    'showOpenCallButton' => 0,
    'opencall' => 0,
    'homeUrl' => 0,
    'xcolor' => 0,
    'backgroundcolor' => 0,
    'ycolor' => 0,
    'newsPosts' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_606207bfce0b3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_606207bfce0b3')) {function content_606207bfce0b3($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/Users/mchetrit/Dropbox/Work/° APRIA/APRIA_WP/wp-content/themes/apria/libs/plugins/modifier.replace.php';
?><header>
	<div class="main-column">
		<div class="menu">
			<ul class="menu-items">
<?php  $_smarty_tpl->tpl_vars['aItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mainMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aItem']->key => $_smarty_tpl->tpl_vars['aItem']->value){
$_smarty_tpl->tpl_vars['aItem']->_loop = true;
?>
				<li class="menu-item"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['aItem']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['aItem']->value->title;?>
</a></li>
<?php } ?>
				<li class="menu-item"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['newsletter']->value;?>
" class="js-open-as-overlay"><?php echo $_smarty_tpl->getConfigVariable('menu_subscribe');?>
</a></li>
<?php if ($_smarty_tpl->tpl_vars['currentIssue']->value){?>
				<li class="menu-item"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>>
					<a href="<?php echo $_smarty_tpl->tpl_vars['currentIssue']->value->url;?>
">
						<?php echo $_smarty_tpl->getConfigVariable('current_issue');?>

					</a>
				</li>
<?php }?>
				<li class="menu-item"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>>
					<form action="<?php echo get_home_url();?>
" method="get" class="search-form">
						<label class="form__label form__label--clickable"><?php echo $_smarty_tpl->getConfigVariable('search');?>
</label>
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
				<img src="<?php echo $_smarty_tpl->tpl_vars['documentroot']->value;?>
wp-content/themes/apria/elements/icon_close_highlight.svg">
			</div>

<?php if ($_smarty_tpl->tpl_vars['showOpenCallButton']->value){?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['opencall']->value;?>
" class="mobile__open-call js-open-as-overlay"></a>
<?php }?>
		</div>

		<div class="site-title hide-on-desktop clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
">
			<?php echo $_smarty_tpl->getConfigVariable('side_title');?>

		</div>

		<div class="logo-container">
			<a href="<?php echo home_url();?>
" class="logo" style="background-color: #000000">
				<svg class="apria_logo"<?php if ($_smarty_tpl->tpl_vars['color']->value!='ffffff'){?> style="background-color: #<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>></svg>
			</a>
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
				<a href="https://www.facebook.com/APRIAjournalandplatform/"><?php $_smarty_tpl->_capture_stack[] = array("svg", null, null); ob_start(); ?>
					<?php echo $_smarty_tpl->getSubTemplate ("../elements/icon_facebook.svg", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['xcolor'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['color']->value)===null||$tmp==='' ? "#ff2020" : $tmp), null, 0);?><?php echo smarty_modifier_replace(trim(Smarty::$_smarty_vars['capture']['svg']),"#ff2020",$_smarty_tpl->tpl_vars['xcolor']->value);?>
</a>
			</li>

			<li class="socialmedia-item">
				<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw"><?php $_smarty_tpl->_capture_stack[] = array("svg", null, null); ob_start(); ?>
					<?php echo $_smarty_tpl->getSubTemplate ("../elements/icon_youtube.svg", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['xcolor'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['color']->value)===null||$tmp==='' ? "#ff2020" : $tmp), null, 0);?><?php echo smarty_modifier_replace(trim(Smarty::$_smarty_vars['capture']['svg']),"#ff2020",$_smarty_tpl->tpl_vars['xcolor']->value);?>
</a>
			</li>

			<li class="socialmedia-item">
				<a href="https://www.instagram.com/apria_journal_and_platform/"><?php $_smarty_tpl->_capture_stack[] = array("svg", null, null); ob_start(); ?>
					<?php echo $_smarty_tpl->getSubTemplate ("../elements/icon_instagram.svg", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['xcolor'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['color']->value)===null||$tmp==='' ? "#ff2020" : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['ycolor'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['backgroundcolor']->value)===null||$tmp==='' ? "#ffffff" : $tmp), null, 0);?><?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(trim(Smarty::$_smarty_vars['capture']['svg']),"#ff2020",'--fgcolor--'),"#ffffff",'--bgcolor--'),"--fgcolor--",$_smarty_tpl->tpl_vars['xcolor']->value),"--bgcolor--",$_smarty_tpl->tpl_vars['ycolor']->value);?>
</a>
			</li>
		</ul>

		<div class="mobile-menu-button js-mobile-menu-button icon hide-on-desktop">⠇</div>
	</div>

	<div class="sidebar-column">
<?php if ($_smarty_tpl->tpl_vars['newsPosts']->value){?>
		<div class="site-title site-title--news clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
">
			<img src="<?php echo $_smarty_tpl->tpl_vars['documentroot']->value;?>
wp-content/themes/apria/elements/news.svg" width="100" alt="News">
		</div>
<?php }else{ ?>
		<div class="site-title clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
">
			<?php echo $_smarty_tpl->getConfigVariable('side_title');?>

		</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['showOpenCallButton']->value){?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['opencall']->value;?>
" class="sidebar__open-call js-open-as-overlay"></a>
<?php }?>

		<div class="picture-text-toggle js-picture-text-toggle">
			<div class="toggle-outer"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="background-color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>>
				<div class="toggle-inner"<?php if ($_smarty_tpl->tpl_vars['backgroundcolor']->value){?> style="background-color:<?php echo $_smarty_tpl->tpl_vars['backgroundcolor']->value;?>
"<?php }?>></div>
			</div>
			<div class="toogle-tooltip">
				<span class="switch-to-picture"><?php echo $_smarty_tpl->getConfigVariable('switch_to_picture');?>
</span>
				<span class="switch-to-text"><?php echo $_smarty_tpl->getConfigVariable('switch_to_text');?>
</span>
			</div>
		</div>
	</div>
</header>
<?php }} ?>