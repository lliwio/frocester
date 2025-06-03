<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package frocester
 */

get_header();
?>

	<section id="primary">
	<main id="main" class="flex flex-wrap max-w-wide mx-auto px-4 2xl:px-0 py-6 space-y-6 lg:space-y-0 my-8">
        
        <div class="lg:w-[70%]">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'single-jobs');
            endwhile;
            ?>
        </div>

        <aside class="w-full lg:w-[30%] lg:pl-8">
    <div class="bg-gray-100 p-4 xl:sticky top-12">
        <h4 class="bg-foreground text-yellow uppercase font-bold inline-block p-2 mb-2">More</h4>
        
        <?php
    $recent_jobs = new WP_Query(array(
        'post_type' => 'jobs', 
        'posts_per_page' => 3, 
        'post__not_in' => array(get_the_ID()), 
        'ignore_sticky_posts' => 1,
    ));

    if ($recent_jobs->have_posts()) {
        echo '<ul class="recent-jobs-list">';
        while ($recent_jobs->have_posts()) : $recent_jobs->the_post();
            ?>
            <li class="mb-2 flex items-start space-x-4">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="w-16 h-16 flex-shrink-0 mt-2">
                        <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="text-lg hover:underline flex-1">
                    <?php the_title(); ?>
                </a>
            </li>
            <?php
        endwhile;
        echo '</ul>';
    } else {
        echo '<p>No recent job posts available.</p>';
    }

    // Reset Post Data
    wp_reset_postdata();
?>
    </div>
</aside>

    </main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
