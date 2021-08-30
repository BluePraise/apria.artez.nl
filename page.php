<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); 
?>

<main class="page-view">
    <article>
            <p class="article__date"><?=get_the_date('d-M-Y'); ?></p>
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
            <div class="article__text">
                <?php the_content(); ?>
            </div>
    </article>

</main>

<?php get_footer(); ?>