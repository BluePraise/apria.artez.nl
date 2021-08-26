<?php
/*
Template Name: Page Home
*/

get_header();
?>
<main>
	<section class="hero">
		<div class="logo-container">
			<a href="<?php echo esc_url(home_url()); ?>" class="logo">
				<svg class="apria_logo"></svg>
			</a>
		</div>
		<p class="intro-text"><?php the_field("intro_text"); ?></p>
		<div class="news-column">
			<a href="<?php the_field('news_url'); ?>">
			<h2><svg id="e30ccd0a-9213-4e99-ada3-88cc42ad2332" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 99.8 99.8"><defs><style>.b125b8eb-ddd7-4d3b-9fdd-acb1c0772a53{fill:none;}.a6f3f3af-ee50-487d-a1b0-377e4464c896{clip-path:url(#b88120a8-2923-4830-8af7-28c1e41e810f);}.a0951cfe-7d45-41f8-8a0b-8a62f326fb3f{fill:#ff2020;}.b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f{fill:#f1f1f2;}</style><clipPath id="b88120a8-2923-4830-8af7-28c1e41e810f" transform="translate(0 0)"><rect class="b125b8eb-ddd7-4d3b-9fdd-acb1c0772a53" width="99.8" height="99.8"/></clipPath></defs><g class="a6f3f3af-ee50-487d-a1b0-377e4464c896"><path class="a0951cfe-7d45-41f8-8a0b-8a62f326fb3f" d="M49.9,0A49.9,49.9,0,1,1,0,49.9,49.9,49.9,0,0,1,49.9,0" transform="translate(0 0)"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="7.48 65.61 7.48 33.74 12.56 33.74 19.22 51.97 19.31 51.97 19.31 33.74 24.25 33.74 24.25 65.61 19.49 65.61 12.51 45.7 12.42 45.7 12.42 65.61 7.48 65.61"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="28.98 65.61 28.98 33.74 43.64 33.74 43.64 38.51 34.46 38.51 34.46 46.72 41.52 46.72 41.52 51.49 34.46 51.49 34.46 60.84 44.26 60.84 44.26 65.61 28.98 65.61"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="58.94 33.74 63.45 33.74 67.15 54.05 67.24 54.05 70.29 33.74 75.41 33.74 69.8 65.61 65.21 65.61 61.24 44.56 61.15 44.56 57.44 65.61 52.85 65.61 46.8 33.74 51.92 33.74 55.28 54.05 55.37 54.05 58.94 33.74"/><path class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" d="M89.08,41.6c-.22-2.74-1.68-3.53-2.91-3.53-1.77,0-2.74,1.14-2.74,3.13,0,5.43,11.12,8,11.12,16.69,0,5.25-3.53,8.16-8.65,8.16s-8-4.06-8.21-8.82l5.21-.75c.22,3.22,1.5,4.81,3.27,4.81s3.18-1,3.18-2.92c0-6.31-11.13-8-11.13-17.12,0-5.08,3.09-8,8.48-8,4.46,0,7.1,3.22,7.59,7.72Z" transform="translate(0 0)"/></g></svg></h2>
				<p class="news-text">
					<?php if(get_field("news_text")): ?>
						<?php echo get_field("news_text"); ?>
					<?php else: ?>
						Are you the student board member we’re looking for?
					<?php endif; ?>
				</p>
			</a>
		</div>
		<div class="filters">
			<a class="filter-item apria-journal" data-filter="apria-journal" href="#">Apria Journal</a>
			<a class="filter-item open-call" data-filter="open-call" href="#">Open Call</a>
			<!-- <a class="filter-item latest-articles" data-filter="latest-articles" href="#">Latest Articles</a> -->
			<a class="filter-item curated-by" data-filter="curated-by" href="#">Curated By</a>

			<div class="filter-paragraphs">
				<?php
					$journal_par  = get_field('apria_journal_filter_paragraph', false, false);
					$opencall_par = get_field('open_call_filter_paragraph', false, false,);
					$latest_par   = get_field('latest_articles_filter_paragraph', false, false);
					$curated_par  = get_field('curated_by_filter_paragraph', false, false);
					if ($journal_par): ?>
						<p class="apria-journal hide"><?php echo $journal_par; ?></p>
					<?php endif; 
					if ($opencall_par): ?>
						<p class="open-call hide"><?php echo $opencall_par; ?></p>
					<?php endif;
					if ($latest_par): ?>
						<p class="latest-articles hide"><?php echo $latest_par; ?></p>
					<?php endif;
					if ($latescurated_part_par): ?>
						<p class="curated-by hide"><?php echo $curated_par; ?></p>
					<?php endif; ?>
			</div>
		</div>
	</section>


	<section class="main-content">
		<ul class="default-view home-grid">
			<div class="grid-sizer"></div>
				<?php

				// WP_Query arguments
				$post_args = array(
					'post_type'              => array( 'post' ),
					'posts_per_page'         => 10
				);
				$issue_args = array(
					'post_type'              => array( 'issue' ),
					'posts_per_page'         => -1
				);
				$opencall_args = array(
					'post_type'              => array( 'news' ),
					'category_name'			 => 'open call',
					'posts_per_page'         => -1
				);
				// The Query
				$query_posts   = new WP_Query( $post_args );
				$query_issues  = new WP_Query( $issue_args );
				// Only show news with cat opencall
				$query_opencall  = new WP_Query( $issue_args );

				$result        = new WP_Query();

				// start putting the contents in the new object
				$result->posts = array_unique(array_merge( $query_posts->posts, $query_opencall->posts, $query_issues->posts ), SORT_REGULAR);
				shuffle($result->posts);
				$result->post_count = count( $result->posts );
				// var_dump($result);

				// The Loop
				for($i = 1; $result->have_posts(); $i++) :
                   $result->the_post();
				   $issue_bg = get_field('background_image');
				   $cats = get_categories();
				?>
				<?php if($post->post_type == 'issue'): ?>
				<li class="post-item issue">
					<a href="<?php the_permalink(); ?>" style="background-image: url(<?= $issue_bg; ?>);">	
				<?php elseif($post->post_type == 'post'): ?>
				<li class="post-item article">
				<?php if(get_field("background")) : ?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_field("background"); ?>);">	
					<?php elseif(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
					<?php else: ?>	
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
					<?php endif; ?>
				<?php elseif($post->post_type == 'news'): ?>
				<li class="post-item news">
					<?php if(get_field("background")) : ?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_field("background"); ?>);">	
					<?php elseif(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
					<?php else: ?>	
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
					<?php endif; ?>
				<?php endif; ?>
					<div class="post-content-wrap">
						<h3><?php the_title(); ?></h3>
						<?php
						if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
						else: ?>
							<p><?php the_author(); ?></p>
						<?php endif; ?>
							<p class="post-type">
								<?php if($post->post_type == 'post'): echo 'Article'; elseif($post->post_type == 'news'): echo 'Open Call'; else: echo $post->post_type; endif;?>
							</p>
					</div>
					</a>
				</li>

					<?php endfor;?>
			<?php wp_reset_postdata(); ?>

		</ul>

		<div class="open-call hide">
		<ul class="open-call-view home-grid grid-view">
			<div class="grid-sizer"></div>
			<?php // The Query
				$issue_args = array(
					'post_type'              => array( 'news' ),
					'posts_per_page'         => -1
				);
				$the_query = new WP_Query( $issue_args );
				// The Loop 
				
				if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
						<li class="post-item open-call">
							<?php $issue_bg = get_field('background_image');?>
							<?php if(has_post_thumbnail()): ?>
								<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
							<?php else: ?>	
								<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
							<?php endif; ?>
							<div class="post-content-wrap">
								<h3><?php the_title(); ?></h3>
								<?php
								if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
								else: ?>
									<p><?php the_author(); ?></p>
								<?php endif; ?>
									<p class="post-type">
										<?php echo $post->post_type; ?>
									</p>
							</div>
							</a>
						</li>

				<?php endwhile; endif; wp_reset_postdata();?>

		</div>
			
		<div class="apria-journal hide">
			
				<?php // The Query
				$issue_args = array(
					'post_type'              => array( 'issue' ),
					'posts_per_page'         => -1
				);
				$the_query = new WP_Query( $issue_args );
				// The Loop 
				
				if ( $the_query->have_posts() ) : ?>
				
					<ul class="issue-view home-grid grid-view">
					<div class="grid-sizer"></div>
					<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
						<li class="post-item issue">
							<?php $issue_bg = get_field('background_image');?>
							<?php if(get_field('background_image')) : ?>
								<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $issue_bg; ?>);">
							<?php elseif(has_post_thumbnail()): ?>
								<a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
							<?php else: ?>	
								<a href="<?php the_permalink(); ?>" style="background-image: url(<?= get_stylesheet_directory_uri(). '/assets/placeholder.jpeg'; ?>);">
							<?php endif; ?>
							<div class="post-content-wrap">
								<h3><?php the_title(); ?></h3>
								<?php
								if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
								else: ?>
									<p><?php the_author(); ?></p>
								<?php endif; ?>
									<p class="post-type">
										<?php echo $post->post_type; ?>
									</p>
							</div>
							</a>
						</li>
						<?php endwhile; endif; wp_reset_postdata();?>
					</ul>
		</div>

		<div class="latest-articles hide">
			<?php
				// The Query
				$issue_args = array(
					'post_type'         => array( 'post' ),
					'posts_per_page'    => 10,
					'orderby'			=> 'date'
				);
				$the_query = new WP_Query( $issue_args );

				// The Loop
				if ( $the_query->have_posts() ) : ?>
					<ul class="posts home-grid">
					<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
						<li class="post-item issue" style="background-image: url(<?php echo $issue_bg['url']; ?>);" style="height: <?php echo rand(438, 700); ?>px">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
							<?php
								if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
							else: ?>
								<p><?php the_author(); ?></p>
							<?php endif; ?>
							<p class="post-type">
								<?php if($post->post_type == 'post'): echo 'Article'; else: echo $post->post_type; endif;?>
							</p>
						</a>
						<?php endwhile; ?>
					</ul>
				<?php else :
					// no posts found
					echo '<p>Sorry, there are no results for this.</p>';
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
		</div>

		<div class="curated-by hide">
			<?php
				// The Query
				$issue_args = array(
					'post_type'         => array( 'post' ),
					'posts_per_page'    => 10,
					'orderby'			=> 'date'
				);
				$the_query = new WP_Query( $issue_args );

				// The Loop
				if ( $the_query->have_posts() ) : ?>
					<ul class="posts home-grid">
					<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
						<li class="post-item issue" style="background-image: url(<?php echo $issue_bg['url']; ?>);" style="height: <?php echo rand(438, 700); ?>px">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
							<?php
								if ( function_exists( 'coauthors_posts_links' ) ) : coauthors(null, null, '<p>', '</p>', true);
							else: ?>
								<p><?php the_author(); ?></p>
							<?php endif; ?>
							<p class="post-type">
								<?php if($post->post_type == 'post'): echo 'Article'; else: echo $post->post_type; endif;?>
							</p>
						</a>
						<?php endwhile; ?>
					</ul>
				<?php else :
					// no posts found
					echo '<p>Sorry, there are no results for this.</p>';
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
		</div>
	</section>


</main>


<?php get_footer(); ?>