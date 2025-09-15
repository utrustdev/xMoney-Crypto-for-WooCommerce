<?php

/*
Plugin Name: xMoney Crypto for WooCommerce
Description: Take cryptocurrency payments in your WooCommerce store using xMoney.
Author: xMoney team
Version: 2.0.1
Requires at least: 6.6
Tested up to: 6.8
WC requires at least: 5.0.0
WC tested up to: 10.1.2
Text Domain: xmoney-crypto-for-woocommerce
Author URI: https://xmoney.com
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

// Adds plugin action links
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_plugin_actions_links');
function add_plugin_actions_links($links)
{
    $settings_link = array('<a href="admin.php?page=wc-settings&tab=checkout&section=utrust_gateway">' . __('Settings', 'xMoney-Crypto-for-WooCommerce') . '</a>');
    return array_merge($settings_link, $links);
}

//require_once plugin_dir_path(__FILE__) . 'includes/compatibility-hpos.php';

add_action('before_woocommerce_init', function() {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});
