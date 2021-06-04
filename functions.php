<?php
/**
 * UNCG Online functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uncgonline
 */

if ( ! function_exists( 'uncgonline_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uncgonline_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on UNCG Online, use a find and replace
		 * to change 'uncgonline' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uncgonline', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'uncgonline' ),
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
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'uncgonline_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
				)
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'uncgonline_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uncgonline_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uncgonline_content_width', 640 );
}
add_action( 'after_setup_theme', 'uncgonline_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function uncgonline_scripts() {

	// Bootstrap.
	wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' );

	wp_enqueue_style( 'uncgonline-style', get_stylesheet_uri() );

	// TODO make this conditional on depth, not on home page
    if ( get_page_depth() === 0 ) {
        wp_enqueue_style( 'top-level-pages-style', get_template_directory_uri().'/top-level-pages.css' );
    }

    // Bootstrap.
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-scripts', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js', array( 'jquery', 'popper' ) );

    wp_enqueue_script( 'vue-lib', 'https://cdn.jsdelivr.net/npm/vue', array() );

    wp_enqueue_script( 'all-scripts', get_template_directory_uri() . '/all.min.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uncgonline_scripts' );

/**
 * Add stylesheet to admin pages
 */
function enqueue_theme_editor_styles() {
	wp_enqueue_style( 'editor-style', get_template_directory_uri() . '/editor-style.css' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_theme_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require __DIR__ . '/parts/modules/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require __DIR__ . '/parts/body/body-classes.php';
require __DIR__ . '/parts/header/pingback-header.php';

/**
 * Customizer additions.
 */
require __DIR__ . '/parts/header/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require __DIR__ . '/parts/modules/jetpack.php';

/**
 * Load Accessibility nav walker.
 */
require_once __DIR__ . '/parts/header/navigation/aria-walker-nav-menu.php';

/**
 * Adds support for .css file uploads.
 *
 * @param  array $mime_types Array of existing mime types.
 *
 * @return array             Existing mime types with css added.
 */
function uncgonline_mime_types( $mime_types ) {
	$mime_types['css'] = 'text/css';
	return $mime_types;
}
add_filter( 'upload_mimes', 'uncgonline_mime_types' );

/**
 * Remove empty paragraphs from breaks from content that are automatically inserted from the editor.
 *
 * @param  String $content Content to be filtered.
 *
 * @return String          Filtered content.
 */
function empty_paragraph_fix( $content ) {
	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']',
		']<br>'   => ']',
	);
	return strtr( $content, $array );
}
add_filter( 'the_content', 'empty_paragraph_fix', 20 );
add_filter( 'acf_the_content', 'empty_paragraph_fix', 20 );

/**
 * Remove empty paragraphs from breaks from content that are automatically inserted from the editor.
 *
 * @param  String $content The content.
 *
 * @return String          Filtered content.
 */
function remove_empty_p( $content ) {
	// Clean up p tags around block elements.
	$content = preg_replace(array(
		'#<p>\s*<(div|aside|section|article|header|footer)#',
		'#</(div|aside|section|article|header|footer)>\s*</p>#',
		'#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
		'#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
		'#<p>\s*</(div|aside|section|article|header|footer)#',
		), array(
		'<$1',
		'</$1>',
		'</$1>',
		'<$1$2>',
		'</$1',
	), $content);
	return preg_replace( '#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content );
}
add_filter( 'the_content', 'remove_empty_p', 20, 1 );
add_filter( 'acf_the_content', 'remove_empty_p', 20, 1 );

/**
 * Get an array of pages using the Page Links To plugin.
 *
 * @return array       Array of page IDs that use Page Links To.
 */
function list_page_links_to() {
	global $wpdb;
	$excluded_pages = array();
	// Use the global database object to search the postmeta table for posts that use "Page Links To".
	$meta_key = '_links_to';
	$links_to = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key ), ARRAY_A );
	// If any exist, add them to the array of excluded pages.
	if ( count( $links_to ) > 0 ) {
		foreach ( $links_to as $value ) {
			$excluded_pages[] = $value['post_id'];
		}
	}
	unset( $links_to );
	return $excluded_pages;
}

/**
 * Checks if a page uses Page Links To.
 *
 * @param  int $post_id ID of the page to check.
 *
 * @return boolean          True if page uses page links to.
 */
function uses_page_links_to( $post_id ) {
	$post_id = strval( $post_id );
	if ( in_array( $post_id, list_page_links_to(), true ) ) {
		return true;
	}
	return false;
}

function screen_reader_text($atts, $content = null)
{
    return '<div class="screen-reader-text">'.$content.'</div>';
}
add_shortcode('screen_reader_text', 'screen_reader_text');


function srtext($atts)
{
    return '<div class="screen-reader-text">'.$atts['t'].'</div>';
}
add_shortcode('srtext', 'srtext');

/**
 * ACF Rule Type: Page Depth
 *
 * @param array $choices , all of the available rule types
 * @return array
 * @author Bill Erickson
 * @see http://www.billerickson.net/acf-custom-location-rules
 *
 */
function custom_acf_rule_type_page_depth( $choices ) {
    $choices['Page']['page_depth'] = 'Page Depth';
    return $choices;
}

add_filter( 'acf/location/rule_types', 'custom_acf_rule_type_page_depth' );

/**
 * ACF Rule Values: Page Depth
 *
 * @param array $choices , available rule values for this type
 * @return array
 * @author Bill Erickson
 * @see http://www.billerickson.net/acf-custom-location-rules
 *
 */
