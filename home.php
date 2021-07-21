<?php
/*
Template Name: Page Home
*/
get_header();
// <p><?=get_field("intro_text");
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
		<h2>NEWS</h2>
		<?php if(get_field("news_text")): ?>
			<p class="news-text"><?php echo get_field("news_text"); ?></p>
		<?php endif; ?>
	</div>
	</section>
	<section class="posts">
		<ul>
			<?php
			global $post;

			$myposts = get_posts( array(
				'posts_per_page' => 5,
				'offset'         => 1,
				'category'       => 1
			) );

			if ( $myposts ) {
				foreach ( $myposts as $post ) :
					setup_postdata( $post ); ?>
					<li><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></a></h3></li>
				<?php
				endforeach;
				wp_reset_postdata();
			}
			?>

		</ul>

	</section>

</main>


<?php get_footer(); ?>
