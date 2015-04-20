<?php

namespace Athletics\Social_Utilities;

/**
 * Plugin Name: Social Utilities
 * Plugin URI: http://github.com/athletics/social-utilities
 * Description: Utilities for working with social networks.
 * Version: 0.2.2
 * Author: Athletics
 * Author URI: http://athleticsnyc.com
 * Copyright: 2015 Athletics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

require_once( __DIR__ . '/inc/social-utilities.php' );

/**
 * Enqueue the social utilities script for loading social libraries asynchronously.
 */
function enqueue_script() {

	wp_enqueue_script(
		$handle = 'athletics-social-utilities',
		$src = plugins_url( 'js/social-junk.min.js', __FILE__ ),
		$deps = array(),
		$ver = '0.2.2',
		$in_footer = true
	);

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_script' );