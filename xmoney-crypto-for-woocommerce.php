<?php

/*
Plugin Name: xMoney Crypto for WooCommerce
Description: Take cryptocurrency payments in your WooCommerce store using xMoney.
Author: xMoney team
Version: 2.1.0
Requires at least: 6.6
Tested up to: 6.8
WC requires at least: 5.0.0
WC tested up to: 10.1.2
Text Domain: utrust-for-woocommerce
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
define('WC_UTRUST_VERSION', 2.0);

add_action('woocommerce_loaded', function () {
    UT_Start::get_instance();
});

// Adds plugin action links
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_plugin_actions_links');
function add_plugin_actions_links($links)
{
    $settings_link = array('<a href="admin.php?page=wc-settings&tab=checkout&section=utrust_gateway">' . __('Settings', 'utrust-for-woocommerce') . '</a>');
    return array_merge($settings_link, $links);
}

//require_once plugin_dir_path(__FILE__) . 'includes/compatibility-hpos.php';

add_action('before_woocommerce_init', function() {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, true);
    }
});
/**
 * Do necessary things for block checkout compatibility.
 *
 * @since 2.2.3
 */
add_action('woocommerce_blocks_loaded', 'register_utrust_block_compatibly', 30);

function register_utrust_block_compatibly()
{
    // Load the block class
    if (
        class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType') &&
        file_exists(__DIR__ . '/includes/block.php')
    ) {
        require_once __DIR__ . '/includes/block.php';

        // Register block after Boodil if present
        add_action('woocommerce_blocks_payment_method_type_registration', 'register_utrust_payment_block', 30);
    }
}

function register_utrust_payment_block($payment_method_registry)
{
    if (class_exists('WC_UTRUST_Block')) {
        $utrust_block = new WC_UTRUST_Block();
        $utrust_block->initialize(); // Ensure it's initialized before registration
        $payment_method_registry->register($utrust_block);
    } else {
        WC_Utrust_Logger::log('[Utrust] Block class not found.');
    }
}
