<?php
/*
Template Name: Page Home
*/
get_header();
// <p><?=get_field("intro_text");
?>
<main>

<div class="logo-container">
	<a href="<?php echo esc_url(home_url()); ?>" class="logo" style="background-color: #000000">
		<svg class="apria_logo"></svg>
	</a>
</div>
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
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        endforeach;
        wp_reset_postdata();
    }
    ?>

</ul>
</main>


<?php get_footer(); ?>
