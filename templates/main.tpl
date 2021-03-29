<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$meta->language}" lang="{$meta->language}" class="{if $smarty.cookies.displayMode == 'picture'}picture-view{else}text-view{/if} {$htmlClass}{if $backgroundcolor} all-colored" style="background-color:{$backgroundcolor};color:{$color}"{/if}">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
	<title>{$pageTitle|e}</title>
{if $og}
	<meta property="og:url" content="http{if isHTTPS()}s{/if}://{$smarty.server.SERVER_NAME}{$og->url}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$og->title}" />
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@sculpturecenter">
	<meta name="twitter:title" content="{$og->title}" />
{/if}
{if $og->description}
	<meta property="Description" content="{$og->description|e|strip_tags}" />
	<meta property="og:description" content="{$og->description|e|strip_tags}" />
	<meta name="twitter:description" content="{$og->description|e|strip_tags}" />
{/if}
{if $og->image}
	<meta property="og:image" content="http{if isHTTPS()}s{/if}://{$smarty.server.SERVER_NAME}/{$og->image}?w=2000" />
	<meta name="twitter:image" content="http{if isHTTPS()}s{/if}://{$smarty.server.SERVER_NAME}/{$og->image}?w=2000" />
{$size = getimagesize($og->image)}
{if $size[0] && $size[1]}
{$scale = min(2000 / $size[0], 2000 / $size[1])}
	<meta property="og:image:width" content="{floor($size[0] * $scale)}" />
	<meta property="og:image:height" content="{floor($size[1] * $scale)}" />
{/if}
{/if}
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
	<!--
		Design by Catalogtree (https://www.catalogtree.net/)
		Technical realization by Systemantics (http://www.systemantics.net/)
	-->
	{wp_head()}
</head>
<body>
{if function_exists('gtm4wp_the_gtm_tag')}
{gtm4wp_the_gtm_tag()}
{/if}
{if $realm != "issue" && $realm != 'holding'}
{include "element_header.tpl"}
{/if}
{block name="content"}{/block}
{if $realm != 'holding'}
	{wp_footer()}
{/if}
</body>
</html>
