<?php

/*
Plugin Name: Utrust for WooCommerce
Description: Take cryptocurrency payments in your WooCommerce store using Utrust.
Author: Utrust dev team
Version: 1.0.0-beta6
Requires at least: 5.0
Tested up to: 5.3
WC requires at least: 3.0
WC tested up to: 3.8.1
Text Domain: woocommerce-gateway-utrust
Author URI: https://utrust.com
License: GPL-3.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// Autoload vendor packages
require_once dirname(__FILE__) . '/vendor/autoload.php';

// Autoload required files
require_once dirname(__FILE__) . '/includes/utrust-loader.php';

define('UT_PLUGIN_FILE', __FILE__);
define('UT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('UT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('UT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WC_UTRUST_VERSION', 1.0);

UT_Start::get_instance();
