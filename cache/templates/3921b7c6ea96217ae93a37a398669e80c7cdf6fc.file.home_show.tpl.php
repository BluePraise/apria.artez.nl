<?php /* Smarty version Smarty-3.1.5, created on 2021-06-29 20:41:21
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/home_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:72741780560621005c44436-11615907%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3921b7c6ea96217ae93a37a398669e80c7cdf6fc' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/home_show.tpl',
      1 => 1623940065,
      2 => 'file',
    ),
    'e3e7e778706fc25ebf11afa0e9561e671589e3ed' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/main.tpl',
      1 => 1623940065,
      2 => 'file',
    ),
    '01be3898df6cd7040c63892a2e6f18d8d199b1ac' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_footer.tpl',
      1 => 1623940065,
      2 => 'file',
    ),
    '6415171b5c771b7c161714f3bc87a1b1481877e0' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar_post.tpl',
      1 => 1623940065,
      2 => 'file',
    ),
    '55a2f2de62a74f4e47e1e123a831d7e80bf53865' => 
    array (
      0 => '/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar.tpl',
      1 => 1623940065,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72741780560621005c44436-11615907',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_60621005f050c',
  'variables' => 
  array (
    'realm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60621005f050c')) {function content_60621005f050c($_smarty_tpl) {?>
<?php echo get_header();?>


<?php if (function_exists('gtm4wp_the_gtm_tag')){?>
	<?php echo gtm4wp_the_gtm_tag();?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['realm']->value!="issue"&&$_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
	<?php echo $_smarty_tpl->getSubTemplate ("element_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

    <div class="main-content">
        <article class="main-column">
            <div class="home-intro">
                <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['intro']->value);?>
</p>
            </div>

            <?php  $_smarty_tpl->tpl_vars['aIssue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aIssue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['allIssues']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aIssue']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['aIssue']->key => $_smarty_tpl->tpl_vars['aIssue']->value){
$_smarty_tpl->tpl_vars['aIssue']->_loop = true;
 $_smarty_tpl->tpl_vars['aIssue']->index++;
 $_smarty_tpl->tpl_vars['aIssue']->first = $_smarty_tpl->tpl_vars['aIssue']->index === 0;
?>
                <div class="home-issue clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->url;?>
">
                    <div class="article__preview-background"<?php if ($_smarty_tpl->tpl_vars['aIssue']->value->background_image){?> style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->background_image;?>
);background-color:<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->background_color;?>
;color:<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->text_color;?>
"<?php }?>>
                        <div class="article__issue article__issue--home balance-text"><?php echo sprintf($_smarty_tpl->getConfigVariable('issue_number'),formatIssueNumber($_smarty_tpl->tpl_vars['aIssue']->value->number));?>
</div>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->url;?>
" class="article__title balance-text"
                           style="color:inherit"><?php echo $_smarty_tpl->tpl_vars['aIssue']->value->title;?>
</a>
                        <?php if ($_smarty_tpl->tpl_vars['aIssue']->value->subtitle){?>
                            <div class="article__subtitle balance-text"><?php echo $_smarty_tpl->tpl_vars['aIssue']->value->subtitle;?>
</div>
                        <?php }?>
                    </div>
                    <div class="article__info">
                        <div class="article__meta">
                            <?php echo formatIssueNumber($_smarty_tpl->tpl_vars['aIssue']->value->number);?>
<br/>
                            <?php echo formatDateLarge($_smarty_tpl->tpl_vars['aIssue']->value->date);?>
<br/>
                            <?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aIssue']->value->authors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aAuthor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aAuthor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
 $_smarty_tpl->tpl_vars['aAuthor']->iteration++;
 $_smarty_tpl->tpl_vars['aAuthor']->last = $_smarty_tpl->tpl_vars['aAuthor']->iteration === $_smarty_tpl->tpl_vars['aAuthor']->total;
?>
                                <a
                                href="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->post_url;?>
"><?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->name;?>
</a><?php if (!$_smarty_tpl->tpl_vars['aAuthor']->last||$_smarty_tpl->tpl_vars['aIssue']->value->download_pdf){?>
                                <br/>
                            <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['aIssue']->value->download_pdf){?>
                                <br>
                                <a class="download_pdf" href="<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->download_pdf;?>
"><?php echo $_smarty_tpl->getConfigVariable('download_pdf');?>
</a>
                            <?php }?>
                        </div>
                        <div class="article__preview-text">
                            <?php echo $_smarty_tpl->tpl_vars['aIssue']->value->preview_text;?>

                        </div>
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['aIssue']->first&&count($_smarty_tpl->tpl_vars['allIssues']->value)>1){?>
                    <div class="load-more-issues js-load-more hide-on-desktop"><?php echo $_smarty_tpl->getConfigVariable('prev_issue');?>
</div>
                <?php }?>
            <?php } ?>
            <?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-mobile"), 0, '72741780560621005c44436-11615907');
content_60db69520d230($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>

        </article>

        <?php /*  Call merged included template "element_sidebar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('sidebar_posts'=>$_smarty_tpl->tpl_vars['currentIssuePosts']->value), 0, '72741780560621005c44436-11615907');
content_60db69520fd2f($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar.tpl" */?>

    </div>

<?php echo get_footer();?>

<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-06-29 20:41:22
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60db69520d230')) {function content_60db69520d230($_smarty_tpl) {?><footer<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
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
	<span class="social-media">
		APRIA on
		<a href="https://www.facebook.com/APRIAjournalandplatform/">facebook</a>
		<a href="https://www.youtube.com/channel/UCzeADbgeHInL4Rr1A6CofGw">YouTube</a>
		<a href="https://www.instagram.com/apria_journal_and_platform/">Instagram</a>
	</span>
</footer>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-06-29 20:41:22
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60db69520fd2f')) {function content_60db69520fd2f($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sidebar_issue']->value||$_smarty_tpl->tpl_vars['sidebar_posts']->value||$_smarty_tpl->tpl_vars['newsPosts']->value){?>
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
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('classNames'=>"article-preview--news"), 0, '72741780560621005c44436-11615907');
content_60db695213e57($_smarty_tpl);
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
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_sidebar_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '72741780560621005c44436-11615907');
content_60db695213e57($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_sidebar_post.tpl" */?>
				<?php } ?>

				<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-desktop"), 0, '72741780560621005c44436-11615907');
content_60db69520d230($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
			</div>
		</div>
	</aside>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2021-06-29 20:41:22
         compiled from "/Users/mchetrit/Dropbox/Work/APRIA/APRIA_WP/wp-content/themes/apria/templates/element_sidebar_post.tpl" */ ?>
<?php if ($_valid && !is_callable('content_60db695213e57')) {function content_60db695213e57($_smarty_tpl) {?><div class="article-preview <?php echo $_smarty_tpl->tpl_vars['classNames']->value;?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->url){?> clickable-block" data-href="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->url;?>
<?php }?>">
	<div class="preview__background-container">

		<div class="preview__background-image">
			<?php if ($_smarty_tpl->tpl_vars['aPost']->value->featureImage){?>
				<img src="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->featureImage[0];?>
" alt=""/>
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