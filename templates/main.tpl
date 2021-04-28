{* Including header.php (default WordPress functionality *}
{get_header()}

{if function_exists('gtm4wp_the_gtm_tag')}
    {gtm4wp_the_gtm_tag()}
{/if}
{if $realm != "issue" && $realm != 'holding'}
    {include "element_header.tpl"}
{/if}
{block name="content"}{/block}

{*{if $realm != 'holding'}
    {wp_footer()}
{/if}*}

{* Including footer.php (default WordPress functionality *}
{get_footer()}