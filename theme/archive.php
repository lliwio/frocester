<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frocester
 */

get_header();
?>

<section id="primary">
		<main class="max-w-wide mx-auto px-4 2xl:px-0 py-6 gap-12" id="main">
		
		<?php
        // Check if it's a taxonomy archive for 'project_category'
        if ( is_tax( 'project_category' ) ) {
            // Output the current term name
            echo '<h2 class="text-3xl font-bold mt-12 mb-6">' . single_term_title( '', false ) . ' projects</h2>';
        } else {
            // Fallback to the archive title
            the_archive_title( '<h2 class="text-3xl font-bold mt-12 mb-6">', '</h2>' );
        }
        ?>
			
		<div id="content-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-24">

		<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
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
