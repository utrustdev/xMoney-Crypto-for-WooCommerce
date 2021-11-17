<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Log all things!
 *
 */
class WC_Utrust_Logger
{

    public static $logger;
    const WC_LOG_FILENAME = 'utrust-for-woocommerce';

    /**
     * Utilize WC logger class
     *
     * @since 4.0.0
     * @version 4.0.0
     */
    public static function log($message, $type = 'debug')
    {

        if (apply_filters('wc_utrust_logging', true, $message)) {
            if (empty(self::$logger)) {
                self::$logger = wc_get_logger();
            }

            $log_entry = "\n" . $message;

            self::$logger->debug($log_entry, array('source' => self::WC_LOG_FILENAME));
        }
    }
}
