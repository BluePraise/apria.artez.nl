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

global $wp_query, $wpdb;



$getPosts = get_posts(array(
    'post_type' => 'news',
    'post_status' => 'publish',
    'numberposts' => -1,
    
));

$posts = array();
foreach($getPosts as $aPost){
    $posts[] = extendIssuePost($aPost);
}

$searchResults = getFilter($posts);

$pageTitle = ucfirst($tag->name) . ' - ' . $pageTitle;


    $posts = $searchResults;
    $surtitle = "Results tagged by";
    $term = ucfirst($tag->name);


?>

<div class="main-content">
    <article class="main-column">
        <div class="content-wrap">
            
            <div class="search-results">

<?php 

if ($searchResults->results) : 

    foreach ($searchResults->results as $aPost) :
?> 

<div class="search-result <?php if($aPost->tag_ids) { foreach ($aPost->tag_ids as $aId) : ?> filter-tag-<?php echo $aId;  endforeach; } if ($aPost->issue_id) { ?> filter-issue-<?php echo $aPost->issue_id; } 
   if($aPost->author_ids) { foreach ($aPost->author_ids as $aId): ?> filter-author-<?=$aId;  endforeach; } ?>"> 
<div class="result__date"><?php echo formatDate($aPost->date); ?></div>
   <a
   href="<?=$aPost->url; ?> " class="result__title"><?=$aPost->title?> <?php if
   ($aPost->subtitle) { ?> <em> <?=$aPost->subtitle ?></em> <?php } ?></a>
   <div class="result__text"> <?=$aPost->previewtext; ?> </div> <div
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