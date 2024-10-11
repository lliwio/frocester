<?php
/**
 * frocester functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package frocester
 */

if ( ! defined( 'FROCESTER_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'FROCESTER_VERSION', '0.1.0' );
}

if ( ! defined( 'FROCESTER_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `frocester_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'FROCESTER_TYPOGRAPHY_CLASSES',
		'prose prose-frocester max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'frocester_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function frocester_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on frocester, use a find and replace
		 * to change 'frocester' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'frocester', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'frocester' ),
				'menu-2' => __( 'Footer Menu', 'frocester' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'frocester_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frocester_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'frocester' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'frocester' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'frocester_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function frocester_scripts() {
	wp_enqueue_style( 'frocester-style', get_stylesheet_uri(), array(), FROCESTER_VERSION );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'frocester-script', get_template_directory_uri() . '/js/script.min.js', array(), FROCESTER_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Localize script for AJAX
	wp_localize_script( 'frocester-script', 'ajaxfilter', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ));
}
add_action( 'wp_enqueue_scripts', 'frocester_scripts' );

/**
 * Enqueue the block editor script.
 */
function frocester_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'frocester-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			FROCESTER_VERSION,
			true
		);
		wp_add_inline_script( 'frocester-editor', "tailwindTypographyClasses = '" . esc_attr( FROCESTER_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'frocester_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function frocester_tinymce_add_class( $settings ) {
	$settings['body_class'] = FROCESTER_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'frocester_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

function my_theme_setup() {
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'my_theme_setup');

/** Custom walker
 *
 */
class Tailwind_Walker_Nav_Menu extends Walker_Nav_Menu {

    // Add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $classes = 'sub-menu static xl:absolute block xl:hidden group-hover:block bg-yellow p-0 m-0 z-50 min-w-[200px]'; // Tailwind classes for dropdown with min-width
        $output .= "\n$indent<ul class=\"$classes\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat("\t", $depth) : '';
	
		// Set different classes based on depth
		if ( $depth === 0 ) {
			// Parent li classes
			$li_classes = 'menu-item px-4 !ml-0 py-2 xl:py-8'; // Larger padding for parent
			$a_classes = 'block px-0 xl:border-0 py-2 xl:py-1 text-foreground text-lg'; // Base class for parent a elements
		} else {
			// Child li classes (inside dropdown)
			$li_classes = 'submenu-item px-4 !ml-0 py-2'; // Smaller padding for child
			$a_classes = 'block px-0 xl:border-0 py-2 text-foreground text-base'; // Adjusted text size for dropdown items
		}
	
		// Add specific classes for menu items with children
		if ( isset( $args->has_children ) && $args->has_children && $depth === 0 ) {
			$li_classes .= ' relative group';
			$a_classes .= ' dropdown-toggle';
			$arrow_svg = '<svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
		} else {
			$arrow_svg = '';
		}
	
		// Combine classes with WordPress filter for additional classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($li_classes . ' ' . $class_names) . '"';
	
		// Build the output for the current <li>
		$output .= $indent . '<li' . $class_names . '>';
	
		// Set attributes for <a> tag
		$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="' . esc_attr($a_classes) . '"';
	
		// Build the output for the <a> tag
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $arrow_svg . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		// Append the item to the output
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	

    // Check for children
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
        if ( !$element )
            return;

        $id_field = $this->db_fields['id'];

        // Display the current element
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

function frocester_enqueue_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'frocester_enqueue_google_fonts' );


function cust_logos_shortcode() {
    ob_start(); // Start output buffering

    if ( have_rows( 'logos', 'option' ) ) : ?>
        <section class="alignfull py-6">
			<div class="max-w-wide mx-auto px-4 2xl:px-0">
				<h3 class="text-2xl uppercase table bg-foreground text-yellow px-4 py-2 mx-auto">Some of our customers</h3>
			</div>
            <div class="logos group relative overflow-hidden whitespace-nowrap my-4 [mask-image:_linear-gradient(to_right,_transparent_0,_white_128px,white_calc(100%-128px),_transparent_100%)]">
                <div class="animate-slide-left infinite group-hover:animation-pause inline-block w-max">
                    <?php while ( have_rows( 'logos', 'option' ) ) : the_row(); ?>
                        <?php
                            $logo = get_sub_field( 'logo' );
                            if ($logo) {
                                $logo_url = esc_url($logo['url']);
                                $logo_alt = esc_attr($logo['alt']);
                        ?>
                        <div class="inline w-64 px-2">
                            <img loading="lazy" class="mx-2 inline w-44" src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt; ?>" />
                        </div>
                        <?php 
                            } 
                        endwhile; ?>
                </div>
            </div>
        </section>
    <?php else : ?>
        <p>No logos found.</p> <!-- Optional fallback message -->
    <?php endif;

    return ob_get_clean(); // Return the buffered content
}

// Register the shortcode
add_shortcode('customer_logos', 'cust_logos_shortcode');

function frocester_post_thumbnail($post_id = null) {

    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        $thumb_url = get_the_post_thumbnail_url($post_id, 'full');
    } else {
        $thumb_url = get_template_directory_uri() . '/images/fallback.png';
    }

    if (is_single($post_id)) {
        $classes = 'w-[full] mb-8 transform transition-transform duration-700 ease-in-out group-hover:scale-105';
    } else {
        $classes = 'w-full h-80 !m-0 object-cover transform transition-transform duration-700 ease-in-out group-hover:scale-105';
    }

    echo '<img class="' . esc_attr($classes) . '" src="' . esc_url($thumb_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '" />';
}



function filter_posts_by_category() {
    // Check if category and post_type are passed
    if( isset($_POST['category']) && isset($_POST['post_type']) ) {
        $category = sanitize_text_field( $_POST['category'] );
        $post_type = sanitize_text_field( $_POST['post_type'] );

        // WP Query arguments
        $args = array(
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );

        // If a category is selected, add it to the query
        if( !empty($category) ) {
            if ($post_type == 'post') {
                // For blog posts, use category_name
                $args['category_name'] = $category;
            } else {
                // For projects, use a custom taxonomy, for example, 'project_category'
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'project_category',
                        'field'    => 'slug',
                        'terms'    => $category,
                    ),
                );
            }
        }

        // The Query
        $query = new WP_Query( $args );

        // Check if there are posts
        if( $query->have_posts() ) :
            while( $query->have_posts() ): $query->the_post();
                if ($post_type == 'post') {
                    // Load the blog card template for blog posts
                    get_template_part( 'template-parts/content/content-blog-card' );
                } else {
                    // Load the project card template for projects
                    get_template_part( 'template-parts/content/content-project-card' );
                }
            endwhile;
            wp_reset_postdata();
        else :
            echo 'No posts found';
        endif;

    } else {
        wp_send_json_error('Category or post type not provided');
    }

    wp_die();
}
add_action('wp_ajax_filter_posts', 'filter_posts_by_category');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_by_category');


add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/news' );
	register_block_type( __DIR__ . '/blocks/accreds' );
}

function enqueue_swiper_assets() {
    // Enqueue Swiper CSS
    wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/css/swiper-bundle.min.css', array());
}
add_action( 'wp_enqueue_scripts', 'enqueue_swiper_assets' );

function enqueue_swiper_assets_for_editor() {
    // Enqueue Swiper CSS for the editor
    wp_enqueue_style( 'swiper-css-editor', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '8.0.0' );
}

add_action( 'enqueue_block_editor_assets', 'enqueue_swiper_assets_for_editor' );