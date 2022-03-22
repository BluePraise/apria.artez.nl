<?php global $post; 

$authors = getAuthors($post->ID);
if($authors):
?>

			<div class="article__bios">
<?php foreach($authors as $aAuthor) { ?>
				<div class="author-bio">
					<a href="<?=$aAuthor->posts_url; ?>" class="bio__name"><?=$aAuthor->name; ?></a>
					<div class="bio__text">
						<?=$aAuthor->biography; ?>
					</div>
				</div>
<?php } ?>
			</div>
<?php endif; 

function removenbsp1($s) {
	return str_replace(array('&nbsp;'), ' ', $s);
}



	$text = removenbsp1(get_the_content());

	$footnotes = array();

	$replace = function ($match) use (&$footnotes) {
		$index = count($footnotes) + 1;
		$footnotes[$index] = $match[2];

		return '<span class="footnote-anchor js-footnote" data-footnoteanchor="'. $index .'">' . $match[1] . '</span>';
	};

	$content = preg_replace_callback('/\[footnote (.*?)\](.*?)\[\/footnote\]/', $replace, $text);
	$footnotes = $footnotes;

if ($footnotes):  ?>
			<div class="article__footnotes">
				<div class="footnotes__headline">{#references#}</div>
<?php foreach($footnotes as $aFootnote) { ?>
				<div class="footnote">
					<span class="footnote-up icon js-footnote-up" data-footnotetext="{$aFootnote@iteration}">↑</span>
					<p><?=$aFootnote; ?></p>
				</div>
<?php } ?>
			</div>
<?php endif; ?>

<?php if(get_field('bibliography', $post->ID)): ?>
			<div class="article__bibliography">
				<!-- {$bibliography|shift_headlines:2} -->
				<?=get_field('bibliography', $post->ID); ?>
			</div>
<?php endif; ?>
