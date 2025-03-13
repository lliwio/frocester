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

       

    </main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
