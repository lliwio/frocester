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
                get_template_part('template-parts/content/content', 'single');
            endwhile;
            ?>
        </div>

        <aside class="w-full lg:w-[30%] lg:pl-8">
    <div class="bg-gray-100 p-4 xl:sticky top-12">
        <h4 class="bg-foreground text-yellow uppercase font-bold inline-block p-2">More</h4>
        
        <?php
        $terms = get_the_terms(get_the_ID(), 'project_category');
        if ($terms && !is_wp_error($terms)) {
            $category_ids = wp_list_pluck($terms, 'term_id'); 

            $recent_posts = new WP_Query(array(
                'post_type' => 'project', 
                'tax_query' => array(
                    array(
                        'taxonomy' => 'project_category', 
                        'field' => 'term_id',
                        'terms' => $category_ids,
                    ),
                ),
                'posts_per_page' => 3, 
                'post__not_in' => array(get_the_ID()), 
                'ignore_sticky_posts' => 1,
            ));

            if ($recent_posts->have_posts()) {
                echo '<ul class="recent-posts-list">';
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                    <li class="mb-6 flex items-start space-x-4">
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
                echo '<p>No recent posts available.</p>';
            }

            // Reset Post Data
            wp_reset_postdata();
        } else {
            echo '<p>No categories found for this project.</p>';
        }
        ?>
    </div>
</aside>

    </main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
