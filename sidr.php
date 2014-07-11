<?php
/**
 * Plugin Name: Sidr - Side Menus
 * Plugin URI: http://wpmu.org
 * Description: Adds the Sidr plugin to WordPress. Sidr is a jQuery plugin written by Alberto Valero http://www.berriart.com/sidr/
 * Version: 1.0
 * Author: Chris Knowles
 * Author URI: http://wpmu.org
 * License: GPL2
 */

/*
 *	Add the necessary styles and javascript files
 */
function sidr_scripts_styles(){

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'sidr' , plugins_url('js/jquery.sidr.min.js', __FILE__ ), array('jquery'), null, false );
	wp_enqueue_script( 'sidrinit' , plugins_url('js/sidr-init.js', __FILE__ ), array('sidr'), null, true );


	/*
	 * Loads stylesheet.
	 */
	wp_enqueue_style( 'sidr-style', plugins_url('stylesheets/jquery.sidr.dark.css', __FILE__ ) );

}

/*
 *  If the sidebars have widgets (are active) then add them to the bottom of the HTML
 */
function sidr_footer() {

	if ( is_active_sidebar( 'sidr-left' ) ) :
		echo ' 	<div id="sidr-left" class="sidebar-container sidr" role="complementary">
					<div class="sidr-toggle"><a class="sidr-left-link" href="#sidr-left">Close</a></div>
					<div class="widget-area">';
						dynamic_sidebar( 'sidr-left' );
		echo ' 		</div><!-- .widget-area -->
				</div><!-- #sidr-left -->';

	endif;

	if ( is_active_sidebar( 'sidr-right' ) ) :
		echo ' 	<div id="sidr-right" class="sidebar-container sidr" role="complementary">
					<div class="sidr-toggle"><a class="sidr-right-link" href="#sidr-right">Close</a></div>
					<div class="widget-area">';
						dynamic_sidebar( 'sidr-right' );
		echo ' 		</div><!-- .widget-area -->
				</div><!-- #sidr-right -->';
				
	endif;
				
}

/*
 *  Add a sidr specific menu
 */
function sidr_setup() {

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'sidr-menu', __( 'Sidr Menu' ) );

}

/*
 *  Create 2 new sidebars, one for the left and one for the right
 */ 
function sidr_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidr Left Sidebar' ),
		'id' => 'sidr-left',
		'description' => __( 'Left-hand Side Menu' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidr Right Sidebar' ),
		'id' => 'sidr-right',
		'description' => __( 'Right-hand Side Menu' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'wp_enqueue_scripts', 'sidr_scripts_styles' );
add_action( 'wp_footer' , 'sidr_footer' );
add_action( 'after_setup_theme', 'sidr_setup' );
add_action( 'widgets_init' , 'sidr_widgets_init' );
?>