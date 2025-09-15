<?php
if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

class WC_Gateway_UTRUST extends WC_Payment_Gateway
{
    public $instructions; // Declare the property
    /**
     * Constructor for the gateway.
     */
    public function __construct()
    {
        
        $this->id = 'utrust_gateway';
        $this->supports = array('products');

        $this->icon = apply_filters('woocommerce_offline_icon', '');
        $this->has_fields = false;
        $this->method_title = __('Utrust', 'xMoney-Crypto-for-WooCommerce');
        $this->method_description = __('Allows Cryptocurrencies payments.', 'xMoney-Crypto-for-WooCommerce');

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        // Define user set variables
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->instructions = $this->get_option('instructions', $this->description);

        // Actions
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));

        // Customer Emails
        add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);
    }

    /**
     * Initialize Gateway Settings Form Fields
     */
    public function init_form_fields()
    {

        $this->form_fields = apply_filters('wc_utrust_form_fields', array(

            'enabled' => array(
                'title' => __('Enable/Disable', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'checkbox',
                'label' => __('Enable Utrust Payments', 'xMoney-Crypto-for-WooCommerce'),
                'default' => 'yes',
            ),

            'title' => array(
                'title' => __('Title', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'text',
                'description' => __('This controls the title for the payment method the customer sees during checkout.', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'default' => __('Utrust', 'xMoney-Crypto-for-WooCommerce'),
            ),

            'description' => array(
                'title' => __('Description', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'textarea',
                'description' => __('Payment method instructions that the customer will see on your checkout.', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'default' => __('You will be redirected to the Utrust payment widget compatible with any major crypto wallets. It will allow you to pay for your purchase in a safe and seamless way using Bitcoin, Ethereum, Tether or a number of other currencies.', 'xMoney-Crypto-for-WooCommerce'),
            ),

            'environment' => array(
                'title' => __('Environment', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'select',
                'class' => 'wc-enhanced-select',
                'description' => __('This setting specifies whether you will process live transactions, or whether you will process simulated transactions using the Utrust sandbox.', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'options' => array(
                    'production' => __('Live (Production)', 'xMoney-Crypto-for-WooCommerce'),
                    'sandbox' => __('Test (Sandbox)', 'xMoney-Crypto-for-WooCommerce'),
                ),
                'default' => 'production',
            ),

            'api_key' => array(
                'title' => __('API Key', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'text',
                'description' => __('Utrust API Key', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'default' => '',
            ),

            'webhook_secret' => array(
                'title' => __('Webhook Secret', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'password',
                'description' => __('Utrust Webhook secret', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'default' => '',
            ),

            'order_created_status' => array(
                'title' => __('Order Created status', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'select',
                'description' => __('Choose your prefered order status when the order is created on Utrust. This happens in the moment that the customer places the order on the checkout.', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'options' => wc_get_order_statuses(),
                'default' => 'wc-pending',
            ),

            'checkout_image' => array(
                'title' => __('Checkout Image', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'select',
                'class' => 'wc-enhanced-select',
                'description' => __('This image will be displayed in the Checkout page.', 'xMoney-Crypto-for-WooCommerce'),
                'desc_tip' => true,
                'options' => array(
                    'default' => __('Default (for light websites)', 'xMoney-Crypto-for-WooCommerce'),
                    'white' => __('White (for dark websites)', 'xMoney-Crypto-for-WooCommerce'),
                ),
                'default' => 'default',
            ),

            'callback_url' => array(
                'title' => __('Callback URL', 'xMoney-Crypto-for-WooCommerce'),
                'type' => 'text',
                'description' => __('The default callback_url is /?wc-api=wc_utrust<br />If you are using <strong>WPML plugin</strong>, you also need to pass the lang parameter. E.g.:<br />/?lang=en&wc-api=wc_utrust', 'xMoney-Crypto-for-WooCommerce'),
                'default' => get_site_url() . '/?wc-api=wc_utrust',
            ),
        ));
    }

    /**
     * Output for the order received page.
     */
    public function thankyou_page()
    {
        /*if ( $this->instructions ) {
    echo wpautop( wptexturize( $this->instructions ) );
    }*/
    }

    /**
     * Add content to the WC emails.
     *
     * @access public
     * @param WC_Order $order
     * @param bool $sent_to_admin
     * @param bool $plain_text
     */
    public function email_instructions($order, $sent_to_admin, $plain_text = false)
    {
        if ($this->instructions && !$sent_to_admin && $this->id === $order->get_payment_method() && $order->has_status('wc-on-hold')) {
            echo esc_html(wpautop(wptexturize($this->instructions))) . PHP_EOL;
        }
    }

    /**
     * Get the return url (thank you page).
     *
     * @param WC_Order $order Order object.
     * @return string
     */
    public function get_return_url($order = null)
    {
        if ($order) {
            $return_url = $order->get_checkout_order_received_url();
        } else {
            $return_url = wc_get_endpoint_url('order-received', '', wc_get_page_permalink('checkout'));
        }

        if (is_ssl() || get_option('woocommerce_force_ssl_checkout') == 'yes') {
            $return_url = str_replace('http:', 'https:', $return_url);
        }

        return apply_filters('woocommerce_get_return_url', $return_url, $order);
    }

    /**
     * Get icon.
     * @return string
     */
    public function get_icon()
    {
        $filename = "";

        if ($this->get_option('checkout_image') === 'default') {
           // $filename = 'checkout_image.png';
            $filename = 'new-checkout-image.png';
        } else {
            $filename = 'checkout_image_white.png';
        }

        $icon_html = '<img src="' . UT_PLUGIN_URL . 'assets/images/' . $filename . '" alt="' . $this->title . '" style="height: 24px; padding-left: 6px;"/>';

        return apply_filters('woocommerce_gateway_icon', $icon_html, $this->id);
    }

    /**
     * Payment fields.
     * @return string
     */
    public function payment_fields()
    {?>
		<fieldset style="background: transparent;">
			<p class="form-row form-row-wide">
				<?php echo esc_html($this->description); ?>
			</p>
			<div class="clear"></div>
		</fieldset> <?php
}

    /**
     * Get Utrust redirect to payment widget Url.
     * @return string
     */
    public function get_utrust_redirect($order)
    {

        $api = new WC_UTRUST_API();
        $result = $api->create_order($order);

        if (isset($result->attributes->redirect_url)) {
            return $result->attributes->redirect_url;
        }

        return false;
    }

    /**
     * Process the payment and return the result
     *
     * @param int $order_id
     * @return array
     */
    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);

        $redirect_url = $this->get_utrust_redirect($order);

        if ($redirect_url) {

            // Change order status (we're awaiting the payment)
            $order->update_status($this->get_option('order_created_status'));

            $url_parts = wp_parse_url($redirect_url);
            parse_str($url_parts['query'], $url_array);

            $utrust_id = isset($url_array['uuid']) ? $url_array['uuid'] : '';
            if ($utrust_id) {
                update_post_meta($order_id, '_utrust_order_uuid', $utrust_id);
            }
        }

        do_action('wc_payment_gateway_utrust_payment_processed', $order, $this);

        $result = ($redirect_url) ? 'success' : 'failure';

        // Return thankyou redirect
        return array(
            'result' => $result,
            'redirect' => $redirect_url ?: '',
        );
    }
}
