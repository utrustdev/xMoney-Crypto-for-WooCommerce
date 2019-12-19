<?php

if ( !defined( 'ABSPATH' ) ) {
	exit(); // Exit if accessed directly
}

/**
* Main Plugin class
*/
if( !class_exists( 'UT_Start' ) ) {

	class UT_Start {

		// Singleton design pattern
		protected static $instance = NULL;

		// Method to return the singleton instance
		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {

			add_filter( 'init', array( $this, 'includes' ) );
			add_filter( 'woocommerce_payment_gateways', array( $this, 'payment_gateways' ) );

			// enqueue plugin scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'payment_frontend_scripts' ) );
		}

		public function payment_frontend_scripts() {

			wp_register_style( 'utrust_frontend_styles', plugins_url( 'assets/css/main.css', UT_PLUGIN_FILE ), array(), WC_UTRUST_VERSION );
			wp_enqueue_style( 'utrust_frontend_styles' );
		}

		// Include needed files
		public function includes() {

			require_once( UT_PLUGIN_PATH . '/includes/class-wc-gateway-utrust.php' );
			require_once( UT_PLUGIN_PATH . '/includes/class-wc-utrust-logger.php' );
			require_once( UT_PLUGIN_PATH . '/includes/class-wc-utrust-webhooks.php' );
			require_once( UT_PLUGIN_PATH . '/includes/external/class-wc-utrust-api.php' );

			// Handle utrust webhooks
			new UT_Webhooks();
		}

		/**
		 * Register the utrust payment methods.
		 *
		 * @param array $methods Payment methods.
		 *
		 * @return array Payment methods
		 */
		public function payment_gateways( $methods ) {
			$methods[] = 'WC_Gateway_Utrust';

			return $methods;
		}
	}
}
