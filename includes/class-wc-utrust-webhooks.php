<?php

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

use Utrust\Webhook\Event;
require_once( plugin_dir_path( __FILE__ ) . '/action-scheduler/action-scheduler.php' );
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

            // Get secret from Utrust settings
            $utrust_settings = get_option('woocommerce_utrust_gateway_settings');
            $webhook_secret = isset($utrust_settings['webhook_secret']) ? $utrust_settings['webhook_secret'] : '';

            $request_body = file_get_contents('php://input');
            $request_headers = array_change_key_case($this->get_request_headers(), CASE_UPPER);

            try {
                $event = new Event($request_body);
                // Validate it to make sure it is legit
                $event->validateSignature($webhook_secret);

                // Handle signature valid
                $this->process_webhook($request_body);
                WC_Utrust_Logger::log('Incoming webhook VALID signature: ' . print_r($request_body, true));
                status_header(200);
                exit;
            } catch (\Exception $exception) {
                // Handle signature invalid
                WC_Utrust_Logger::log('Something went wrong! Exception: ' . $exception->getMessage() . '| Request body: ' . print_r($request_body, true));
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
            }
        }

        // Process payment webhook received
        public function process_webhook_payment_received($notification)
        {

            $order_id = isset($notification->resource->reference) ? $notification->resource->reference : 0;

            $order = wc_get_order($order_id);

            //update_post_meta( $order_id, 'Strasse', $order->get_status());

            if (!$order) {
                WC_Utrust_Logger::log('Could not find order via source ID: ' . $notification->resource->reference);
                return;
            } else {

                if ('processing' === $order->get_status() || 'completed' === $order->get_status()) {
                    
                    return;
                }

                $order->add_order_note(__('Utrust payment received.', 'hd-woocommerce-utrust'));
               if ('pending' === $order->get_status()) {
                    
                    $order->update_status("wc-completed", 'completed', TRUE);
					//$order->set_status('wc-completed');
                    WC()->mailer()->emails['WC_Email_Customer_Completed_Order']->trigger($order_id);

                     $subscriptions_ids = wcs_get_subscriptions_for_order( $order_id, array('order_type' => 'any') );
                    foreach( $subscriptions_ids as $subscription_id => $subscription_obj ){
                        if($subscription_obj->order->id == $order_id) break; // Stop the loop
                    
                    }

					$b= WC_Subscriptions_Order::get_subscription_period($order);

                    update_post_meta( $order_id, 'subscription_id1', $subscription_id);
                    update_post_meta( $order_id, 'order_status', $order->get_status());
                    update_post_meta( $order_id, 'order_id', $order_id);

					
					if($b=='day'){
						$timestamp = time() + 60*60*24;
					}
					else if($b=='week'){
						$timestamp = time() + 60*60*24*7;
					}
					else if($b=='month'){
						$timestamp = time() + 60*60*24*30;
					}
					else if($b=='year'){
						$timestamp = time() + 60*60*24*365;
					}
					
					update_post_meta( $order_id, 'timestamp', $timestamp);
					
					$array = array(
						'subscription_id'=>$subscription_id
					);
					
					//as_schedule_recurring_action($timestamp, time(), 'woocommerce_scheduled_subscription_payment',$array);
					//as_schedule_single_action($timestamp,'woocommerce_scheduled_subscription_payment',$array);
                    //scheduled_subscription_payment( $amount_to_charge, $order, $product_id );
                     if(wcs_order_contains_renewal($order_id)) {
                        $parent_order_id = WC_Subscriptions_Renewal_Order::get_parent_order_id($order_id);
                        $orderParent = new WC_Order($parent_order_id);
                        $orderParent->update_status("wc-completed", 'completed', TRUE);
                        update_post_meta( $order_id, 'parentID', $parent_order_id);
                        $subscriptions = wcs_get_subscriptions_for_order( $order_id );
                        foreach( $subscriptions as $subscription_id => $subscription ){
                            // Change the status of the WC_Subscription object
                            $subscription->update_status('active');
                    }

                    $order = wc_get_order($parent_order_id);

                    $bb= WC_Subscriptions_Order::get_subscription_period($order);

                    if($bb=='day'){
						$timestamp1 = time() + 60*60*24;
					}
					else if($bb=='week'){
						$timestamp1 = time() + 60*60*24*7;
					}
					else if($bb=='month'){
						$timestamp1 = time() + 60*60*24*30;
					}
					else if($bb=='year'){
						$timestamp1 = time() + 60*60*24*365;
					}

                    update_post_meta( $order_id, 'subscription_id2', $subscription_id);
                    update_post_meta( $order_id, 'order_status2', $order->get_status());
                    update_post_meta( $order_id, 'order_id2', $order_id);
                    update_post_meta( $order_id, 'parent_order_id2', $parent_order_id);
                    
                    update_post_meta( $order_id, 'timestamp2', $timestamp1);


                    as_schedule_single_action($timestamp1,'woocommerce_scheduled_subscription_payment',$array);

                    } else {

                     as_schedule_single_action($timestamp,'woocommerce_scheduled_subscription_payment',$array);

                    }
                }
                $order->payment_complete();
                $order->save();
            }
        }

        // Process payment webhook cancelled
        public function process_webhook_payment_cancelled($notification)
        {
            $order_id = isset($notification->resource->reference) ? $notification->resource->reference : 0;

            $order = wc_get_order($order_id);

            //update_post_meta( $order_id, 'Strasse6', $order->get_status());
            //update_post_meta( $order_id, 'Strasse7', $notification);

            if (!$order) {
                WC_Utrust_Logger::log('Could not find order via source ID: ' . $notification->resource->reference);
                return;
            } else {

                  //update_post_meta( $order_id, 'Strasse7', $order->get_status());
                  //update_post_meta( $order_id, 'Strasse8', $notification);

                if ('cancelled' === $order->get_status()) {
                    return;
                }

                $payment_id = isset($_GET['payment_id']) ? 'Payment ID ' . $_GET['payment_id'] : '';

                $note = __('Utrust payment cancelled.', 'hd-woocommerce-utrust') . " $payment_id";
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
    }
}
