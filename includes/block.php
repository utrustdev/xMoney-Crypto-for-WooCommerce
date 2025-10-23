<?php

    use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

    /**
     * Class for handling Utrust Payment block checkout support.
     */
    final class WC_UTRUST_Block extends AbstractPaymentMethodType
    {

        /**
         * The Utrust Payment gateway instance.
         *
         * @var WC_Gateway_UTRUST
         */
        private $gateway;

        /**
         * The name of the payment method.
         *
         * @var string
         */
        protected $name = 'utrust_gateway';

        /**
         * Initializes the Utrust Payment block.
         */
        public function initialize()
        {
            if (!class_exists('WC_Gateway_UTRUST')) {
                require_once UT_PLUGIN_PATH . 'includes/class-wc-gateway-utrust.php'; // Adjust the path if needed.
            }

            $this->settings = get_option('woocommerce_utrust_gateway_settings', array());
            $gateways = WC()->payment_gateways->payment_gateways();

            if (isset($gateways[$this->name])) {
                $this->gateway = $gateways[$this->name];
            } else {
                $this->gateway = null;
            }
        }


        /**
         * Checks if the payment method is active.
         */
        public function is_active()
        {
            return $this->gateway && $this->gateway->is_available();
        }

        /**
         * Retrieves the script handles for the payment method.
         */
        public function get_payment_method_script_handles()
        {
            // Only register the script if the payment method is active
            if ($this->is_active()) {
                wp_register_script(
                    'wc-utrust-payment-blocks-integration',
                    plugins_url('js/checkout.js', __FILE__),
                    array(
                        'wc-blocks-registry',
                        'wc-settings',
                        'wp-element',
                        'wp-html-entities',
                        'wp-i18n',
                    ),
                    WC_UTRUST_VERSION,
                    true
                );

                return array('wc-utrust-payment-blocks-integration');
            }

            return array(); // Return empty if not active
        }

        /**
         * Retrieves the payment method data.
         */
        public function get_payment_method_data()
        {
            if ($this->is_active()) {
                return array(
                    'title' => $this->gateway->title,
                    'description' => $this->gateway->description,
                );
            }

            return array(); // Return empty if not active
        }
    }
