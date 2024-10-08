<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package earlycareers
 */

get_header();
?>

	<section id="primary">
		<main class="max-w-wide mx-auto px-4 2xl:px-0 py-6 gap-12" id="main">
			<h2 class="text-3xl font-bold mt-12 mb-6">Frocester Group news</h2>
			<p class="text-xl">Below you’ll find our latest company news, product launches and updates from our staff.</p>
			<div id="category-filter" class="my-12">
				<?php 
				// Get all categories
				$categories = get_categories();
				foreach ($categories as $category) : ?>
					<button class="filter-button border border-1 border-foreground px-4 py-2 text-lg font-bold xl:mr-8 hover:bg-foreground hover:text-yellow" data-category="<?php echo esc_attr($category->slug); ?>" data-post-type="post">
					<?php echo esc_html($category->name); ?>
					</button>
				<?php endforeach; ?>
				<!-- <button class="filter-button" data-category="">Reset</button> -->
			</div>
			<!-- Skeleton UI (Hidden by default) -->
			<div id="skeleton-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12" style="display:none;">
				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[128px] bg-gray-100"></div>
				</div>

				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[128px] bg-gray-100"></div>
				</div>

				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[128px] bg-gray-100"></div>
				</div>

				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[128px] bg-gray-100"></div>
				</div>

				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[128px] bg-gray-100"></div>
				</div>

				<div class="skeleton-item min-h-96">
					<div class="skeleton-image h-80 bg-gray-200"></div>
					<div class="skeleton-title h-[118px] bg-gray-100"></div>
				</div>
				
			</div>
			<div id="content-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-24">

		<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content-blog-card' );
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
