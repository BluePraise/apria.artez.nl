<?php /* Smarty version Smarty-3.1.5, created on 2020-04-23 08:43:28
         compiled from "/data/web/apria/wp-content/themes/apria/templates/element_footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6685042195cb72c4fcdb867-07592395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce99f0a0c193ba5d288da674a7978a53d77e44fa' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/element_footer.tpl',
      1 => 1587598550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6685042195cb72c4fcdb867-07592395',
  'function' => 
  array (
  ),
  'unifunc' => 'content_5cb72c4fd1ec7',
  'variables' => 
  array (
    'color' => 0,
    'class' => 0,
    'footerMenu' => 0,
    'aItem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cb72c4fd1ec7')) {function content_5cb72c4fd1ec7($_smarty_tpl) {?><footer<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['class']->value){?> class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"<?php }?>>
	<span class="copyright-info">©2019 APRIA <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png" /></a></span>
<?php if ($_smarty_tpl->tpl_vars['footerMenu']->value){?>
	<span class="footer-pages">
<?php  $_smarty_tpl->tpl_vars['aItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footerMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aItem']->key => $_smarty_tpl->tpl_vars['aItem']->value){
$_smarty_tpl->tpl_vars['aItem']->_loop = true;
?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['aItem']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['aItem']->value->title;?>
</a>
<?php } ?>
	</span>
<?php }?>
	<span class="social-media">APRIA on <a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a> <a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a> <a href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a></span>
</footer>
<?php }} ?>