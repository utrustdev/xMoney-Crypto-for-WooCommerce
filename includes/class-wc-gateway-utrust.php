<?php
if ( !defined( 'ABSPATH' ) ) {
	exit(); // Exit if accessed directly
}

class WC_Gateway_UTRUST extends WC_Payment_Gateway {
	/**
	* Constructor for the gateway.
	*/
	public function __construct() {

		$this->id                 = 'utrust_gateway';
		$this->icon               = apply_filters('woocommerce_offline_icon', '');
		$this->has_fields         = false;
		$this->method_title       = __( 'UTRUST', 'woocommerce-utrust' );
		$this->method_description = __( 'Allows UTRUST payments.', 'woocommerce-utrust' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->title        = $this->get_option( 'title' );
		$this->description  = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions', $this->description );

		// Actions
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'thankyou_page' ) );

		// Customer Emails
		add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );

		$this->order_button_text = __( 'Continue to payment', 'woocommerce-utrust' );
	}


	/**
	* Initialize Gateway Settings Form Fields
	*/
	public function init_form_fields() {

		$this->form_fields = apply_filters( 'wc_utrust_form_fields', array(

			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'woocommerce-utrust' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable UTRUST Payments', 'woocommerce-utrust' ),
				'default' => 'yes'
			),

			'title' => array(
				'title'       => __( 'Title', 'woocommerce-utrust' ),
				'type'        => 'text',
				'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'woocommerce-utrust' ),
				'default'     => __( 'UTRUST', 'woocommerce-utrust' ),
				'desc_tip'    => true,
			),

			'description' => array(
				'title'       => __( 'Description', 'woocommerce-utrust' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce-utrust' ),
				'default'     => __( 'Pay with Cryptocurrencies', 'woocommerce-utrust' ),
				'desc_tip'    => true,
			),

			'environment' => array(
				'title'       => __( 'Environment', 'woocommerce-utrust' ),
				'type'        => 'select',
				'class'       => 'wc-enhanced-select',
				'description' => __( 'This setting specifies whether you will process live transactions, or whether you will process simulated transactions using the UTRUST Sandbox.', 'woocommerce-utrust' ),
				'default'     => 'live',
				'desc_tip'    => true,
				'options'     => array(
					'live'    => __( 'Live', 'woocommerce-utrust' ),
					'sandbox' => __( 'Test mode (Sandbox)', 'woocommerce-utrust' ),
				),
			),

			'client_id' => array(
				'title'       => __( 'Client ID', 'woocommerce-utrust' ),
				'type'        => 'text',
				'description' => __( 'UTRUST Client ID', 'woocommerce-utrust' ),
				'default'     => __( '', 'woocommerce-utrust' ),
				'desc_tip'    => true,
			),

			'client_secret' => array(
				'title'       => __( 'Client Secret', 'woocommerce-utrust' ),
				'type'        => 'password',
				'description' => __( 'UTRUST Client secret.', 'woocommerce-utrust' ),
				'default'     => __( '', 'woocommerce-utrust' ),
				'desc_tip'    => true,
			),

			'callback_url' => array(
				'title'       => __( 'Callback URL', 'woocommerce-utrust' ),
				'type'        => 'text',
				'description' => __( 'The default callback_url is ' . get_site_url() . '/?wc-api=wc_utrust<br />If you are using <strong>WPML plugin</strong>, you also need to pass the lang parameter. E.g.:<br />' . get_site_url() . '/?lang=en&wc-api=wc_utrust', 'woocommerce-utrust' ),
				'default'     => __( get_site_url() . '/?wc-api=wc_utrust', 'woocommerce-utrust' ),
			),
		) );
	}


	/**
	* Output for the order received page.
	*/
	public function thankyou_page() {
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
	public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {

		if ( $this->instructions && ! $sent_to_admin && $this->id === $order->payment_method && $order->has_status( 'wc-on-hold' ) ) {
			echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
		}
	}

	/**
	* Get the return url (thank you page).
	*
	* @param WC_Order $order Order object.
	* @return string
	*/
	public function get_return_url( $order = null ) {
		if ( $order ) {
			$return_url = $order->get_checkout_order_received_url();
		} else {
			$return_url = wc_get_endpoint_url( 'order-received', '', wc_get_page_permalink( 'checkout' ) );
		}

		if ( is_ssl() || get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
			$return_url = str_replace( 'http:', 'https:', $return_url );
		}

		return apply_filters( 'woocommerce_get_return_url', $return_url, $order );
	}

	// Payment fields
	public function payment_fields() { ?>
		<fieldset style="background: transparent;">
			<p class="form-row form-row-wide">
				<?php echo esc_attr( $this->description );?>
				<br>
				<?php echo '<img src="' . UT_PLUGIN_URL . '/assets/images/checkout_image.png" width="250px" alt="UTRUST logo" />';?>
			</p>
			<div class="clear"></div>
		</fieldset> <?php
	}

	public function get_utrust_redirect( $order ) {

		$api    = new WC_UTRUST_API();
		$result = $api->create_order( $order );

		if ( isset( $result->data->attributes->redirect_url ) ) {
			return $result->data->attributes->redirect_url;
		}

		return false;
	}


	/**
	* Process the payment and return the result
	*
	* @param int $order_id
	* @return array
	*/
	public function process_payment( $order_id ) {

		$order = wc_get_order( $order_id );

		$redirect_url = $this->get_utrust_redirect( $order );

		if ( $redirect_url ) {

			// Mark as on-hold (we're awaiting the payment)
			$order->update_status( 'wc-on-hold', __( 'On Hold', 'woocommerce' ) );

			// Reduce stock levels
			$order->reduce_order_stock();

			$url_parts = parse_url( $redirect_url );
			parse_str( $url_parts['query'], $url_array );

			$utrust_id = isset( $url_array['uuid'] ) ? $url_array['uuid'] : '';
			if ( $utrust_id ) {
				update_post_meta( $order_id, '_utrust_order_id', $utrust_id );
			}

			// Remove cart
			WC()->cart->empty_cart();
		}

		do_action( 'wc_payment_gateway_utrust_payment_processed', $order, $this );

		$result = ( $redirect_url ) ? 'success' : 'failure';

		// Return thankyou redirect
		return array(
			'result' 	=> $result,
			'redirect'	=> $redirect_url
		);
	}
}
