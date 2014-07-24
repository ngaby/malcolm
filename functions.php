<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'malcolm', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/lib/languages', 'malcolm' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Malcolm Theme', 'malcolm' ) );
define( 'CHILD_THEME_URL', 'http://wpcanada.ca/our-themes/malcolm' );
define( 'CHILD_THEME_VERSION', '1.2.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'malcolm_enqueue_scripts' );
function malcolm_enqueue_scripts() {

	wp_enqueue_script( 'malcolm-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'malcolm_enqueue_styles' );
function malcolm_enqueue_styles() {

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Oswald:400,700|Open+Sans:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'malcolm-dashicons-style', get_stylesheet_uri(), array('dashicons'), '1.0' );
}

//* Add new image sizes
add_image_size( 'featured-page', 340, 160, TRUE );
add_image_size( 'featured-post', 100, 100, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Reposition the primary navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Add before entry widget area to single post page
add_action( 'genesis_before_entry', 'malcolm_before_entry'  ); 
function malcolm_before_entry() {

    if ( ! is_singular( 'post' ) )
    	return;

    genesis_widget_area( 'before-entry', array(
		'before' => '<div class="before-entry widget-area"><div class="wrap">',
		'after'  => '</div></div>',
    ) );

}

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

//* Add wrapper to breadcrumbs
add_filter( 'genesis_breadcrumb_args', 'malcolm_breadcrumb_args' );
function malcolm_breadcrumb_args( $args ) {
	$args['prefix'] = '<div class="breadcrumbwrapper"><div class="breadcrumb">';
	$args['suffix'] = '</div></div>';
	$args['sep'] = ' &raquo; ';
    return $args;
}

//* Add single post navigation
add_action( 'genesis_after_entry', 'genesis_prev_next_post_nav', 9 );

//* Customize the post info function
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter( $post_info ) {
if ( !is_page() ) {
	$post_info = '[post_date] [post_author_link] [post_comments] [post_edit]';
	return $post_info;
}}

//* Unhook Genesis footer and add custom widget area
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'malcolm_footer' );
function malcolm_footer() {
                genesis_widget_area( 'malcolm_footer', array(
		'before' => '<div class="malcolm_footer widget-area">',
		'after'  => '</div>',
    ) );

}
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function cd_add_editor_styles() {

    add_editor_style( 'style-editor.css' );

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'		=> 'slider',
	'name'		=> __( 'Slider', 'malcolm' ),
	'description'	=> __( 'This is the Slider section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-top-message',
	'name'		=> __( 'Home Top Message', 'malcolm' ),
	'description'	=> __( 'This is the Home Top Message section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-action',
	'name'		=> __( 'Home Action', 'malcolm' ),
	'description'	=> __( 'This is the Home Action section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-bottom-1',
	'name'		=> __( 'Home Bottom 1', 'malcolm' ),
	'description'	=> __( 'This is the Home Bottom 1 section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-bottom-2',
	'name'		=> __( 'Home Bottom 2', 'malcolm' ),
	'description'	=> __( 'This is the Home Bottom 2 section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-bottom-3',
	'name'		=> __( 'Home Bottom 3', 'malcolm' ),
	'description'	=> __( 'This is the Home Bottom 3 section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'pre-footer-1',
	'name'		=> __( 'Pre Footer 1', 'malcolm' ),
	'description'	=> __( 'This is the Pre Footer 1 section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'pre-footer-2',
	'name'		=> __( 'Pre Footer 2', 'malcolm' ),
	'description'	=> __( 'This is the Pre Footer 2 section of the homepage.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'before-entry',
	'name'		=> __( 'Before Entry', 'malcolm' ),
	'description'	=> __( 'Widgets in this widget area will display before single entries.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'widget-page',
	'name'		=> __( 'Widget Page', 'malcolm' ),
	'description'	=> __( 'This is the Widget Page template.', 'malcolm' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'malcolm_footer',
	'name'		=> __( 'Malcolm Footer', 'malcolm' ),
	'description'	=> __( 'This is the custom footer area.', 'malcolm' ),
) );
