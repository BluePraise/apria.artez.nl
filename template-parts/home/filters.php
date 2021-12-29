<div class="filters">
	<a class="filter-item apria-journal" data-filter="apria-journal" href="#">Apria Journal</a>
	<a class="filter-item open-call" data-filter="open-call" href="#">Open Call</a>
	<a class="filter-item latest-articles" data-filter="latest-articles" href="#">Latest Articles</a>

	<?php if(get_field('curator_name', 'option')): ?>
		<a class="filter-item curated-by" data-filter="curated-by" href="#">Curated By: <?= get_field('curator_name', 'option'); ?>
		</a>
	<?php endif; ?>

</div>

<div class="filter-paragraphs">
	<?php
	$journal_par  = get_field('apria_journal_filter_paragraph', false, false);
	$opencall_par = get_field('open_call_filter_paragraph', false, false,);
	$latest_par   = get_field('latest_articles_filter_paragraph', false, false);
	$curator_text = get_field('curator_text', 'option', false, false);
	if ($journal_par): ?>
		<p class="apria-journal hide"><?php echo $journal_par; ?></p>
	<?php endif;
	if ($opencall_par): ?>
		<p class="open-call hide"><?php echo $opencall_par; ?></p>
	<?php endif;
	if ($latest_par): ?>
		<p class="latest-articles hide"><?php echo $latest_par; ?></p>
	<?php endif; ?>
	<?php 	if ($curator_text): ?>
		<p class="curated-by hide"><?php echo $curator_text; ?></p>
	<?php endif; ?>

</div>
