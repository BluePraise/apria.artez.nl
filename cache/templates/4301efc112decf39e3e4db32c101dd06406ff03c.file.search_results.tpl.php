<?php /* Smarty version Smarty-3.1.5, created on 2020-04-25 01:56:24
         compiled from "/data/web/apria/wp-content/themes/apria/templates/search_results.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12815385015cb8411a6d3088-78201115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4301efc112decf39e3e4db32c101dd06406ff03c' => 
    array (
      0 => '/data/web/apria/wp-content/themes/apria/templates/search_results.tpl',
      1 => 1587598551,
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
  ),
  'nocache_hash' => '12815385015cb8411a6d3088-78201115',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_5cb8411a74749',
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
<?php if ($_valid && !is_callable('content_5cb8411a74749')) {function content_5cb8411a74749($_smarty_tpl) {?><!DOCTYPE html>
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

			<div class="article__head">
				<div class="head__top-line">
					<span class="article__surtitle"><?php echo $_smarty_tpl->tpl_vars['surtitle']->value;?>
:</span>
				</div>
				<h1 class="article__title"><?php echo ucfirst($_smarty_tpl->tpl_vars['term']->value);?>
</h1>
			</div>

			<div class="search-results">
<?php if ($_smarty_tpl->tpl_vars['posts']->value->results){?>
<?php  $_smarty_tpl->tpl_vars['aPost'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aPost']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value->results; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aPost']->key => $_smarty_tpl->tpl_vars['aPost']->value){
$_smarty_tpl->tpl_vars['aPost']->_loop = true;
?>
				<div class="search-result<?php  $_smarty_tpl->tpl_vars['aId'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aId']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPost']->value->tag_ids; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aId']->key => $_smarty_tpl->tpl_vars['aId']->value){
$_smarty_tpl->tpl_vars['aId']->_loop = true;
?> filter-tag-<?php echo $_smarty_tpl->tpl_vars['aId']->value;?>
<?php } ?><?php if ($_smarty_tpl->tpl_vars['aPost']->value->issue_id){?> filter-issue-<?php echo $_smarty_tpl->tpl_vars['aPost']->value->issue_id;?>
<?php }?><?php  $_smarty_tpl->tpl_vars['aId'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aId']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPost']->value->author_ids; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aId']->key => $_smarty_tpl->tpl_vars['aId']->value){
$_smarty_tpl->tpl_vars['aId']->_loop = true;
?> filter-author-<?php echo $_smarty_tpl->tpl_vars['aId']->value;?>
<?php } ?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->url;?>
" class="result__title"><?php echo $_smarty_tpl->tpl_vars['aPost']->value->title;?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->subtitle){?> <em><?php echo $_smarty_tpl->tpl_vars['aPost']->value->subtitle;?>
</em><?php }?></a>
					<div class="result__text">
						<?php echo $_smarty_tpl->tpl_vars['aPost']->value->previewtext;?>

					</div>
					<div class="result__info">
						<div class="result__date"><?php echo formatDate($_smarty_tpl->tpl_vars['aPost']->value->date);?>
</div>
						<ul class="result__meta">
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->authors){?>
							<li>
<?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPost']->value->authors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aAuthor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aAuthor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
 $_smarty_tpl->tpl_vars['aAuthor']->iteration++;
 $_smarty_tpl->tpl_vars['aAuthor']->last = $_smarty_tpl->tpl_vars['aAuthor']->iteration === $_smarty_tpl->tpl_vars['aAuthor']->total;
?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->post_url;?>
"><?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->name;?>
</a><?php if (!$_smarty_tpl->tpl_vars['aAuthor']->last){?>, <?php }?>
<?php } ?>
							</li>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->tags){?>
							<li>
<?php  $_smarty_tpl->tpl_vars['aTag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aTag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPost']->value->tags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aTag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aTag']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aTag']->key => $_smarty_tpl->tpl_vars['aTag']->value){
$_smarty_tpl->tpl_vars['aTag']->_loop = true;
 $_smarty_tpl->tpl_vars['aTag']->iteration++;
 $_smarty_tpl->tpl_vars['aTag']->last = $_smarty_tpl->tpl_vars['aTag']->iteration === $_smarty_tpl->tpl_vars['aTag']->total;
?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['aTag']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['aTag']->value->name;?>
</a><?php if (!$_smarty_tpl->tpl_vars['aTag']->last){?> / <?php }?>
<?php } ?>
							</li>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aPost']->value->issue_number){?>
							<li>Published in <a href="<?php echo $_smarty_tpl->tpl_vars['aPost']->value->issue_url;?>
">ISSUE <?php echo formatIssueNumber($_smarty_tpl->tpl_vars['aPost']->value->issue_number);?>
</a></li>
<?php }?>
						</ul>
					</div>
				</div>
<?php } ?>
<?php }else{ ?>
				<?php echo $_smarty_tpl->getConfigVariable('search_no_results');?>

<?php }?>

			</div>
			<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-mobile"), 0, '12815385015cb8411a6d3088-78201115');
content_5ea37ca8da741($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
		</div>
	</article>

<?php if ($_smarty_tpl->tpl_vars['posts']->value->filterableAuthors||$_smarty_tpl->tpl_vars['posts']->value->filterableTags||$_smarty_tpl->tpl_vars['posts']->value->filterableIssues){?>
	<aside class="sidebar-column affix-placeholder">
		<div class="affix-content js-affix-scrolling">
			<div class="content-wrap">
				<div class="filter">
					<div class="filter__header">
						<span><?php echo $_smarty_tpl->getConfigVariable('filter_results');?>
</span> (<?php echo $_smarty_tpl->tpl_vars['posts']->value->total;?>
) | <span class="filter-reset js-reset-filter"><?php echo $_smarty_tpl->getConfigVariable('filter_clear');?>
</span>
					</div>
<?php if ($_smarty_tpl->tpl_vars['posts']->value->filterableIssues){?>
					<div class="filter__group">
						<div class="filter__group-title"><?php echo $_smarty_tpl->getConfigVariable('filter_by_issue');?>
</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
<?php  $_smarty_tpl->tpl_vars['aIssue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aIssue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value->filterableIssues; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aIssue']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aIssue']->key => $_smarty_tpl->tpl_vars['aIssue']->value){
$_smarty_tpl->tpl_vars['aIssue']->_loop = true;
 $_smarty_tpl->tpl_vars['aIssue']->iteration++;
?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_issue_<?php echo $_smarty_tpl->tpl_vars['aIssue']->iteration;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->id;?>
" data-type="issue">
								<label for="checkbox_issue_<?php echo $_smarty_tpl->tpl_vars['aIssue']->iteration;?>
"><?php echo formatIssueNumber($_smarty_tpl->tpl_vars['aIssue']->value->number);?>
 <?php echo $_smarty_tpl->tpl_vars['aIssue']->value->title;?>
 (<?php echo $_smarty_tpl->tpl_vars['aIssue']->value->count;?>
)</label>
							</div>
<?php } ?>
						</div>
					</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['posts']->value->filterableAuthors){?>
					<div class="filter__group">
						<div class="filter__group-title"><?php echo $_smarty_tpl->getConfigVariable('filter_by_author');?>
</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
<?php  $_smarty_tpl->tpl_vars['aAuthor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aAuthor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value->filterableAuthors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aAuthor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aAuthor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aAuthor']->key => $_smarty_tpl->tpl_vars['aAuthor']->value){
$_smarty_tpl->tpl_vars['aAuthor']->_loop = true;
 $_smarty_tpl->tpl_vars['aAuthor']->iteration++;
 $_smarty_tpl->tpl_vars['aAuthor']->last = $_smarty_tpl->tpl_vars['aAuthor']->iteration === $_smarty_tpl->tpl_vars['aAuthor']->total;
?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_author_<?php echo $_smarty_tpl->tpl_vars['aAuthor']->iteration;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->id;?>
" data-type="author">
								<label for="checkbox_author_<?php echo $_smarty_tpl->tpl_vars['aAuthor']->iteration;?>
"><?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->display_name;?>
 (<?php echo $_smarty_tpl->tpl_vars['aAuthor']->value->count;?>
)</label>
							</div>
<?php } ?>

						</div>
					</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['posts']->value->filterableTags){?>
					<div class="filter__group">
						<div class="filter__group-title"><?php echo $_smarty_tpl->getConfigVariable('filter_by_tags');?>
</div>
						<div class="filter-clear-button icon js-reset-filter-group">×</div>
						<div class="filter__items">
<?php  $_smarty_tpl->tpl_vars['aTag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aTag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value->filterableTags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aTag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['aTag']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aTag']->key => $_smarty_tpl->tpl_vars['aTag']->value){
$_smarty_tpl->tpl_vars['aTag']->_loop = true;
 $_smarty_tpl->tpl_vars['aTag']->iteration++;
 $_smarty_tpl->tpl_vars['aTag']->last = $_smarty_tpl->tpl_vars['aTag']->iteration === $_smarty_tpl->tpl_vars['aTag']->total;
?>
							<div class="filter-checkbox filter__item">
								<input class="js-filter" type="checkbox" id="checkbox_tag_<?php echo $_smarty_tpl->tpl_vars['aTag']->iteration;?>
" value="<?php echo $_smarty_tpl->tpl_vars['aTag']->value->id;?>
" data-type="tag">
								<label for="checkbox_tag_<?php echo $_smarty_tpl->tpl_vars['aTag']->iteration;?>
"><?php echo $_smarty_tpl->tpl_vars['aTag']->value->name;?>
 (<?php echo $_smarty_tpl->tpl_vars['aTag']->value->count;?>
)</label>
							</div>
<?php } ?>
						</div>
					</div>
<?php }?>
				</div>
				<?php /*  Call merged included template "element_footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("element_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('class'=>"hide-on-desktop"), 0, '12815385015cb8411a6d3088-78201115');
content_5ea37ca8da741($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "element_footer.tpl" */?>
			</div>
		</div>
	</aside>
<?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['realm']->value!='holding'){?>
	<?php echo wp_footer();?>

<?php }?>
</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.5, created on 2020-04-25 01:56:24
         compiled from "/data/web/apria/wp-content/themes/apria/templates/element_footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ea37ca8da741')) {function content_5ea37ca8da741($_smarty_tpl) {?><footer<?php if ($_smarty_tpl->tpl_vars['color']->value){?> style="color: <?php echo $_smarty_tpl->tpl_vars['color']->value;?>
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