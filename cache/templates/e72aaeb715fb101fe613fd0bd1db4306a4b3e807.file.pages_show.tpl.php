<?php /* Smarty version Smarty-3.1.5, created on 2020-07-14 16:20:13
         compiled from "/data/web/apria/wp-content/themes/apria/templates/pages_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5746254135cb7039bbcecd1-68089385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e72aaeb715fb101fe613fd0bd1db4306a4b3e807' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/pages_show.tpl',
      1 => 1594736412,
      2 => 'file',
    ),
    '881df4bc3b03a3377da7eb495262b8a144dc6956' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/main.tpl',
      1 => 1587759523,
      2 => 'file',
    ),
    'ce99f0a0c193ba5d288da674a7978a53d77e44fa' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/element_footer.tpl',
      1 => 1587598550,
      2 => 'file',
    ),
    'f8d63f7593fe157427a7dfcb5d7edc08c8278521' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/element_sidebar_post.tpl',
      1 => 1587598550,
      2 => 'file',
    ),
    '0ff87353d8df2e6f08bd7e8dd3f5865db08d5437' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/element_sidebar.tpl',
      1 => 1594736318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5746254135cb7039bbcecd1-68089385',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_5cb7039bc2b31',
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
<?php if ($_valid && !is_callable('content_5cb7039bc2b31')) {function content_5cb7039bc2b31($_smarty_tpl) {?><!DOCTYPE html>
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

<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">
			<h1 class="article__title balance-text"><?php echo $_smarty_tpl->tpl_vars['page']->value->title;?>
</h1>
<?php if ($_smarty_tpl->tpl_vars['page']->value->subtitle){?>
			<h2 class="article__subtitle balance-text"><?php echo $_smarty_tpl->tpl_vars['page']->value->subtitle;?>
</h2>
<?php }?>

			<div class="article__text">
				<?php echo $_smarty_tpl->tpl_vars['page']->value->content;?>

			</div>
			<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-mobile"), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d68fb6($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
		</div>
	</article>

<?php if ($_smarty_tpl->tpl_vars['defaultSidebarText']->value||$_smarty_tpl->tpl_vars['page']->value->sidebartext){?>
	<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling">
			<div class="content-wrap">
				<div class="sidebar__text">
<?php if ($_smarty_tpl->tpl_vars['page']->value->sidebartext){?>
					<?php echo $_smarty_tpl->tpl_vars['page']->value->sidebartext;?>

<?php }elseif($_smarty_tpl->tpl_vars['defaultSidebarText']->value){?>
					<?php echo $_smarty_tpl->tpl_vars['defaultSidebarText']->value;?>

<?php }?>
				</div>
				<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-desktop"), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d68fb6($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
			</div>
		</div>
	</aside>
<?php }else{ ?>
<?php /*  Call merged included template "element_sidebar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d69e86($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar.tpl" */?>
<?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
	<?php echo wp_footer();?>

<?php }?>
</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2020-07-14 16:20:13
         compiled from "/data/web/apria/wp-content/themes/apria/templates/element_footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5f0dbf1d68fb6')) {function content_5f0dbf1d68fb6($_smarty_tpl) {?><footer<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
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
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2020-07-14 16:20:13
         compiled from "/data/web/apria/wp-content/themes/apria/templates/element_sidebar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5f0dbf1d69e86')) {function content_5f0dbf1d69e86($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value||$_smarty_tpl->tpl_vars['sidebar_posts']->value||$_smarty_tpl->tpl_vars['newsPosts']->value){?>
	<aside class="sidebar-column<?php if ($_smarty_tpl->tpl_vars['newsPosts']->value){?> sidebar-column--news<?php }?> affix-placeholder">
		<div class="affix-content<?php if ($_smarty_tpl->tpl_vars['realm']->value=="issue"){?> js-affix-scrolling-issue<?php }else{ ?> js-affix-scrolling<?php }?>">
			<div class="content-wrap">
<?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value){?>
				<div class="issue-preview clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->url;?>
?color=ffffff&amp;bgcolor=000000&amp;opacity=0.2&amp;image=background_02.svg">
					<div class="preview__background"<?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value->background_image){?> style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->background_image;?>
);background-color:<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->background_color;?>
;color:<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->text_color;?>
"<?php }?>>
						<a href="<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->url;?>
