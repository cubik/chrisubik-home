<?php
//* Start the engine
	include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'ChrisUbik.com Theme' );
	define( 'CHILD_THEME_URL', 'http://www.chrisubik.com/' );
	define( 'CHILD_THEME_VERSION', '1.2.0' );

//* Enqueue Google fonts
	add_action( 'wp_enqueue_scripts', 'cu_google_fonts' );
	function cu_google_fonts() {
/* 		wp_enqueue_style( 'google-font-Montserrat', '//fonts.googleapis.com/css?family=Montserrat:300,400,700', array(), CHILD_THEME_VERSION ); */
		wp_enqueue_style('google-font-ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:400,500,700', array () );
	}

//* Load Font Awesome
	add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
	function enqueue_font_awesome() {
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
}

//* Add HTML5 markup structure
	add_theme_support( 'html5', array('search-form'));

//* Add Viewport meta tag for mobile browsers (requires HTML5 theme support)
	add_theme_support( 'genesis-responsive-viewport' );

//* Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array('header', 'nav', 'subnav', 'site-inner', 'footer-widgets', 'footer' ) );

//* Clean <HEAD>
	//* Remove rsd link
	remove_action( 'wp_head', 'rsd_link' );
	//* Remove Windows Live Writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	//* Remove index link
	remove_action( 'wp_head', 'index_rel_link' );
	//* Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	//* Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	//* Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	//* Remove WP version
	remove_action( 'wp_head', 'wp_generator' );

//* Remove Genesis widgets
	function gregr_remove_genesis_widgets() {
		unregister_widget( 'Genesis_eNews_Updates' );
		unregister_widget( 'Genesis_Featured_Page' );
		/* unregister_widget( 'Genesis_User_Profile_Widget' ); */
		unregister_widget( 'Genesis_Menu_Pages_Widget' );
		unregister_widget( 'Genesis_Widget_Menu_Categories' );
		unregister_widget( 'Genesis_Featured_Post' );
		unregister_widget( 'Genesis_Latest_Tweets_Widget' );
	}

//* Remove Unused Page Layouts
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Remove Header Right Widget Area
	unregister_sidebar( 'header-right' );

//* Add support for custom background
	/* 	add_theme_support( 'custom-background' ); */

//* Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

//* Create Wigetized Homepage

//* Register Parallax widget area
	genesis_register_sidebar( array(
		'id'          => 'parallax-section-below-header',
		'name'        => __( 'Parallax Section Below Header', 'chrisubik' ),
		'description' => __( 'This is the parallax section below header.', 'chrisubik' ),
	) );

	//* Register other widget areas
/*
	genesis_register_sidebar( array(
		'id'		   => 'home-top',
		'name'		   => __( 'Hero Unit', 'chrisubik' ),
		'description' => __( 'This is the top Hero Unit section of the Home page.', 'chrisubik' ),
	) );
*/

	genesis_register_sidebar( array(
		'id'		   => 'home-first',
		'name'		   => __( 'Home - First', 'chrisubik' ),
		'description' => __( 'This is the first section of the Home page.', 'chrisubik' ),
	) );

	genesis_register_sidebar( array(
		'id'		   => 'home-second',
		'name'		   => __( 'Home - Second', 'chrisubik' ),
		'description' => __( 'This is the second section of the Home page.', 'chrisubik' ),
	) );

	genesis_register_sidebar( array(
		'id'		   => 'home-third',
		'name'		   => __( 'Home - Third', 'chrisubik' ),
		'description' => __( 'This is the third section of the Home page.', 'chrisubik' ),
	) );

/*
	genesis_register_sidebar( array(
		'id'		   => 'home-fourth',
		'name'		   => __( 'Home - Fourth', 'chrisubik' ),
		'description' => __( 'This is the fourth section of the Home page.', 'chrisubik' ),
	) );

	genesis_register_sidebar( array(
		'id'		   => 'home-fifth',
		'name'		   => __( 'Home - Fifth', 'chrisubik' ),
		'description' => __( 'This is the fifth section of the Home page.', 'chrisubik' ),
	) );
*/


