<?php
/**
 * This file adds widgetized Home Page.
 *
 */

add_action( 'get_header', 'prefix_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function prefix_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-first' ) || is_active_sidebar( 'home-second' ) || is_active_sidebar( 'home-third' ) ||is_active_sidebar( 'home-fourth' ) || is_active_sidebar( 'home-fifth' ) ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Remove .site-inner
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
		add_filter( 'genesis_markup_content', '__return_null' );

		//* Add home widget areas
		add_action( 'genesis_after_header', 'prefix_home_widget_areas' );
	}
}

function prefix_home_widget_areas() {

	echo '</div></div><section id="home-top" class="clearfix"><div class="wrap">';
		genesis_widget_area( 'home-top', array(
			'before' => '<div class="home-top widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-top -->';

	echo '</div></div><section id="home-first" class="clearfix home-odd"><div class="wrap">';
		genesis_widget_area( 'home-first', array(
			'before' => '<div class="home-first widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-first -->';

	echo '</div></div><section id="home-second" class="clearfix home-even"><div class="wrap">';
		genesis_widget_area( 'home-second', array(
			'before' => '<div class="home-second widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-second -->';

	echo '</div></div><section id="home-third" class="clearfix home-odd"><div class="wrap">';
		genesis_widget_area( 'home-third', array(
			'before' => '<div class="home-third widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-third -->';

/*
	echo '</div></div><section id="home-fourth" class="clearfix home-even"><div class="wrap">';
		genesis_widget_area( 'home-fourth', array(
			'before' => '<div class="home-fourth widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-fourth -->';

	echo '</div></div><section id="home-fifth" class="clearfix home-odd"><div class="wrap">';
		genesis_widget_area( 'home-fifth', array(
			'before' => '<div class="home-fifth widget-area home-widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	echo '</div><!-- end wrap --></section><!-- end home-fifth -->';
*/

}

genesis();