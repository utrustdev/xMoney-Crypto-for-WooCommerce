<?php

/*
Plugin Name: WooCommerce Utrust Payment
Description: This plugin adds Utrust payment method to WooCommerce
Version: 0.1
Author: Hellodev
Text Domain: hd-woocommerce-utrust
Author URI: http://hellodev.us
License: Closed Source
*/

if ( !class_exists( 'hd_woocommerce_utrust' ) ) {

	class hd_woocommerce_utrust {
	
		public function __construct(){
		}
	}
}
if ( class_exists( 'hd_woocommerce_utrust' ) ) {

	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
	}
	
	define('HD_WC_UT_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
	define('HD_WC_UT_PLUGIN_FILE', __FILE__);
	
	// Create new object
	new hd_woocommerce_utrust();
}
