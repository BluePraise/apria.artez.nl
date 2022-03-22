<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); 
?>

<main class="page-view grid-view">
    <article>
            <h2 class="subtitle"><?php the_title();?></h2>
            <?php if(has_post_thumbnail()): ?>
                <figure>
                    <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
                </figure>
            <?php endif;?>
            <div class="article__text">
                <?php the_content(); ?>
            </div>
    </article>

</main>

<?php get_footer(); ?>