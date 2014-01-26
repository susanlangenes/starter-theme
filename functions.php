<?php
/**
 * Starter Theme functions and definitions
 *
 * @package Starter Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'starter_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function starter_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Starter Theme, use a find and replace
	 * to change 'starter-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'starter-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'starter-theme' ),
		'footer'  => __( 'Footer Menu', 'starter-theme' ),//footer
		'flyout' => __( 'Flyout Menu', 'starter-theme' ),
		'off-page' => __( 'Off-Page Menu', 'starter-theme' ),
		'overlay' => __( 'Overlay Menu', 'starter-theme' ),
	) );

	// Enable support for Post Formats.
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'starter_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // starter_theme_setup
add_action( 'after_setup_theme', 'starter_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function starter_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header Sidebar', 'starter-theme' ),
		'description'   => __( 'Sidebar for the right side of header on all pages' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'starter-theme' ),
		'description'   => __( 'Main Sidebar for the right column of posts and pages with content/sidebar layout' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'starter-theme' ),
		'description'   => __( 'Secondary Sidebar for the left column for posts and pages with sidebar/content/sidebar layout' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebars(4, array( //an easier structure for Julia's typical widget design
		'name'          => 'Footer %d',
		'id'            => "footer-sidebar",
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="inner-widget-area">',
	) );
	  register_sidebar( array(
    'name'          => __( 'Home 3-Column', 'starter-theme' ),
    'id'            => 'sidebar-3',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'starter_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function starter_theme_scripts() {
	wp_enqueue_style( 'starter-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'starter-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

function wfd_superfish_scripts()  
{  
    // Register each script, setting appropriate dependencies  
    wp_register_script('hoverintent', get_stylesheet_directory_uri() . '/js/hoverIntent.js');   
    wp_register_script('superfish',   get_stylesheet_directory_uri() . '/js/superfish.js', array( 'jquery', 'hoverintent' )); 
    wp_enqueue_script('jquery-menubar', get_stylesheet_directory_uri() . '/js/menubar.js', array( 'jquery', 'superfish' ));
  
    // Enqueue superfish, we don't need to enqueue any others in this case, as the dependencies take care of it for us  
    wp_enqueue_script('jquery-menubar'); 
 
    // Register each style, setting appropriate dependencies 
    // wp_register_style('superfishbase',   get_stylesheet_directory_uri() . '/css/superfish.css'); 
 
    // Enqueue superfishbase
    // wp_enqueue_style('superfishbase');  
}  
add_action( 'wp_enqueue_scripts', 'wfd_superfish_scripts' );


// Styling the visual editor with editor-style.css to match the theme style.
add_editor_style();

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

	function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Heading of Custom Dashboard Widget', 'custom_dashboard_help');
	}

	function custom_dashboard_help() {
	echo '<p>Write instructions here.  Use backslashes to escape any quotes \'like this\'.</p>
	<p style="font-weight:bold;color:red;">Questions or need help? Use the <a href="http://codex.wordpress.org/">WordPress Codex</a>, or contact Susan <a href="mailto:susan@collagecreative.net">here</a>.</p>';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
