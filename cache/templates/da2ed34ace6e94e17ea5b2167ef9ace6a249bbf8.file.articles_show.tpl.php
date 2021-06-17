<?php /* Smarty version Smarty-3.1.5, created on 2021-05-21 13:57:34
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/articles_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41956147960a7a02ef36388-47677477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da2ed34ace6e94e17ea5b2167ef9ace6a249bbf8' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/articles_show.tpl',
      1 => 1621412592,
      2 => 'file',
    ),
    'e3e7e778706fc25ebf11afa0e9561e671589e3ed' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/main.tpl',
      1 => 1621412592,
      2 => 'file',
    ),
    'aa0f18c4e826768826e3b485506ad269d6c7f9c5' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_article_footer.tpl',
      1 => 1621412592,
      2 => 'file',
    ),
    '01be3898df6cd7040c63892a2e6f18d8d199b1ac' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_footer.tpl',
      1 => 1621412592,
      2 => 'file',
    ),
    '6415171b5c771b7c161714f3bc87a1b1481877e0' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar_post.tpl',
      1 => 1621412592,
      2 => 'file',
    ),
    '55a2f2de62a74f4e47e1e123a831d7e80bf53865' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar.tpl',
      1 => 1620286187,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41956147960a7a02ef36388-47677477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'realm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_60a7a02f28b36',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60a7a02f28b36')) {function content_60a7a02f28b36($_smarty_tpl) {?>
<?php echo get_header();?>


<?php if (function_exists('gtm4wp_the_gtm_tag')){?>
    <?php echo gtm4wp_the_gtm_tag();?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['realm']->value!="issue"&&$_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
    <?php echo $_smarty_tpl->getSubTemplate ("element_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<div class="main-content">
	<article class="main-column">
		<div class="content-wrap">
			<div class="article__head">
				<div class="head__top-line"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>>
					<span class="article__date"><?php echo formatDate($_smarty_tpl->tpl_vars['article']->value->date);?>
</span>
					<span class="article__authors"><?php echo $_smarty_tpl->tpl_vars['article']->value->authors_links;?>
</span>
<?php if ($_smarty_tpl->tpl_vars['article']->value->doi){?>
					<span class="article__issue">
						<a href="https://doi.org/<?php echo trim($_smarty_tpl->tpl_vars['article']->value->doi);?>
">
							<?php echo $_smarty_tpl->getConfigVariable('current_doi');?>
: <?php echo trim($_smarty_tpl->tpl_vars['article']->value->doi);?>

						</a>
					</span>
<?php }?>
				</div>
				<h1 class="article__title balance-text"><?php echo e($_smarty_tpl->tpl_vars['article']->value->title);?>
</h1>
<?php if ($_smarty_tpl->tpl_vars['article']->value->subtitle){?>
				<h2 class="article__subtitle balance-text"><?php echo e($_smarty_tpl->tpl_vars['article']->value->subtitle);?>
</h2>
<?php }?>
				<div class="head__bottom-line">
<?php if ($_smarty_tpl->tpl_vars['article']->value->issue){?>
					<span class="article__source"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>>
						Published in<br />
						<a href="<?php echo e($_smarty_tpl->tpl_vars['article']->value->issue->url);?>
">Issue <?php echo formatIssueNumber($_smarty_tpl->tpl_vars['article']->value->issue->number);?>
</a>
					</span>
<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['article']->value->tags){?><span class="article__tags"<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?>><?php  $_smarty_tpl->tpl_vars['aTag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aTag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['article']->value->tags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aTag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aTag']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aTag']->key => $_smarty_tpl->tpl_vars['aTag']->value){
$_smarty_tpl->tpl_vars['aTag']->_loop = true;
 $_smarty_tpl->tpl_vars['aTag']->iteration++;
 $_smarty_tpl->tpl_vars['aTag']->last = $_smarty_tpl->tpl_vars['aTag']->iteration === $_smarty_tpl->tpl_vars['aTag']->total;
?><a href="<?php echo e($_smarty_tpl->tpl_vars['aTag']->value->url);?>
"><?php echo e($_smarty_tpl->tpl_vars['aTag']->value->name);?>
</a><?php if (!$_smarty_tpl->tpl_vars['aTag']->last){?> / <?php }?><?php } ?></span><?php }?>
				</div>
			</div>
			<div class="article__text<?php if ($_smarty_tpl->tpl_vars['article']->value->paragraph_layout=='indents'){?> article__text-indents<?php }?>">
				<?php echo $_smarty_tpl->tpl_vars['article']->value->content;?>

			</div>

<?php /*  Call merged included template "element_article_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_article_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('authors'=>$_smarty_tpl->tpl_vars['article']->value->authors,'footnotes'=>$_smarty_tpl->tpl_vars['article']->value->footnotes,'bibliography'=>$_smarty_tpl->tpl_vars['article']->value->bibliography), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f10f01($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_article_footer.tpl" */?>

			<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-mobile"), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f184a4($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
		</div>
	</article>