function custom_acf_rule_values_page_depth( $choices ) {
    // Copied from acf/core/controllers/field_group.php
    // @see http://bit.ly/1Xnx44g

    $post_type = 'page';
    $posts = get_posts( array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
        'post_status' => 'any',
        'suppress_filters' => false,
        'update_post_meta_cache' => false,
    ) );

    if ( $posts ) {
        // sort into hierachial order!
        if ( is_post_type_hierarchical( $post_type ) ) {
            $posts = get_page_children( 0, $posts );
        }

        foreach ( $posts as $page ) {
            $depth = 0;
            $ancestors = get_ancestors( $page->ID, 'page' );
            if ( $ancestors ) {
                // get_ancestors returns an array, so its count is the number of depth levels above the page
                $depth = count( $ancestors );
            }

            $choices[$depth] = $depth;
        }

    }

    // output only unique depth numbers
    return array_unique( $choices, SORT_NUMERIC );
}

add_filter( 'acf/location/rule_values/page_depth', 'custom_acf_rule_values_page_depth' );

/**
 * ACF Rule Match: Page Depth
 *
 * @param boolean $match , whether the rule matches (true/false)
 * @param array $rule , the current rule you're matching. Includes 'param', 'operator' and 'value' parameters
 * @param array $options , data about the current edit screen (post_id, page_template...)
 * @return boolean $match
 * @author Bill Erickson
 * @see http://www.billerickson.net/acf-custom-location-rules
 *
 */
function custom_acf_rule_match_page_depth( $match, $rule, $options ) {

    if ( !$options['post_id'] || 'page' !== get_post_type( $options['post_id'] ) )
        return false;

    // get the depth of the current edit screen, same way we did in custom_acf_rule_values_page_depth()
    $depth = 0;
    $ancestors = get_ancestors( $options['post_id'], 'page' );
    if ( $ancestors ) {
        $depth = count( $ancestors );
    }

    if ( $depth == $rule['value'] ) {
        $match = true;

    } elseif ( $depth !== $rule['value'] ) {
        $match = false;
    }

    return $match;
}

add_filter( 'acf/location/rule_match/page_depth', 'custom_acf_rule_match_page_depth', 10, 3 );

/**
 * function for finding the top-level ancestor of the current page
 *
 * @param string|null $att
 * @return int $ancestor_id
 */
function get_top_ancestor( $att = 'id' ) {
    $ancestors = get_ancestors( get_the_ID(), 'page' );
    if ( count( $ancestors ) > 0 ) {
        $ancestors = array_reverse( $ancestors );
        $top_ancestor_id = $ancestors[0];
    } else {
        $top_ancestor_id = 0;
    }

    if ( $att == 'id' ) {
        $ancestor_id = $top_ancestor_id;
    } else if ( $att == 'title' ) {
        $ancestor_id = get_the_title( $top_ancestor_id );
    } else if ( $att == 'slug' ) {
        $ancestor_id = get_post( $top_ancestor_id )->post_name;
    } else {
        $ancestor_id = $top_ancestor_id;
    }

    return $ancestor_id;
}

/**
 * Gets the navigation depth level of the current page.
 *
 * @return int            the page's depth
 */
function get_page_depth() {
    global $post;
    $parent_id = $post->post_parent;
    $depth = 0;
    while ( $parent_id > 0 ) {
        $page = get_page( $parent_id );
        $parent_id = $page->post_parent;
        $depth++;
    }

    return $depth;
}

function get_copyright_info() {

  $start_year = get_field('copyright_year','option') ? get_field('copyright_year','option') : -1;
  $current_year = date("Y");

  if($start_year == -1) {

  	return 'COPYRIGHT NOT SET, SET IT IN THEME OPTIONS';

  } elseif($start_year < $current_year) {

    $year_range = "$start_year - $current_year";

  } else {

    $year_range = $start_year;
  }

  return "Copyright &copy; $year_range UNCG";
}

/**
 * @return int The depth of the current page.
 */
function get_current_page_depth() {
    global $wp_query;

    $object = $wp_query->get_queried_object();
    $parent_id  = $object->post_parent;
    $depth = 0;
    while($parent_id > 0){
        $page = get_page($parent_id);
        $parent_id = $page->post_parent;
        $depth++;
    }

    return $depth;
}

/**
 * @param  WP_post  $post  the current post object
 *
 * @return int The depth of the page
 */
function get_depth( WP_post $post ): int {

    return count(get_post_ancestors($post));
}

/**
 * @return mixed List items containing the current page and its siblings.
 */
function wpb_list_child_pages_menu() {

    global $post;

    if ( is_page() && $post->post_parent )
        $child_pages = wp_list_pages( '&sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
    else
        $child_pages = wp_list_pages( '&sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

    return $child_pages;
}

/**
 * Returns the value of a field from the nearest ancestor in which that field is set.
 *
 * @param $field String ACF Field to return.
 * @param null $element String Element of field return object to return (optional)
 * @return bool false if field does not exist, otherwise field value
 */
function get_field_from_ancestor( $field, $element = null ) {
    $page_id = get_the_ID();
    $ancestors = get_ancestors( $page_id, 'page' );

    $result = false;

    if ( count( $ancestors ) !== 0 ) {
        foreach ( $ancestors as $ancestor ) {
            if ( get_field( $field, $ancestor ) ) {
                $result = get_field( $field, $ancestor );
                break;
            }
        }

        if ( $result && $element !== null && isset( $result[$element] ) ) {
            $result = $result[ $element ];
        }
    } else {
        if ( get_field( $field ) ) {
            $result = get_field( $field );
        }

        if ( $result && $element !== null && isset( $result[$element] ) ) {
            $result = $result[ $element ];
        }
    }

    return $result;
}
