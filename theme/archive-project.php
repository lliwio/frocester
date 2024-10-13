<?php
/**
 * The template for displaying the "Projects" archive
 *
 * This template displays an archive page for the custom post type "projects".
 *
 * @package earlycareers
 */

get_header();
?>

<section id="primary">
    <main class="max-w-wide mx-auto px-4 2xl:px-0 py-6 gap-12" id="main">
        <h2 class="text-3xl font-bold mt-12 mb-6">Our projects</h2>
        <p class="text-xl">Working in partnership with our customers we’ve delivered a wide range of successful projects in each of our service areas.</p>
       <div id="category-filter" class="my-12">
            <?php 
            // Get custom taxonomy terms (assuming 'project_category' is the taxonomy for your projects)
            $terms = get_terms( array(
                'taxonomy' => 'project_category', // Change to your custom taxonomy
                'hide_empty' => true,
            ));

            if ( !empty($terms) && !is_wp_error($terms) ) :
                foreach ( $terms as $term ) : ?>
                    <button class="filter-button border border-1 border-foreground px-4 py-2 text-lg font-bold xl:mr-8 hover:bg-foreground hover:text-yellow" data-category="<?php echo esc_attr($term->slug); ?>" data-post-type="project">
                        <?php echo esc_html($term->name); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Skeleton UI (Hidden by default) -->
        <div id="skeleton-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12" style="display:none;">
            <div class="skeleton-item min-h-96">
                <div class="skeleton-image h-80 bg-gray-200"></div>
                <div class="skeleton-title h-[128px] bg-gray-100"></div>
            </div>
            <!-- Add more skeleton items as needed -->
        </div>

        <div id="content-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-24">
            <?php
            if ( have_posts() ) {

                // Load posts loop.
                while ( have_posts() ) {
                    the_post();
                    
                    // Use a specific template for project posts
                    get_template_part( 'template-parts/content/content-project-card' );
                }
            } else {

                // If no content, include the "No posts found" template.
                get_template_part( 'template-parts/content/content', 'none' );

            }
            ?>
        </div>
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
?>