# UTRUST for WooCommerce
Contributors: utrustdev team
Tags: utrust, cryptocurrency, crypto, payment request, woocommerce, simple, safe, easy, bitcoin, ethereum, token
Requires at least: 4.6
Tested up to: 5.0
Stable tag: 4.3
Requires PHP: 5.2.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Take cryptocurrency payments on your store using UTRUST.

## Description

Accept Bitcoin, Ethereum, UTRUST Token and other cryptocurrencies directly on your store with the UTRUST payment gateway for WooCommerce.
UTRUST is cryptocurrency agnostic and provides fiat settlements.

### Take Crypto Currency payments safely directly on your store

The UTRUST plugin extends WooCommerce allowing you to take cryptocurrency payments directly on your store via UTRUST’s API.

### Why choose UTRUST?

UTRUST has no setup fees, no monthly fees, no hidden costs: you only get charged when you earn money! Your earnings are on your UTRUST account for withdrawal.

## Requirements

* UTRUST Merchant account
* Online store in Wordpress with WooCommerce plugin

## Installation and Updates

### Installating

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/woocommerce-plugin/releases).
1. Log in to your WordPress admin dashboard.
2. Navigate to the *Plugins* menu.
3. Click *Add New*.
4. Click *Upload Plugin* button next to the page title.
5. Once you’ve uploaded our zip file, click *Activate* button to enable the plugin.

### Updating

You should get emails from us informing that a new release is out. Nevertheless, you can always check our [releases page](https://github.com/utrustdev/woocommerce-plugin/releases).

## Setup and configuration

### On UTRUST side

1. Go to [UTRUST merchant dashboard](https://merchants.utrust.com).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose *Organization*.
4. Click the button *Generate Credentials*.
5. You will see now your `Client Id` and `Client Secret`, copy them – you will only be able to see the `Client Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

Note: It's important that you don't send your credentials to anyone otherwise they can use it to place orders _on your behalf_.

### On Wordpress side

1. Go to your online store admin dashboard (it should be something like https://your-store-name.com/wp-admin).
2. Navigate to *WooCommerce* > *Settings*.
3. Choose the tab *Checkout*.
4. Click on *UTRUST* on top.
5. Add your `Client Id` and `Client Secret` and click Save.

## Frequently Asked Questions

### Does this support both live mode and sandbox mode for testing?

Yes, it does - live and sandbox mode is driven by the API keys you use. They are different in both environments. Live API keys shouldn't work on Sandbox environment and vice-versa.

### What happens if I cancel the Order manually?

We are working on it. Our API is not ready yet for merchant manual changes. If you need to change the Order status, change it and contact us at support@utrust.com so we can change it in our system as well and refund the buyer.

## Features

### Current
* Creates Order and redirects to UTRUST payment widget
* Receives and handles webhook payment received
* Receives and handles webhook payment cancelled
* Saves logs on Admin Dashboard -> WooCommerce -> Status -> Logs

### Planned for the future
* Sends HTTP request to the UTRUST Merchant API when an Order status is updated manually
* Errors handling class to improve errors logs
* Compatibility with WooCommerce > 3.0

## Screenshots

*** Soon... ***
