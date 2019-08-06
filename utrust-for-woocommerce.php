<?php

/*
  Plugin Name: UTRUST for WooCommerce
  Description: Take cryptocurrency payments in your store using UTRUST.
  Author: UTRUST team
  Version: 0.0.2
  Text Domain: woocommerce-gateway-utrust
  Author URI: https://utrust.com
  License: Open Source
*/

if (! defined( 'ABSPATH' ) ) {
    exit(); // Exit if accessed directly
}

// Autoload required files
require_once dirname( __FILE__ ) . '/includes/utrust-loader.php';

define( 'UT_PLUGIN_FILE', __FILE__ );
define( 'UT_PLUGIN_BASENAME', plugin_basename(__FILE__) );
define( 'UT_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'UT_PLUGIN_URL', plugin_dir_url(__FILE__) );
define( 'WC_UTRUST_VERSION', 1.0 );

UT_Start::get_instance();