" class="preview__title balance-text"><?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->title;?>
</a>
						<div class="preview__subtitle balance-text"><?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->subtitle;?>
</div>
					</div>
					<div class="preview__info">
						<span class="preview__date"><?php echo formatDateShort($_smarty_tpl->tpl_vars['sidebar_issue']->value->date);?>
</span>
<?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value->authors){?>
						<span class="preview__authors">
<?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sidebar_issue']->value->authors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->post_url;?>
"><?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->name;?>
</a>
<?php } ?>
						</span>
<?php }?>
					</div>
				</div>
<?php }?>

<?php  $_smarty_tpl->tpl_vars['aPost'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aPost']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['newsPosts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aPost']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aPost']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aPost']->key => $_smarty_tpl->tpl_vars['aPost']->value){
$_smarty_tpl->tpl_vars['aPost']->_loop = true;
 $_smarty_tpl->tpl_vars['aPost']->iteration++;
 $_smarty_tpl->tpl_vars['aPost']->last = $_smarty_tpl->tpl_vars['aPost']->iteration === $_smarty_tpl->tpl_vars['aPost']->total;
?>
<?php /*  Call merged included template "element_sidebar_post.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('classNames'=>"article-preview--news"), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d6af28($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar_post.tpl" */?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->last){?>
				<hr class="article-preview-rule"></hr>
<?php }?>
<?php } ?>

<?php  $_smarty_tpl->tpl_vars['aPost'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aPost']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sidebar_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aPost']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aPost']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aPost']->key => $_smarty_tpl->tpl_vars['aPost']->value){
$_smarty_tpl->tpl_vars['aPost']->_loop = true;
 $_smarty_tpl->tpl_vars['aPost']->iteration++;
 $_smarty_tpl->tpl_vars['aPost']->last = $_smarty_tpl->tpl_vars['aPost']->iteration === $_smarty_tpl->tpl_vars['aPost']->total;
?>
<?php /*  Call merged included template "element_sidebar_post.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d6af28($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar_post.tpl" */?>
<?php } ?>

				<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-desktop"), 0, '5746254135cb7039bbcecd1-68089385');
content_5f0dbf1d68fb6($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
			</div>
		</div>
	</aside>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2020-07-14 16:20:13
         compiled from "/data/web/apria/wp-content/themes/apria/templates/element_sidebar_post.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5f0dbf1d6af28')) {function content_5f0dbf1d6af28($_smarty_tpl) {?>				<div class="article-preview <?php echo $_smarty_tpl->tpl_vars['classNames']->value;?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->url){?> clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->url;?>
<?php }?>">
					<div class="preview__background-container">

						<div class="preview__background-image">
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->featureImage){?>
							<img src="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->featureImage[0];?>
"  alt="" />
<?php }else{ ?>
							<img src="/wp-content/themes/apria/elements/preview_image_placeholder.jpg?w=400" alt="">
<?php }?>
						</div>

<?php if ($_smarty_tpl->tpl_vars['aPost']->value->url){?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->url;?>
" class="preview__title balance-text"><?php echo $_smarty_tpl->tpl_vars['aPost']->value->title;?>
</a>
<?php }else{ ?>
						<span class="preview__title balance-text"><?php echo $_smarty_tpl->tpl_vars['aPost']->value->title;?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->subtitle){?>
						<div class="preview__subtitle balance-text"><?php echo $_smarty_tpl->tpl_vars['aPost']->value->subtitle;?>
</div>
<?php }?>
						<div class="preview__text">
							<?php echo $_smarty_tpl->tpl_vars['aPost']->value->previewtext;?>

						</div>
					</div>
					<div class="preview__info"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
;"<?php }?>>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->date){?>
						<span class="preview__date"><?php echo formatDate($_smarty_tpl->tpl_vars['aPost']->value->date);?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->authors){?>
						<span class="preview__authors">
<?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPost']->value->authors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->post_url;?>
"><?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->name;?>
</a>
<?php } ?>
						</span>
<?php }?>
					</div>
				</div>
<?php }} ?>