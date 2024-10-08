<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frocester
 */

?>

<footer id="colophon">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<aside class="bg-foreground text-white py-24" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'frocester' ); ?>">
			<div class="max-w-wide mx-auto px-4 2xl:px-0 footer-main">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
		</aside>
	<?php endif; ?>

	<div class="bg-[#25323D]">
		<div class="max-w-wide mx-auto px-4 2xl:px-0 text-white py-4">
			&copy; Frocester Group Ltd. Reg No. 11478421
		</div>
	</div>

</footer><!-- #colophon -->
