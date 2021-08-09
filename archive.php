<?php
/**
 * The template for displaying all posts
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 **/

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); 


$getPosts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    
));

?>

<div class="main-content">
    <article class="main-column">
        <div class="content-wrap">

            <div class="search-results">
<div class="grid-sizer"></div>
<?php 

if ($getPosts) : 

    foreach ($getPosts as $post) :
?> 

<div class="search-result"> 
<div class="result__date"><?php echo formatDate($post->post_date); ?></div>
   <a
   href="<?=get_the_permalink(); ?> " class="result__title"><?php the_title(); ?> </a>
   <?php the_post_thumbnail("thumbnail"); ?>
   <div class="result__text"> <?=get_the_excerpt(); ?> </div> <div
   class="result__info">  
                    </div>
                </div>
<?php endforeach; 

else : ?>
                No Result Found
<?php endif; ?>

            </div>
                <?php get_footer(); ?>
        </div>
    </article>

</div>