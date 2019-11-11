![Utrust integrations - Woocommerce](https://user-images.githubusercontent.com/1558992/67495646-1e356b00-f673-11e9-8854-1beac877c586.png)

# Utrust for WooCommerce

**Demo Store:** https://woocommerce.store.utrust.com/

Accept Bitcoin, Ethereum, Utrust Token and other cryptocurrencies directly on your store with the Utrust payment gateway for WooCommerce.
Utrust is cryptocurrency agnostic and provides fiat settlements.
The Utrust plugin extends WooCommerce allowing you to take cryptocurrency payments directly on your store via Utrust’s API.
Find out more about Utrust in [utrust.com](https://utrust.com).

## Requirements

- Utrust Merchant account
- Online store in Wordpress with WooCommerce plugin v3.0 (or greater)

## Install and Update

### Installing

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-woocommerce/releases).
2. Go to your Wordpress admin dashboard (it should be something like https://<your-store.com>/wp-admin).
3. Navigate to the "Plugins" menu.
4. Click "Add New".
5. Click "Upload Plugin" button next to the page title.
6. Once you’ve uploaded our zip file, click "Install Now".
7. After installation, click "Activate Plugin" button to enable it.

### Updating

You can always check our [releases page](https://github.com/utrustdev/utrust-for-woocommerce/releases) for a new version. You should deactivate the previous version and install and activate the new one. After checking that the new version is working, you can delete the old one.

## Setup

### On Utrust side

1. Go to [Utrust merchant dashboard](https://merchants.utrust.com).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose "Organization".
4. Click the button "Generate Credentials".
5. You will see now your `Client Id` and `Client Secret`, copy them – you will only be able to see the `Client Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

Note: It's important that you don't send your credentials to anyone otherwise they can use it to place orders _on your behalf_.

### On Wordpress side

1. Go to your Wordpress admin dashboard.
2. Navigate to "WooCommerce" > "Settings".
3. Choose the tab "Payments" ("Checkout" for older versions).
4. Click on "Utrust".
5. Add your `Client Id` and `Client Secret` and click Save.
6. (Optional) You can change the `Callback URL` if you are not using the default WooCommerce API.

### Known conflicts with other Plugins

Some plugins that may create problems with the WooCommerce API:

- [WPML](https://wpml.org/) – If configurated to use URL parameters, it redirects the HTTP requests to the WooCommerce API to the site URL with the `lang=en` parameter. One of the solutions is to change WPML to a folder system (`/en/`), another is to add the default language parameter in our Callback URL, e.g.: `https://<your-site>/?lang=en&wc-api=wc_utrust`.

## Frequently Asked Questions

### Does this support both live mode and test mode for testing?

Yes, it does - live and test mode is driven by the API keys you use. They are different in both environments. Live API keys shouldn't work on test environment and vice-versa.

### What happens if I cancel the Order manually?

We are working on it. Our API is not ready yet for merchant manual changes. If you need to change the Order status, change it in WooCommerce and then go to our Merchant Dashboard to start a refund.

## Features

### Current

- Creates Order and redirects to Utrust payment widget
- Receives and handles webhook payment received
- Receives and handles webhook payment cancelled
- Saves logs on the Wordpress admin dashboard on "WooCommerce" -> "Status" -> "Logs"

### Planned for the future

- Sends HTTP request to the Utrust Merchant API when an Order status is updated manually
- Errors handling class to improve errors logs
- Compatibility with WooCommerce older than 3.0

## Support

You can create [issues](https://github.com/utrustdev/utrust-for-woocommerce/issues) on our repository. In case of specific problems with your account, please contact support@utrust.com.

## Contribute

We commit all our new features directly into our GitHub repository. But you can also request or suggest new features or code changes yourself!

### Developing

If you want to change the code on our plugin, it's recommended to install it in a local WooCommerce store (using a virtual host) so you can make changes in a controlled environment. Alternatively, you can also do it in a WooCommerce online store that you have for testing/staging.
The source code is in `wp-content/plugins/utrust-for-woocommerce`. All the changes there should be reflected live in the store.
Check the Utrust logs on the `Admin Dashboard → WooCommerce → Status → Logs` and search for the file utrust-<random_hash>.log. If something went wrong in our plugin, the message should appear there.

### Adding code to the repo

If you have a fix or a feature, submit a pull-request through GitHub against `master` branch. Please make sure the new code follows the same style and conventions as already written code.

### Contributors

- The first release of this plugin was written by a third-party contractor: [HelloDev](https://github.com/hellodevapps)
- Utrust Dev team

## Publishing

If you are member of Utrust Devteam and want to publish a new version of the plugin follow [these instructions](https://github.com/utrustdev/plugin-woocommerce/wiki/Publishing).

## License

GNU GPLv3, check LICENSE file for more info.
