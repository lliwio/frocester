<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frocester
 */

?>

<header id="masthead" class="bg-yellow py-6 xl:py-0">
	<div class="max-w-wide mx-auto flex justify-between px-4 2xl:px-0">
		<div class="w-64 shrink-0 z-50 self-center">
			<?php
			// Check if a custom logo is set
			$custom_logo_id = get_theme_mod('custom_logo');
			$logo = wp_get_attachment_image_src($custom_logo_id, 'large');

			// Check if we're on the front page
			if ( is_front_page() ) :
				if ( has_custom_logo() ) :
					// Display the custom logo
					echo '<a href="' . esc_url(home_url('/')) . '" rel="home">';
					echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
					echo '</a>';
				else :
					// Fallback to site name if no custom logo is set
					echo '<h1>' . get_bloginfo('name') . '</h1>';
				endif;
			else :
				if ( has_custom_logo() ) :
					// Display the custom logo
					echo '<a href="' . esc_url(home_url('/')) . '" rel="home">';
					echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
					echo '</a>';
				else :
					// Fallback to site name if no custom logo is set
					echo '<p><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></p>';
				endif;
			endif;
			?>
		</div>

		<nav id="site-navigation" class="flex items-center" aria-label="<?php esc_attr_e( 'Main Navigation', 'frocester' ); ?>">
			<button id="menu-toggle" class="menu-toggle h-8 w-8 xl:hidden block relative z-50 cursor" aria-controls="primary-menu" aria-expanded="false">
				<div class="relative w-6 h-1 transform">
					<span class="block absolute h-0.5 w-6 bg-foreground transform transition duration-500 ease-in-out -translate-y-1.5" aria-hidden="true"></span>
					<span class="block absolute h-0.5 w-6 bg-foreground transform transition duration-500 ease-in-out opacity-100" aria-hidden="true"></span>
					<span class="block absolute h-0.5 w-6 bg-foreground transform transition duration-500 ease-in-out translate-y-1.5" aria-hidden="true"></span>
				</div>
			</button>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'items_wrap' => '<ul id="primary-menu" class="%2$s hidden fixed xl:static top-0 left-0 z-40 uppercase font-bold w-full h-full pt-44 xl:pt-0 bg-yellow xl:bg-inherit xl:flex flex-col md:flex-row text-xl space-y-2 md:space-y-0 md:space-x-2 text-foreground" aria-label="submenu">%3$s</ul>',
						'walker'         => new Tailwind_Walker_Nav_Menu(),  // Use the custom walker
					)
				);
			?>
		</nav><!-- #site-navigation -->

	</div> <!-- .container -->
</header><!-- #masthead -->