//* Enqueue Parallax script
	add_action( 'wp_enqueue_scripts', 'enqueue_parallax_script' );
	function enqueue_parallax_script() {
		if ( ! wp_is_mobile() ) {
			wp_enqueue_script( 'parallax-script', get_bloginfo( 'stylesheet_directory' ) . '/js/parallax.js', array( 'jquery' ), '1.0.0' );
		}
	}

//* Hooks parallax-section-below-header widget area after header
	add_action( 'genesis_after_header', 'parallax_section_below_header' );
	function parallax_section_below_header() {
		genesis_widget_area( 'parallax-section-below-header', array(
			'before' => '<div class="below-header parallax-section widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}

//* Move Primary Nav to Header
	Remove_action('genesis_after_header','genesis_do_nav');
	Add_action('genesis_header_right','genesis_do_nav');

/* Change the order of the Simple Social Icons, Change SSI to FontAwesome */
add_filter( 'simple_social_default_profiles', 'custom_simple_social_default_profiles' );
function custom_simple_social_default_profiles() {
	$glyphs = array(
			'dribbble'		=> '&#xf17d;',
			'email'			=> '&#xf0e0;',
			'facebook'		=> '&#xf09a;',
			'flickr'		=> '&#xf16e;',
			'github'		=> '&#xf09b;',
			'gplus'			=> '&#xf0d5;',
			'instagram' 	=> '&#xf16d;',
			'linkedin'		=> '&#xf0e1;',
			'pinterest'		=> '&#xf0d2;',
			'rss'			=> '&#xf09e;',
			'stumbleupon'	=> '&#xf1a4;',
			'tumblr'		=> '&#xf173;',
			'twitter'		=> '&#xf099;',
			'vimeo'			=> '&#xf194;',
			'youtube'		=> '&#xf167;',
		);

	$profiles = array(
			'dribbble' => array(
				'label'	  => __( 'Dribbble URI', 'ssiw' ),
				'pattern' => '<li class="social-dribbble"><a href="%s" %s>' . $glyphs['dribbble'] . '</a></li>',
			),
			'email' => array(
				'label'	  => __( 'Email URI', 'ssiw' ),
				'pattern' => '<li class="social-email"><a href="%s" %s>' . $glyphs['email'] . '</a></li>',
			),
			'linkedin' => array(
				'label'	  => __( 'Linkedin URI', 'ssiw' ),
				'pattern' => '<li class="social-linkedin"><a href="%s" %s>' . $glyphs['linkedin'] . '</a></li>',
			),
			'twitter' => array(
				'label'	  => __( 'Twitter URI', 'ssiw' ),
				'pattern' => '<li class="social-twitter"><a href="%s" %s>' . $glyphs['twitter'] . '</a></li>',
			),
			'gplus' => array(
				'label'	  => __( 'Google+ URI', 'ssiw' ),
				'pattern' => '<li class="social-gplus"><a href="%s" %s>' . $glyphs['gplus'] . '</a></li>',
			),
			'flickr' => array(
				'label'	  => __( 'Flickr URI', 'ssiw' ),
				'pattern' => '<li class="social-flickr"><a href="%s" %s>' . $glyphs['flickr'] . '</a></li>',
			),
			'instagram' => array(
				'label'	  => __( 'Instagram URI', 'ssiw' ),
				'pattern' => '<li class="social-instagram"><a href="%s" %s>' . $glyphs['instagram'] . '</a></li>',
			),
			'facebook' => array(
				'label'	  => __( 'Facebook URI', 'ssiw' ),
				'pattern' => '<li class="social-facebook"><a href="%s" %s>' . $glyphs['facebook'] . '</a></li>',
			),
			'github' => array(
				'label'	  => __( 'GitHub URI', 'ssiw' ),
				'pattern' => '<li class="social-github"><a href="%s" %s>' . $glyphs['github'] . '</a></li>',
			),
			'pinterest' => array(
				'label'	  => __( 'Pinterest URI', 'ssiw' ),
				'pattern' => '<li class="social-pinterest"><a href="%s" %s>' . $glyphs['pinterest'] . '</a></li>',
			),
			'rss' => array(
				'label'	  => __( 'RSS URI', 'ssiw' ),
				'pattern' => '<li class="social-rss"><a href="%s" %s>' . $glyphs['rss'] . '</a></li>',
			),
			'stumbleupon' => array(
				'label'	  => __( 'StumbleUpon URI', 'ssiw' ),
				'pattern' => '<li class="social-stumbleupon"><a href="%s" %s>' . $glyphs['stumbleupon'] . '</a></li>',
			),
			'tumblr' => array(
				'label'	  => __( 'Tumblr URI', 'ssiw' ),
				'pattern' => '<li class="social-tumblr"><a href="%s" %s>' . $glyphs['tumblr'] . '</a></li>',
			),
			'vimeo' => array(
				'label'	  => __( 'Vimeo URI', 'ssiw' ),
				'pattern' => '<li class="social-vimeo"><a href="%s" %s>' . $glyphs['vimeo'] . '</a></li>',
			),
			'youtube' => array(
				'label'	  => __( 'YouTube URI', 'ssiw' ),
				'pattern' => '<li class="social-youtube"><a href="%s" %s>' . $glyphs['youtube'] . '</a></li>',
			),
		);
	return $profiles;
}

//* Add Location to Projects
	function cu_projects_fields( $fields ) {
		$fields['location'] = array(
			 'name' 				=> __( 'Location', 'projects' ),
			 'description' => __( 'Enter a location for this project.', 'projects' ),
			 'type' 				=> 'text',
			 'default' 		=> '',
			 'section' 		=> 'info'
		);
		return $fields;
	}
	add_filter( 'projects_custom_fields', 'cu_projects_fields' );

//* Use jQuery Google API
	function cu_modify_jquery() {
		if (!is_admin()) {
			//* comment out the next two lines to load the local copy of jQuery
			wp_deregister_script('jquery');
			wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', '1.11.0', '', true );
			wp_enqueue_script('jquery');
		}
	}
	add_action('init', 'cu_modify_jquery');

//* Customize search form input box text
	add_filter( 'genesis_search_text', 'cu_search_text' );
	function cu_search_text( $text ) {
		return esc_attr( 'You know what to do...' );
	}

//* Replace login logo
function cu_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/Cu_Icon80x80_blue_flat@2x.png);
			padding-bottom: 30px;
		}
	</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'cu_login_logo' );

