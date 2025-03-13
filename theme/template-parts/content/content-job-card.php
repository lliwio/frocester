<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frocester
 */

?>
<div id="post-<?php the_ID(); ?>" class="p-0 bg-gray-50 overflow-hidden">
    <div class="block no-underline">
        <div class="post-content px-6 py-4 pb-8">
            <?php $post_id = get_the_ID(); ?>
            <h3 class="text-2xl font-bold my-4">
                    <?php echo esc_html(get_field('job_title', $post_id)); ?>
            </h3>
            <p class="text-lg"><?php echo esc_html(get_field('job_description', $post_id)); ?></p>
            <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php the_permalink(); ?>">More details</a></div>
        </div>
    </div>
</div>
