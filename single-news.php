<?php get_header(); ?>

<main class="content-with-sidebar page-view">
	<article>
		<header class="article-header">
			<span class="article__date"><?=get_the_date('d-M-Y'); ?></span>
			<span class="article__authors">
				<?php echo the_author( ); ?>
			</span>
		</header>

			<h1 class="content-title"><?php the_title(); ?></h1>

			<?php if(get_field('subtitle')): ?>
				<h2 class="subtitle"><?=get_field('subtitle'); ?></h2>
			<?php endif; ?>



			<div class="article__text">
				<?php the_content(); ?>
			</div>

	</article>

	<aside class="latest-posts">
		<ul>
			<?php

				$post_args = array(
					'post_type'              => array( 'post' ),
					'posts_per_page'         => 5,
					'post__not_in' => array( $post->ID )
				);

				$news_args = array(
					'post_type'              => array( 'news' ),
					'posts_per_page'         => 2
				);
				$issue_args = array(
					'post_type'              => array( 'issue' ),
					'posts_per_page'         => 1
				);
				// The Query
				$query_posts   = new WP_Query( $post_args );
				$query_news    = new WP_Query( $news_args );
				$query_issues  = new WP_Query( $issue_args );

				$result        = new WP_Query();

				// start putting the contents in the new object
				$result->posts = array_unique(array_merge( $query_posts->posts, $query_news->posts, $query_issues->posts ), SORT_REGULAR );

				$result->post_count = count( $result->posts );


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

						<span class="article__author">
							<?php $authors = get_coauthors(get_the_ID()); ?>
							<?php foreach($authors as $author): ?>
								<?php echo $author->display_name;  ?>
							<?php endforeach; ?>
						</span>
						<span class="article-separator">/</span>

						<?php if($post->post_type == 'issue'):
							echo '<span class="issue__name">';
							echo $post->post_title;
							echo '</span>';
							echo '<span class="article-separator">/</span>';
						endif; ?>


						<?php if($article_tags): $i = 0; ?>
							<?php foreach($article_tags as $aTag): ?>
								<a class="article__tag_link" href="<?=$aTag->url; ?>"><span class="article__tag_name"><?=$aTag->name; ?></span>
									<?php if(++$i !== count($article_tags)):
										echo '<span class="article-separator">/</span>';
									endif; ?>
								</a>
							<?php endforeach; endif; ?>

						<!-- </div>.tag-list -->

					</div><!-- .article__meta -->
			</li>
			<?php endfor; ?>

			<?php wp_reset_postdata(); ?>
		</ul>
	</aside>
</main>

<?php get_footer() ?>


