<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * WC_UTRUST_API_Base class.
 *
 * Sets Interfaces to Communicates with Utrust API.
 */
class WC_UTRUST_API extends WC_UTRUST_API_Base
{

    private $callback_url = '';
    private $api_key = '';
    private $webhook_secret = '';

    public function __construct()
    {
        parent::__construct();

        $utrust_settings = get_option('woocommerce_utrust_gateway_settings');

        $this->callback_url = isset($utrust_settings['callback_url']) ? $utrust_settings['callback_url'] : '';
        $this->api_key = isset($utrust_settings['api_key']) ? $utrust_settings['api_key'] : '';
        $this->webhook_secret = isset($utrust_settings['webhook_secret']) ? $utrust_settings['webhook_secret'] : '';
    }

    public function create_order($order)
    {

        $endpoint = 'stores/orders';
        $line_items = array();
        $order_items = $order->get_items(array('line_item', 'fee', 'tax'));

        // Line items
        foreach ($order_items as $order_item) {
            if ($order_item['type'] === 'line_item') {
                $product = $order_item->get_product();

                $line_item = array(
                    'sku' => $product->get_sku(),
                    'name' => $order_item->get_name(),
                    'price' => strval($order->get_item_subtotal($order_item, false)),
                    'currency' => $order->get_currency(),
                    'quantity' => $order_item->get_quantity(),
                );
                $line_items[] = $line_item;
            } elseif ($order_item['type'] === 'fee') {
                $line_item = array(
                    'sku' => 'fee',
                    'name' => $order_item->get_name(),
                    'price' => $order_item['line_total'],
                    'currency' => $order->get_currency(),
                    'quantity' => $order_item->get_quantity(),
                );
                $line_items[] = $line_item;
            }
        }

        // Amount details (Subtotal, Taxes, Shipping costs and Discounts)
        $subtotal = $order->get_subtotal();
        $tax_total = $order->get_total_tax();
        $shipping_total = $order->get_shipping_total() + $order->get_shipping_tax();
        $discount_total = $order->get_total_discount();

        $subtotal_str = ($subtotal > 0.0) ? strval($subtotal) : null;
        $tax_total_str = ($tax_total > 0.0) ? strval($tax_total) : null;
        $shipping_total_str = ($shipping_total > 0.0) ? strval($shipping_total) : null;
        $discount_total_str = ($discount_total > 0.0) ? strval($discount_total) : null;

        // Order info
        $order_data = array(
            'reference' => (string) $order->get_id(),
            'amount' => array(
                'total' => $order->get_total(),
                'currency' => $order->get_currency(),
                'details' => array(
                    'subtotal' => $subtotal_str,
                    'tax' => $tax_total_str,
                    'shipping' => $shipping_total_str,
                    'discount' => $discount_total_str,
                ),
            ),
            'return_urls' => array(
                'return_url' => $order->get_checkout_order_received_url(),
                'cancel_url' => $order->get_cancel_order_url(),
                'callback_url' => htmlspecialchars_decode($this->callback_url),
            ),
            'line_items' => $line_items,
        );

        // Customer info
        $customer_data = array(
            'first_name' => $order->get_billing_first_name(),
            'last_name' => $order->get_billing_last_name(),
            'email' => $order->get_billing_email(),
            'address1' => $order->get_billing_address_1(),
            'address2' => $order->get_billing_address_2(),
            'city' => $order->get_billing_city(),
            'state' => $order->get_billing_state(),
            'postcode' => $order->get_billing_postcode(),
            'country' => $order->get_billing_country(),
        );

        $api_key = $this->api_key;

        $request = array(
            'data' => array(
                'type' => 'orders',
                'attributes' => array(
                    'order' => $order_data,
                    'customer' => $customer_data,
                ),
            ),
        );

        $header = array("Authorization: Bearer $api_key", "Content-Type: application/json");
        $response = $this->add_order($request, $endpoint, $header);

        if (isset($response->errors)) {
            WC_Utrust_Logger::log('API error: ' . print_r($response, true));
        }

        return $response;
    }
}
