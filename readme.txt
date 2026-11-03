=== xMoney Crypto for WooCommerce ===
Contributors: xmoney
Tags: payments, payment gateway, cryptocurrencies, bitcoin, ethereum
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.1.4
License: GPL-3.0
License URI: https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/blob/master/LICENSE

Accept Bitcoin, Ethereum, xMoney Token and other cryptocurrencies directly on your online store and get settled in fiat for 1% fee.

== xMoney for WooCommerce ==

= Notice =

The crypto-asset services offered on this platform are provided by Cifralfabeto, Unipessoal Lda. and are currently suspended.

Under Regulation (EU) 2023/1114 on Markets in Crypto-Assets (MiCA), crypto-asset services may only be provided in the European Union by entities authorised as Crypto-Asset Service Providers (CASPs). Cifralfabeto has submitted an application for CASP authorisation to Banco de Portugal, the competent authority in Portugal, and the application is currently under assessment.

Pending the outcome of this process, Cifralfabeto is not providing crypto-asset services and is not accepting new orders. Services will only resume if and when authorisation is granted, and in accordance with its terms.

Demo Store: [https://demo.crypto.xmoney.com/](https://demo.crypto.xmoney.com/)

==  Key Features ==

* No need to understand the world of cryptocurrencies, it’s business as usual
* Supports all crypto wallets that can scan a QR code address or input the address manually
* No volatility risk
* Prices displayed in your customer's local currency
* Settlements by bank transfer in EUR, GBP, USD, RON or CHF, or in selected cryptocurrencies, as set in your merchant contract
* No chargebacks
* View payments and issue refunds in xMoney Merchant Dashboard
* Since a cryptocurrency transaction does not contain any credit card or bank information, there is no need for PCI compliance

== Screenshots ==

1. Reach a whole new audience, lower your fees and eliminate chargebacks.
2. Easily manage orders and refunds.
3. Sort out your cash settlements seamlessly.
4. Tap into a whole new market.
5. Install and start accepting payments in less than 5 minutes.

== Requirements ==

- xMoney Merchant account
- Online store in WordPress 6.6 or later with WooCommerce 9.8 or later
- Products must be Purchases (payment method won't be displayed for Subscriptions)

== Setup ==

= On the xMoney side =

1. Go to the [xMoney Merchant dashboard](https://merchants.crypto.xmoney.com).
2. [Log in](https://merchants.crypto.xmoney.com/sign-in), or [sign up](https://merchants.crypto.xmoney.com/onboarding/sign-up) if you haven't yet.
3. Open _Integrations_ › _API Keys_ and select _WooCommerce_ as the integration type.
4. If no credentials are shown, click _Generate credentials_.
5. You will now see your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   You will only be able to see the `Webhook Secret` once! After refreshing or changing page you will no longer be able to copy it. However, you can always regenerate your credentials as needed.

   WARNING: Don't share your credentials with anyone. They can use it to place and validate orders **on your behalf**.

= On the Wordpress side =

1. Go to your Wordpress admin dashboard.
2. Navigate to _WooCommerce > Settings_.
3. Choose the _Payments_ tab.
4. Find the plugin, listed as _Utrust_, and click _Manage_.
5. Add your `Api Key` and `Webhook Secret` and click _Save changes_.
6. (Optional) You can change the `Callback URL` if you are not using the default WooCommerce API.

= Known conflicts with other Plugins =

Some plugins that may create problems with the WooCommerce API:

- [Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) – xMoney plugin doesn't support yet automatic subscriptions, so the payment method won't be displayed when there is a Subscription on the cart.

- [WPML](https://wpml.org/) – If configured to use URL parameters, it redirects the HTTP requests to the WooCommerce API to the site URL with the `lang=en` parameter. One of the solutions is to change WPML to a folder system (`/en/`), another is to add the default language parameter in the `Callback URL` setting (e.g. `https://<your-site>/?lang=en&wc-api=wc_utrust`).

Found another conflict missing from this list? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

== Frequently Asked Questions ==

Find below a list of the most common questions about the xMoney for WooCommerce plugin.

Don't find what you're looking for in this list? Feel free to reach us [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

= Does this support test mode? =

Not at the moment. The plugin has a _Test (Sandbox)_ environment setting, but the sandbox it connects to is currently unavailable, so payments in test mode fail. Live and test API keys are different: live keys don't work in test mode, and vice versa.

= What happens if I cancel the Order manually? =

The plugin doesn't send manual order changes to xMoney. If you need to change an order's status, change it in WooCommerce, then start any refund from the xMoney Merchant Dashboard.

== Features ==

These are the features of the xMoney for WooCommerce plugin:

- Create the order and redirect the customer to the xMoney payment widget.
- Receive and handle the webhook for a received payment.
- Receive and handle the webhook for a cancelled payment.
- Save logs in the WordPress admin dashboard under _WooCommerce > Status > Logs_.
- Support pre-orders paid upfront (it doesn't support charging on the release date).
- Work with both the block checkout and the classic checkout.

Not supported: sending manual order status changes to the xMoney Merchant API, and refunds from WooCommerce (issue refunds in the xMoney Merchant Dashboard).

== Support ==

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new) if you need any help with the xMoney Crypto for WooCommerce plugin.

If you're having specific problems with your account, then please contact support@xmoney.com.

In both cases, our team will be happy to help.

== Contribute ==

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix.

== Changelog ==

= 2.1.4 =

- Add a notice that the crypto-asset services are suspended pending CASP authorisation under MiCA
- Ship the vendor folder in releases and keep build files out of the plugin
- Correct the plugin page: sign-in link, setup steps, requirements, FAQ, features, support contact, screenshot captions and banner
- Tested with WordPress 7.1 and WooCommerce 11.2

= 2.1.3 =

- Fix missing folder js folder

= 2.1.2 =

- Fix missing vendor folder

= 2.1.1 =

- Fix missing folder

= 2.1.0 =

- Add block support
- Update compatibility with Woocommerce’s HPOS (high performance order storage)

= 2.0.2 =

- Fix plugin check warnings
- Unregister empty main.css file for SEO purposes

= 2.0.1 =

- Update text domain
- add missing escape output
- change parse_url() with wp_parse_url() because of inconsistency
- fixed inconsistencies in ApiClient

= 2.0.0 =
- Compatible with all latest wordpress version
- Update compatibility with all latest PHP version
- Update compatibility with Woocommerce’s HPOS(high performance order storage)

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

&copy; xMoney
