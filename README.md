![Utrust integrations - Woocommerce](https://user-images.githubusercontent.com/1558992/67495646-1e356b00-f673-11e9-8854-1beac877c586.png)

# Utrust for WooCommerce

**Demo Store:** https://woocommerce.store.utrust.com/

Accept Bitcoin, Ethereum, Utrust Token and other cryptocurrencies directly on your store with the Utrust payment gateway for WooCommerce.
Utrust is cryptocurrency agnostic and provides fiat settlements.
The Utrust plugin extends WooCommerce allowing you to take cryptocurrency payments directly on your store via the Utrust API.
Find out more about Utrust at [utrust.com](https://utrust.com).

## Requirements

- Utrust Merchant account
- Online store in Wordpress with WooCommerce plugin v3.0 (or greater)
- `SKU`s in all the products
- Products must be Purchases (payment method won't be displayed for Subscriptions)

## Install and Update

### Installing

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-woocommerce/releases).
2. Go to your Wordpress admin dashboard (it should be something like https://<your-store.com>/wp-admin).
3. Navigate to the _Plugins_ menu.
4. Click _Add New_.
5. Click _Upload Plugin_ button next to the page title.
6. Once you’ve uploaded our zip file, click _Install Now_.
7. After installation, click the _Activate Plugin_ button to enable it.

### Updating

You can always check our [releases page](https://github.com/utrustdev/utrust-for-woocommerce/releases) for a new version. You should deactivate the previous version and install and activate the new one. After checking that the new version is working, you can delete the old one.

## Setup

### On the Utrust side

1. Go to the [Utrust Merchant dashboard](https://merchants.utrust.com).
2. Log in, or sign up if you haven't yet.
3. On the left sidebar choose _Integrations_.
4. Select _WooCommerce_ and click the button _Generate Credentials_.
5. You will now see your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   :warning: You will only be able to see the `Webhook Secret` once! After refreshing or changing page you will no longer be able to copy it. However, you can always regenerate your credentials as needed.

   :no_entry_sign: Don't share your credentials with anyone. They can use it to place orders **on your behalf**.

### On the Wordpress side

1. Go to your Wordpress admin dashboard.
2. Navigate to _WooCommerce > Settings_.
3. Choose the _Payments_ tab (or _Checkout_ in older versions).
4. Click on _Utrust_.
5. Add your `Api Key` and `Webhook Secret` and click _Save_.
6. (Optional) You can change the `Callback URL` if you are not using the default WooCommerce API.

   :warning: Make sure all your products have the `SKU` attribute, otherwise the buyer will get an error on checkout.

### Known conflicts with other Plugins

Some plugins that may create problems with the WooCommerce API:

- [Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) – Utrust plugin doesn't support yet automatic subscriptions, so the payment method won't be displayed when there is a Subscription on the cart.

- [WPML](https://wpml.org/) – If configurated to use URL parameters, it redirects the HTTP requests to the WooCommerce API to the site URL with the `lang=en` parameter. One of the solutions is to change WPML to a folder system (`/en/`), another is to add the default language parameter in the `Callback URL` setting (e.g. `https://<your-site>/?lang=en&wc-api=wc_utrust`).

Found another conflict missing from this list? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-woocommerce/issues/new).

## Frequently Asked Questions

Find below a list of the most common questions about the Utrust for WooCommerce plugin.

Don't find what you're looking for in this list? Feel free to reach us [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-woocommerce/issues/new).

### Does this support both live mode and test mode for testing?

Yes, it does - choosing between live and test mode is driven by the API keys you use. They are different in both environments. Live API keys won't work for the test environment, and vice-versa.

### What happens if I cancel the Order manually?

:construction: We are working on it. Our API is not ready yet for merchant manual changes. If you need to change the Order status, change it in WooCommerce and then go to our Merchant Dashboard to start a refund.

## Features

:sparkles: These are the features already implemented and planned for the Utrust for WooCommerce plugin:

- [x] Create Order and redirect to Utrust payment widget.
- [x] Receive and handle webhook for received payment.
- [x] Receive and handle webhook for cancelled payment.
- [x] Save logs on the Wordpress admin dashboard on _WooCommerce > Status > Logs_.
- [x] Support pre-orders paid upfront (it doesn't support charge on release date).
- [ ] Sends HTTP request to the Utrust Merchant API when an Order status is updated manually.
- [ ] Errors handling class to improve errors logs.
- [ ] Compatibility with WooCommerce earlier than 3.0.

Need something else? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-woocommerce/issues/new). Or, better yet, help us by [contributing](#Contribute) with your missing feature :pray:.

## Support

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-woocommerce/issues/new) if you need any help with the Utrust for WooCommerce plugin.

If you're having specific problems with your account, then please contact support@utrust.com.

In both cases, our team will be happy to help :purple_heart:.

## Contribute

This plugin was initially written by a third-party contractor ([HelloDev](https://github.com/hellodevapps)), and is now maintained by the Utrust development team.
We have now opened it to the world so that the community using this plugin may have the chance of shaping its development.

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-woocommerce/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix :blush:.

### Development

If you want to get your hands dirty and make your own changes to the Utrust for WooCommerce plugin, we recommend you to install it in a local WooCommerce store (either directly on your computer or using a virtual host) so you can make the changes in a controlled environment.
Alternatively, you can also do it in a WooCommerce online store that you have for testing/staging.

Once the plugin is installed in your store, the source code should be in `wp-content/plugins/utrust-for-woocommerce`.
All the changes there will be reflected live in the store.
Check the Utrust logs in the Admin Dashboard, in _WooCommerce > Status > Logs_, and search for the file `utrust-for-woocommerce<random_hash>.log`. If something went wrong in this plugin, the error message should be in there.

## Publishing

For now only members of the Utrust development team can publish new versions of the Utrust for WooCommerce plugin.

To publish a new version, simply follow [these instructions](https://github.com/utrustdev/plugin-woocommerce/wiki/Publishing).

## License

The Utrust for WooCommerce plugin is maintained with :purple_heart: by the Utrust development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/utrust-for-woocommerce/blob/master/LICENSE) for further details.

&copy; Utrust 2020
