<?php if($post->post_type == 'issue'): ?>
<li class="post-item issue" >
    <a href="<?php the_permalink(); ?>" style="background-image: url(<?= $issue_bg; ?>);">
<?php elseif($post->post_type == 'post'): ?>
<li class="post-item article" style="height: <?php echo rand(438, 700); ?>px">
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
                <?php if($post->post_type == 'post'): echo 'Article'; else: echo $post->post_type; endif;?>
            </p>
    </div>
    </a>
</li>