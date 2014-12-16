<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Child Theme' );
define( 'CHILD_THEME_URL', 'http://www.chrisubik.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue Google font
	add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
	function genesis_sample_google_fonts() {
		wp_enqueue_style( 'google-font-raleway', '//fonts.googleapis.com/css?family=Raleway:300,500', array(), CHILD_THEME_VERSION );
		wp_enqueue_style( 'google-font-bitter', '//fonts.googleapis.com/css?family=Bitter:400,700', array(), CHILD_THEME_VERSION );}

//* Add HTML5 markup structure
	add_theme_support( 'html5' );

//* Add custom Viewport meta tag for mobile browsers
	add_action( 'genesis_meta', 'cu_viewport_meta_tag' );
	function cu_viewport_meta_tag() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>'  . "\n";
	}

//* Add support for custom background
	add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'site-inner',
		'footer-widgets',
		'footer'
	) );

//* Add support for navigation menus
	add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

// Remove Unused Page Layouts
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Register Home Top widget area
    genesis_register_sidebar( array(
    	'id'            => 'home-top-solo',
    	'name'          => __( 'Home Top Solo', 'themename' ),
    	'description'   => __( 'This is a widget area that appears at the top of the home page', 'your-theme' ),
    ) );

//* Add the Home Top widget to home page
    add_action( 'genesis_before_content_sidebar_wrap', 'cu_homewidget' );
    function cu_homewidget() {
    	if ( is_home() )
    	genesis_widget_area( 'home-top-solo', array(
    		'before' => '<div id="home-top">',
    	) );
    }

//* Create Wigetized Homepage
	//* Register widget areas
	genesis_register_sidebar( array(
		'id'          => 'home-top',
		'name'        => __( 'Home - Top', 'your-theme' ),
		'description' => __( 'This is the top section of the Home page.', 'your-theme' ),
	) );

	genesis_register_sidebar( array(
		'id'          => 'home-middle',
		'name'        => __( 'Home - Middle', 'your-theme' ),
		'description' => __( 'This is the middle section of the Home page.', 'your-theme' ),
	) );

	genesis_register_sidebar( array(
		'id'          => 'home-middle-2',
		'name'        => __( 'Home - Middle 2', 'your-theme' ),
		'description' => __( 'This is the 2nd middle section of the Home page.', 'your-theme' ),
	) );

	genesis_register_sidebar( array(
		'id'          => 'home-bottom',
		'name'        => __( 'Home - Bottom', 'your-theme' ),
		'description' => __( 'This is the bottom section of the Home page.', 'your-theme' ),
	) );

//* Customize the post info function
	add_filter( 'genesis_post_info', 'cu_post_info_filter' );
	function cu_post_info_filter($post_info) {
	if ( !is_page() ) {
		$post_info = '[post_date] [post_edit]';
		return $post_info;
	}}