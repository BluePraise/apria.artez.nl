<?php
/*
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); 

$the_query = new WP_Query(array(
    'post_type' => 'news',
    'post_status' => 'publish',
    'numberposts' => -1,
)); 

?>


<main class="archive-view">
    <div class="msnry-view">
        <div class="grid-sizer" style="width: calc(25% - 16px);"></div>
        <?php if ( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <article class="grid-item">
                <a href="<?php the_permalink(); ?>">
                    <h2 class="subtitle"><?php the_title();?></h2>
                    <?php if(has_post_thumbnail()): ?>
                    <figure>
                        <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
                    </figure>
                    <?php endif;?>
                    <?php if(get_field('preview_text')): ?>
                        <p class="article__excerpt"><?= get_field('preview_text'); ?></p>
                    <?php else: ?>
                        <p class="article__excerpt"><?php the_excerpt(); ?></p>
                    <?php endif;?>
                </a>
        </article>
    <?php endwhile; endif; wp_reset_postdata(  ); ?>
    </div>
</main>

<?php get_footer(); ?>