// Replace logo URL
    function cu_login_logo_url() {
            return home_url();
        }
    add_filter( 'login_headerurl', 'cu_login_logo_url' );

    function cu_login_logo_url_title() {
        return 'ChrisUbik.com';
    }
    add_filter( 'login_headertitle', 'cu_login_logo_url_title' );


//* Customize the credits
	add_filter( 'genesis_footer_creds_text', 'cu_footer_creds_text' );
	function cu_footer_creds_text() {
		echo '<div class="creds"><p>';
		echo 'Copyright &copy; ';
		echo date('Y');
		echo ' &middot; <a href="http://www.chrisubik.com">Chris Ubik</a>. Site licenced under <a href="http://creativecommons.org/licenses/by-nc/4.0/">CC BY-NC 4.0</a>' ;
		echo '</p></div>';
	}

//* Give child theme style sheet a higher priority
	//* Remove Genesis child theme style sheet
		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	//* Enqueue Genesis child theme style sheet at higher priority
		add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 15 );


//* WooThemes Project Tweaks
	function projects_categories_menu() {
		the_widget( 'Woothemes_Widget_Project_Categories', 'title=&hierarchical=0&count=1' );
	}
	add_action( 'projects_before_loop', 'projects_categories_menu' );
	remove_action( 'projects_sidebar', 'projects_get_sidebar', 10 );

?>