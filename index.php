<?php 

get_header();

// if ($realm != "issue" && $realm != 'holding')
// {include "element_header.tpl"; }
?>
{block name="content"}{/block}
<?php
if ($realm != 'holding')
	{
    wp_footer();
  }
 ?>
</body>
</html>
