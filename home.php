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
	<p class="intro-text">APRIA: ArtEZ Platform for Research Interventions of the Arts is an online platform that curates a peer-reviewed journal (APRIA journal) and publishes high-impact essays, image and sound contributions that examine art and interventions of the arts in relation to science and society, and that encourage dialogue around themes that are critical and urgent to the futures that we will live in.</p>
	<div class="news-column">
		<h2><svg id="e30ccd0a-9213-4e99-ada3-88cc42ad2332" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 99.8 99.8"><defs><style>.b125b8eb-ddd7-4d3b-9fdd-acb1c0772a53{fill:none;}.a6f3f3af-ee50-487d-a1b0-377e4464c896{clip-path:url(#b88120a8-2923-4830-8af7-28c1e41e810f);}.a0951cfe-7d45-41f8-8a0b-8a62f326fb3f{fill:#ff2020;}.b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f{fill:#f1f1f2;}</style><clipPath id="b88120a8-2923-4830-8af7-28c1e41e810f" transform="translate(0 0)"><rect class="b125b8eb-ddd7-4d3b-9fdd-acb1c0772a53" width="99.8" height="99.8"/></clipPath></defs><g class="a6f3f3af-ee50-487d-a1b0-377e4464c896"><path class="a0951cfe-7d45-41f8-8a0b-8a62f326fb3f" d="M49.9,0A49.9,49.9,0,1,1,0,49.9,49.9,49.9,0,0,1,49.9,0" transform="translate(0 0)"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="7.48 65.61 7.48 33.74 12.56 33.74 19.22 51.97 19.31 51.97 19.31 33.74 24.25 33.74 24.25 65.61 19.49 65.61 12.51 45.7 12.42 45.7 12.42 65.61 7.48 65.61"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="28.98 65.61 28.98 33.74 43.64 33.74 43.64 38.51 34.46 38.51 34.46 46.72 41.52 46.72 41.52 51.49 34.46 51.49 34.46 60.84 44.26 60.84 44.26 65.61 28.98 65.61"/><polygon class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" points="58.94 33.74 63.45 33.74 67.15 54.05 67.24 54.05 70.29 33.74 75.41 33.74 69.8 65.61 65.21 65.61 61.24 44.56 61.15 44.56 57.44 65.61 52.85 65.61 46.8 33.74 51.92 33.74 55.28 54.05 55.37 54.05 58.94 33.74"/><path class="b0c4d910-a8ff-4c33-97bb-5f9c3dad1f6f" d="M89.08,41.6c-.22-2.74-1.68-3.53-2.91-3.53-1.77,0-2.74,1.14-2.74,3.13,0,5.43,11.12,8,11.12,16.69,0,5.25-3.53,8.16-8.65,8.16s-8-4.06-8.21-8.82l5.21-.75c.22,3.22,1.5,4.81,3.27,4.81s3.18-1,3.18-2.92c0-6.31-11.13-8-11.13-17.12,0-5.08,3.09-8,8.48-8,4.46,0,7.1,3.22,7.59,7.72Z" transform="translate(0 0)"/></g></svg></h2>
		<?php if(get_field("news_text")): ?>
			<p class="news-text"><?php echo get_field("news_text"); ?></p>
		<?php endif; ?>
	</div>
	</section>
	<section class="posts">
		<ul>
			<?php // WP_Query arguments
				$post_args = array(
					'post_type'              => array( 'post' ),
					'posts_per_page'         => 5
				);

				$news_args = array(
					'post_type'              => array( 'news' ),
					'posts_per_page'         => 5
				);
				$issue_args = array(
					'post_type'              => array( 'issue' ),
					'posts_per_page'         => 5
				);
				// The Query
				$query_posts   = new WP_Query( $post_args );
				$query_news    = new WP_Query( $news_args );
				$query_issues  = new WP_Query( $issue_args );

				$result        = new WP_Query();

				// start putting the contents in the new object
				$result->posts = array_unique(array_merge( $query_posts->posts, $query_news->posts, $query_issues->posts ), SORT_REGULAR );

				// $posts = get_posts( $defaults );
				var_dump($results);

				// The Loop
				// if ( $query->have_posts() ) : while ( $query->have_posts() ): $query->the_post(); 
				// 	$post = get_post( $post );
				
				?>
					
				<?php //endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>

		</ul>

	</section>

</main>


<?php get_footer(); ?>
