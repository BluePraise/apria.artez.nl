<?php

/*
	APRIA
	Copyright (C) 2018 by Systemantics, Bureau for Informatics

	Systemantics GmbH
	Bleichstr. 11
	41747 Viersen
	GERMANY

	Web:    www.systemantics.net
	Email:  hello@systemantics.net

	Permission granted to use the files associated with this
	website only on your webserver.

	Changes to these files are PROHIBITED due to license restrictions.
*/



// This is the WordPress adaptor for the Systemantics boilerplate
// All access is handled by main.php (usually triggered from .htaccess)



get_header();

global $wp_query, $wpdb;



$tag = get_queried_object();

$getPosts = get_posts(array(
    'post_type' => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
			'terms' => $tag->term_id,
        )
    )
));



$pageTitle = ucfirst($tag->name) . ' - ' . $pageTitle;


	$posts = $posts;
	$surtitle = "Results tagged by";
	$term = ucfirst($tag->name);


?>

<main>
	<article class="main-column">
		<div class="content-wrap">

			<div class="article__head">
				<div class="head__top-line">
					<span class="article__surtitle"> <?=$surtitle; ?>: </span>
				</div>
				<h1 class="article__title"><?php 
				// var_dump($_GET); 
				echo $term; ?></h1>
			</div>

			<div class="search-results">
<div class="grid-sizer"></div>
<?php 
//var_dump($getPosts);

if ($getPosts) : 

	foreach ($getPosts as $post) :
?> 

<div class="search-result"> 
<div class="result__date"><?php echo formatDate($post->post_date); ?></div>
   <a
   href="<?=get_the_permalink($post->ID); ?> " class="result__title"><?php the_title($post->ID); ?>
   <?php the_post_thumbnail(); ?>
    </a>
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

</main>