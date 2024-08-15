=== xMoney Crypto for WooCommerce ===
Contributors: xmoney
Tags: payments, payment gateway, cryptocurrencies, bitcoin, ethereum, xmoney
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 7.2
Stable tag: 1.0.17
License: MIT License (MIT)
License URI: https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/blob/master/LICENSE

Accept Bitcoin, Ethereum, xMoney Token and other cryptocurrencies directly on your online store and get settled in fiat for 1% fee.

== xMoney for WooCommerce ==

Demo Store: [https://demo.crypto.xmoney.com/](https://demo.crypto.xmoney.com/)

==  Key Features ==

* No need to understand the world of cryptocurrencies, it’s business as usual
* Supports all crypto wallets that can scan a QR code address or input the address manually
* No volatility risk
* Prices displayed in your customer's local currency
* Monthly settlements via Bank transfer (EUR, USD, GBP)
* No chargebacks
* View payments and issue refunds in xMoney Merchant Dashboard
* Since a cryptocurrency transaction does not contain any credit card or bank information, there is no need for PCI compliance

== Screenshots ==



== Requirements ==

- xMoney Merchant account
- Online store in Wordpress with WooCommerce plugin v3.0 (or greater)
- Products must be Purchases (payment method won't be displayed for Subscriptions)

== Setup ==

= On the xMoney side =

1. Go to the [xMoney Merchant dashboard](https://merchants.crypto.xmoney.com).
2. [Log in](https://merchants.dev.crypto.xmoney.com/sign-in), or [sign up](https://merchants.crypto.xmoney.com/onboarding/sign-up) if you haven't yet.
3. In the sidebar on the left choose _Store_.
4. Click the button _Generate Credentials_.
5. You will now see your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   You will only be able to see the `Webhook Secret` once! After refreshing or changing page you will no longer be able to copy it. However, you can always regenerate your credentials as needed.

   WARNING: Don't share your credentials with anyone. They can use it to place and validate orders **on your behalf**.

= On the Wordpress side =

1. Go to your Wordpress admin dashboard.
2. Navigate to _WooCommerce > Settings_.
3. Choose the _Payments_ tab (or _Checkout_ in older versions).
4. Click on _xMoney_.
5. Add your `Api Key` and `Webhook Secret` and click _Save_.
6. (Optional) You can change the `Callback URL` if you are not using the default WooCommerce API.

= Known conflicts with other Plugins =

Some plugins that may create problems with the WooCommerce API:

- [Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) – xMoney plugin doesn't support yet automatic subscriptions, so the payment method won't be displayed when there is a Subscription on the cart.

- [WPML](https://wpml.org/) – If configurated to use URL parameters, it redirects the HTTP requests to the WooCommerce API to the site URL with the `lang=en` parameter. One of the solutions is to change WPML to a folder system (`/en/`), another is to add the default language parameter in the `Callback URL` setting (e.g. `https://<your-site>/?lang=en&wc-api=wc_utrust`).

Found another conflict missing from this list? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

== Frequently Asked Questions ==

Find below a list of the most common questions about the xMoney for WooCommerce plugin.

Don't find what you're looking for in this list? Feel free to reach us [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

= Does this support both live mode and test mode for testing? =

Yes, it does - choosing between live and test mode is driven by the API keys you use. They are different in both environments. Live API keys won't work for the test environment, and vice-versa.

= What happens if I cancel the Order manually? =

We are working on it. Our API is not ready yet for merchant manual changes. If you need to change the Order status, change it in WooCommerce and then go to our Merchant Dashboard to start a refund.

== Features ==

These are the features already implemented and planned for the xMoney for WooCommerce plugin:

- [x] Create Order and redirect to xMoney payment widget.
- [x] Receive and handle webhook for received payment.
- [x] Receive and handle webhook for cancelled payment.
- [x] Save logs on the Wordpress admin dashboard on _WooCommerce > Status > Logs_.
- [x] Support pre-orders paid upfront (it doesn't support charge on release date).
- [ ] Sends HTTP request to the xMoney Merchant API when an Order status is updated manually.
- [ ] Errors handling class to improve errors logs.
- [ ] Compatibility with WooCommerce earlier than 3.0.

== Support ==

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new) if you need any help with the Utrust for WooCommerce plugin.

If you're having specific problems with your account, then please contact support@utrust.com.

In both cases, our team will be happy to help.

== Contribute ==

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix.

== Changelog ==
= 1.0.17 =

- Update logo assets
- Update Demo store links
- Update compatibility with Woocommerce's HPOS(high performance order storage)

= 1.0.16 =

- Update plugin name
- Update link URLs

= 1.0.15 =

- Update stable version

= 1.0.14 =

- Update readme
- Update to xMoney from Utrust

= 1.0.13 =

- Update readme

= 1.0.12 =

- Bump Wordpress version to 5.7

= 1.0.11 =

- Bump WC version to 5.0.0
- Improve description on checkout
- Make Order "pending" status the default status when Order is created
- Remove the cart deletion 

= 1.0.10 = 

- Replace deprecated function
- Bump WC version support

= 1.0.9 = 

- Update readme

= 1.0.8 = 

- Update Utrust PHP

= 1.0.7 = 

- Fix this->support function not overriding

= 1.0.6 =

- Update readme

= 1.0.5 =

- Update assets

= 1.0.4 =

- Remove forcing string Place Order on button

= 1.0.3 = 

- Update readme

= 1.0.2 =

- Update compatibility to WooCommerce 4.2
- Update readme.txt
- Test release flow

= 1.0.1 =

* Update compatibility to WooCommerce 4.1.1
* Add readme.txt

= 1.0.0 =

* Release of stable version

== License ==

The xMoney for WooCommerce plugin is maintained by the xMoney development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/blob/master/LICENSE) for further details.

&copy; xMoney 2024
