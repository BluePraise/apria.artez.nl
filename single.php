<?php
// if(get_field('issue')): 
	
	// get_template_part('template-parts/singles/issuerelated');

// else: 
get_header();

	$authors = get_coauthors($aIssue->ID);
	if(get_the_tags()){
		$tags = get_the_tags();
		$article_tags = array_map(function ($aTag) {
			return (object)[
				'id' => $aTag->term_id,
				'name' => $aTag->name,
				'url' => get_tag_link($aTag),
			];
		}, $tags);
	}

	$text = removenbsp1(get_the_content());

	$footnotes = array();

	$replace = function ($match) use (&$footnotes) {
		$index = count($footnotes) + 1;
		$footnotes[$index] = $match[2];

		return '<sup class="footnote-anchor js-footnote" data-footnoteanchor="'. $index .'">' . $match[1] . '</sup>';
	};

	$content = preg_replace_callback('/\[footnote (.*?)\](.*?)\[\/footnote\]/', $replace, $text);
	$footnotes = $footnotes;
?>

<main class="content-with-sidebar">

	<article>
		<header class="article-header">
			<span class="article__date"><?=get_the_date('d-M-Y'); ?></span>
			<span class="article__authors">
				<?php foreach ($authors as $aAuthor): ?>
					<a href="<?=get_site_url().'/author/'.$aAuthor->user_nicename.'/'; ?>"><?=$aAuthor->display_name; ?></a>
				<?php endforeach; ?>
			</span>
			<?php if(get_field('issue')): 
				$article_issue = get_field('issue');?>
				<span class="article__source">
					Published in<br />
					<?=$article_issue->post_title; ?>
				</span>
			<?php endif; ?>
		
			<?php if(get_field('doi')): ?>
				<span class="article__issue">
					<a href="https://doi.org/{$article->doi|trim}">
						<?=get_field('doi'); ?>
					</a>
				</span>
			<?php endif; ?>
		</header>

			<h1 class="content-title"><?php the_title(); ?></h1>

			<?php if(get_field('subtitle')): ?>
				<h2 class="subtitle"><?=get_field('subtitle'); ?></h2>
			<?php endif; ?>

			<div class="tag-list">
				<?php if($article_tags): $i = 0; ?>
					<?php foreach($article_tags as $aTag): ?>
						<a class="article__tag" href="<?=$aTag->url; ?>"><?=$aTag->name; ?></a> 
							<?php if(++$i !== count($article_tags)):
								echo '<span class="article-separator">/</span>';
							endif; ?>
					<?php endforeach; ?>
				
				<?php endif; ?>
			</div>
			
			<div class="article__text">
				<?php echo apply_filters('the_content', $content) ; ?>
			</div>

		<?php 
			$authors = getAuthors(get_the_ID());
			if($authors):
		?>

		<div class="article__bios">
			<?php foreach($authors as $aAuthor) : ?>
				<div class="author-bio">
					<a href="<?=$aAuthor->posts_url; ?>" class="bio__name"><?=$aAuthor->name; ?></a>
					<div class="bio__text">
						<?php echo $aAuthor->biography; ?>
					</div><!-- .bio__text -->
				</div><!-- .author-bio -->
			<?php endforeach; ?>
			<?php endif;  // AUTHOR  ?>	

		</div><!-- .article__bios -->
		<?php if(get_field('bibliography')): ?>
		<div class="article__bibliography">
			<details>
    			<summary class="bibliography__headline">Bibliography</summary>
    			<?php echo get_field('bibliography'); ?>
			</details>
		</div>
		
		<?php endif;  // Bibliography  
		
		
		if ($footnotes): ?>
		<div class="article__footnotes">
			<details>
				<summary class="footnotes__headline">References</summary>
				<?php foreach($footnotes as $key => $aFootnote) : ?>
					<div class="footnote">
						<span class="footnote-up icon js-footnote-up" data-footnotetext="<?=$key ?>">↑</span>
						<p><?=$aFootnote; ?></p>
					</div>
				<?php endforeach; ?>
				</details>
			</div><!-- article__footnotes -->
		<?php endif; ?>

	</article>
	
	<aside class="latest-posts">
		<ul>
			<?php 

				$post_args = array(
					'post_type'              => array( 'post' ),
					'posts_per_page'         => 5,
					'post__not_in' => array( $post->ID )
				);

				$issue_args = array(
					'post_type'              => array( 'issue' ),
					'posts_per_page'         => 1
				);
				// The Query
				$query_posts   = new WP_Query( $post_args );
				$query_issues  = new WP_Query( $issue_args );

				$result        = new WP_Query();

				// start putting the contents in the new object
				$result->posts = array_unique(array_merge( $query_posts->posts, $query_issues->posts ), SORT_REGULAR );

				$result->post_count = count( $result->posts );
				// var_dump($result);


				// The Loop
				for($i = 1; $result->have_posts(); $i++) :
					$result->the_post();
					
					if(get_the_tags()){
						$tags = get_the_tags();
						$article_tags = array_map(function ($aTag) {
						return (object)[
							'id' => $aTag->term_id,
							'name' => $aTag->name,
							'url' => get_tag_link($aTag),
						];
						}, $tags);
					}
			?>
			<li>
				<a class="latest-post-link-wrapper" href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
					<span class="article-separator-large"></span>
				</a>
					<?php echo '<p class="aside-excerpt">' . get_the_excerpt() . '</p>'; ?>
					<div class="article__meta">
						<span class="article__date"><?=get_the_date('d-M-Y'); ?></span>
						<span class="article-separator">/</span>
						
						<?php if($post->post_type == 'issue'): 
							echo '<span class="issue__name">';
							echo $post->post_title; 
							echo '</span>';
							echo '<span class="article-separator">/</span>';
						endif; ?>
							<span class="article__author">
								<?php $authors = get_coauthors(get_the_ID()); ?>
								<?php foreach($authors as $author): ?>
									<?php echo $author->display_name;  ?>
								<?php endforeach; ?>
							</span>
							<span class="article-separator">/</span>
						
						<?php if($article_tags): $i = 0; ?>
							<?php foreach($article_tags as $aTag): ?>
								<a class="article__tag_link" href="<?=$aTag->url; ?>"><span class="article__tag_name"><?=$aTag->name; ?></span>
									<?php if(++$i !== count($article_tags)):
										echo '<span class="article-separator">/</span>';
									endif; ?>
								</a> 
							<?php endforeach; endif; ?>
						
					
						
					</div><!-- .article__meta -->
			</li>
			<?php endfor; ?>

			<?php wp_reset_postdata(); ?>
		</ul>
	</aside>
</main>

<?php get_footer() ?>