<?php /*  Call merged included template "element_sidebar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('sidebar_issue'=>$_smarty_tpl->tpl_vars['article']->value->issue,'sidebar_posts'=>$_smarty_tpl->tpl_vars['article']->value->related_posts), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f1aac6($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar.tpl" */?>

</div>

<?php echo get_footer();?>

<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-05-21 13:57:35
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_article_footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60a7a02f10f01')) {function content_60a7a02f10f01($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_shift_headlines')) include '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/libs/plugins/modifier.shift_headlines.php';
?><?php if ($_smarty_tpl->tpl_vars['authors']->value){?>
			<div class="article__bios">
<?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['authors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
?>
				<div class="author-bio">
					<a href="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->posts_url;?>
" class="bio__name"><?php echo e($_smarty_tpl->tpl_vars['aAuthor']->value->name);?>
</a>
					<div class="bio__text">
						<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->biography;?>

					</div>
				</div>
<?php } ?>
			</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['footnotes']->value){?>
			<div class="article__footnotes">
				<div class="footnotes__headline"><?php echo $_smarty_tpl->getConfigVariable('references');?>
</div>
<?php  $_smarty_tpl->tpl_vars['aFootnote'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aFootnote']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footnotes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aFootnote']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aFootnote']->key => $_smarty_tpl->tpl_vars['aFootnote']->value){
$_smarty_tpl->tpl_vars['aFootnote']->_loop = true;
 $_smarty_tpl->tpl_vars['aFootnote']->iteration++;
?>
				<div class="footnote">
					<span class="footnote-up icon js-footnote-up" data-footnotetext="<?php echo $_smarty_tpl->tpl_vars['aFootnote']->iteration;?>
">↑</span>
					<p><?php echo $_smarty_tpl->tpl_vars['aFootnote']->value;?>
</p>
				</div>
<?php } ?>
			</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['bibliography']->value){?>
			<div class="article__bibliography">
				<?php echo smarty_modifier_shift_headlines($_smarty_tpl->tpl_vars['bibliography']->value,2);?>

			</div>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-05-21 13:57:35
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60a7a02f184a4')) {function content_60a7a02f184a4($_smarty_tpl) {?><footer<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['class']->value){?> class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"<?php }?>>
	<span class="copyright-info">
		©2019 APRIA
		<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" class="creative-commons-license">
			<img alt="Creative Commons License" style="border-width:0"
				 src="https://i.creativecommons.org/l/by-nc/4.0/80x15.png"/>
		</a>
	</span>
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
	<span class="social-media">APRIA on <a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a> <a
				href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a> <a
				href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a></span>
</footer>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-05-21 13:57:35
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60a7a02f1aac6')) {function content_60a7a02f1aac6($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value||$_smarty_tpl->tpl_vars['sidebar_posts']->value||$_smarty_tpl->tpl_vars['newsPosts']->value){?>
	<aside class="sidebar-column<?php if ($_smarty_tpl->tpl_vars['newsPosts']->value){?> sidebar-column--news<?php }?> affix-placeholder">
		<div class="affix-content<?php if ($_smarty_tpl->tpl_vars['realm']->value=="issue"){?> js-affix-scrolling-issue<?php }else{ ?> js-affix-scrolling<?php }?>">
			<div class="content-wrap">
				<?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value){?>
					<div class="issue-preview clickable-block"
						 data-href="<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->url;?>
?color=ffffff&amp;bgcolor=000000&amp;opacity=0.2&amp;image=background_02.svg">
						<div class="preview__background"<?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value->background_image){?> style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->background_image;?>
);background-color:<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->background_color;?>
;color:<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->text_color;?>
"<?php }?>>
							<a href="<?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->url;?>
"
							   class="preview__title balance-text"><?php echo $_smarty_tpl->tpl_vars['sidebar_issue']->value->title;?>
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
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('classNames'=>"article-preview--news"), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f22e7c($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar_post.tpl" */?>
					<?php if ($_smarty_tpl->tpl_vars['aPost']->last){?>
						<hr class="article-preview-rule">
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
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f22e7c($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar_post.tpl" */?>
				<?php } ?>

				<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-desktop"), 0, '41956147960a7a02ef36388-47677477');
content_60a7a02f184a4($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
			</div>
		</div>
	</aside>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-05-21 13:57:35
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar_post.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60a7a02f22e7c')) {function content_60a7a02f22e7c($_smarty_tpl) {?>				<div class="article-preview <?php echo $_smarty_tpl->tpl_vars['classNames']->value;?>
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