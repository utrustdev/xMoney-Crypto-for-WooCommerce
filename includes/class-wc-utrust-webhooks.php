<?php

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

/**
 * Handles Utrust Webhooks
 */
if (!class_exists('UT_Webhooks')) {

    class UT_Webhooks
    {

        public function __construct()
        {
            $this->check_for_webhook();
        }

        public function check_for_webhook()
        {
            if (('POST' !== $_SERVER['REQUEST_METHOD'])
                || !isset($_GET['wc-api'])
                || ('wc_utrust' !== $_GET['wc-api'])
            ) {
                return;
            }

            $request_body = file_get_contents('php://input');
            $request_headers = array_change_key_case($this->get_request_headers(), CASE_UPPER);

            // Validate it to make sure it is legit.
            if ($this->is_valid_request($request_body)) {
                $this->process_webhook($request_body);
                WC_Utrust_Logger::log('Incoming webhook VALID signature: ' . print_r($request_body, true));
                status_header(200);
                exit;
            } else {
                WC_Utrust_Logger::log('Incoming webhook INVALID signature: ' . print_r($request_body, true));
                status_header(400);
                exit;
            }
        }

        /**
         * Processes the incoming webhook.
         *
         * @since 4.0.0
         * @version 4.0.0
         * @param string $request_body
         */
        public function process_webhook($request_body)
        {
            $notification = json_decode($request_body);

            switch ($notification->event_type) {
                case 'ORDER.PAYMENT.RECEIVED':
                    $this->process_webhook_payment_received($notification);
                    break;
                case 'ORDER.PAYMENT.CANCELLED':
                    $this->process_webhook_payment_cancelled($notification);
                    break;
                default:
                    break;
            }
        }

        // Process payment webhook received
        public function process_webhook_payment_received($notification)
        {
            $order_id = isset($notification->resource->reference) ? $notification->resource->reference : 0;

            $order = wc_get_order($order_id);

            if (!$order) {
                WC_Utrust_Logger::log('Could not find order via source ID: ' . $notification->resource->reference);
                return;
            } else {

                if ('processing' === $order->get_status() || 'completed' === $order->get_status()) {
                    return;
                }

                $payment_id = isset($_GET['payment_id']) ? 'Payment ID ' . $_GET['payment_id'] : '';

                $note = __('UTRUST payment received.', 'hd-woocommerce-utrust') . " $payment_id";
                $order->set_status('wc-processing', $note);
                $order->save();
            }
        }

        // Process payment webhook cancelled
        public function process_webhook_payment_cancelled($notification)
        {
            $order_id = isset($notification->resource->reference) ? $notification->resource->reference : 0;

            $order = wc_get_order($order_id);

            if (!$order) {
                WC_Utrust_Logger::log('Could not find order via source ID: ' . $notification->resource->reference);
                return;
            } else {

                if ('cancelled' === $order->get_status()) {
                    return;
                }

                $payment_id = isset($_GET['payment_id']) ? 'Payment ID ' . $_GET['payment_id'] : '';

                $note = __('UTRUST payment cancelled.', 'hd-woocommerce-utrust') . " $payment_id";
                $order->set_status('wc-cancelled', $note);
                $order->save();
            }
        }

        /**
         * Gets the incoming request headers. Some servers are not using
         * Apache and "getallheaders()" will not work so we may need to
         * build our own headers.
         *
         * @since 4.0.0
         * @version 4.0.0
         */
        public function get_request_headers()
        {
            if (!function_exists('getallheaders')) {
                $headers = array();

                foreach ($_SERVER as $name => $value) {
                    if ('HTTP_' === substr($name, 0, 5)) {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }

                return $headers;
            } else {
                return getallheaders();
            }
        }

        /**
         * Verify the incoming webhook notification to make sure it is legit.
         *
         * @since 4.0.0
         * @version 4.0.0
         * @param string $request_body The request_body payload from Utrust.
         * @return bool
         */
        public function is_valid_request($request_body)
        {
            $notification = json_decode($request_body);
            // get secret from Utrust settings
            $utrust_settings = get_option('woocommerce_utrust_gateway_settings');
            $client_secret = isset($utrust_settings['client_secret']) ? $utrust_settings['client_secret'] : '';

            // get signature from response
            $signature_from_response = $notification->signature;

            // removes signature from response
            unset($notification->signature);

            // sorts response alphabetically by key
            ksort($notification);

            // concat keys and values into one string
            $concated_payload = array();
            foreach ($notification as $key => $value) {
                if (is_object($value)) {
                    foreach ($value as $k => $v) {
                        $concated_payload[] = $key;
                        $concated_payload[] = $k . $v;
                    }
                } else {
                    $concated_payload[] = $key . $value;
                }
            }
            $concated_payload = join('', $concated_payload);

            // sign string with HMAC SHA256
            $signed_payload = hash_hmac('sha256', $concated_payload, $client_secret);

            // check if signature is correct
            if ($signature_from_response === $signed_payload) {
                return true;
            }

            WC_Utrust_Logger::log("Wrong signature generated: "+$signature_generated);
            return false;
        }
    }
}
