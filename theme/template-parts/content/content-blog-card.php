<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frocester
 */

?>
<div id="post-<?php the_ID(); ?>" class="blog-card p-0 min-h-96 bg-yellow overflow-hidden">
    <a href="<?php the_permalink(); ?>" class="block group no-underline">
        <div class="relative flex space-between items-center">
		    <?php frocester_post_thumbnail(); ?>
        </div>
        <div class="post-content px-6 py-4 pb-8 transition-colors duration-300">
            <h3 class="text-2xl font-bold my-4 group-hover:underline"><?php the_title(); ?></h3>
            <span class="text-lg bg-foreground inline-block text-yellow font-bold p-2"><?php frocester_entry_meta(); ?></span>
        </div>
    </a>
</div>