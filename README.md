![xMoney Crypto integrations](https://github.com/user-attachments/assets/66de9ccd-adab-456c-a673-09c20d182c4c)

# xMoney Crypto Pay (formerly Utrust)

> [!IMPORTANT]
> The crypto-asset services offered on this platform are provided by Cifralfabeto, Unipessoal Lda. and are currently suspended.
>
> Under Regulation (EU) 2023/1114 on Markets in Crypto-Assets (MiCA), crypto-asset services may only be provided in the European Union by entities authorised as Crypto-Asset Service Providers (CASPs). Cifralfabeto has submitted an application for CASP authorisation to Banco de Portugal, the competent authority in Portugal, and the application is currently under assessment.
>
> Pending the outcome of this process, Cifralfabeto is not providing crypto-asset services and is not accepting new orders. Services will only resume if and when authorisation is granted, and in accordance with its terms.

**Demo Store:** https://demo.crypto.xmoney.com/

Accept Bitcoin, Ethereum, eGLD, xMoney Token (XMN), and other juicy cryptocurrencies directly on your online store and get settled in the currency agreed in your merchant contract.

With xMoney Crypto Pay, grow your business by allowing your customers to enjoy a vast portfolio of fiat & crypto currencies when purchasing goods and services, with a zero-fee exchange rate. 

Find out more at [xmoney.com/products/payments](https://www.xmoney.com/products/payments)

xMoney is the world's digital payments network for all things money. Crypto-enabled & Fiat-ready, with a suite of solutions for anyone, anywhere. Powered by MultiversX

# XMONEY CRYPTO PAY FOR WOOCOMMERCE

**Demo Store:** https://demo.crypto.xmoney.com/

## Key Features
- No need to understand the world of cryptocurrencies, it’s business as usual
- Supports all crypto wallets that can scan a QR code address or input the address manually
- No volatility risk
- Prices displayed in your customer’s local currency
- Settlements by bank transfer in EUR, GBP, USD, RON or CHF, or in selected cryptocurrencies, as set in your merchant contract
- No chargebacks
- View payments and issue refunds in xMoney Merchant Dashboard
- Since a cryptocurrency transaction does not contain any credit card or bank information, there is no need for PCI compliance

## Requirements

- xMoney Merchant account
- Online store in WordPress 6.6 or later with WooCommerce 9.8 or later
- Products must be Purchases (payment method won't be displayed for Subscriptions)

## Install and Update

### Installing

The plugin is in the [WordPress plugin directory](https://wordpress.org/plugins/utrust-for-woocommerce/):

1. Go to your WordPress admin dashboard (it should be something like https://<your-store.com>/wp-admin).
2. Navigate to _Plugins > Add New Plugin_.
3. Search for _xMoney Crypto for WooCommerce_.
4. Click _Install Now_, then _Activate_.

To install a specific version by hand, download its zip file from the [releases page](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/releases), go to _Plugins > Add New Plugin_, click _Upload Plugin_, choose the zip file, click _Install Now_ and activate the plugin.

### Updating

Installed from the WordPress plugin directory, the plugin updates like any other plugin: from _Dashboard > Updates_, or automatically if auto-updates are on. To update with a zip file, upload it as above and choose _Replace current with uploaded_.

## SETUP

### On the xMoney side

1. Go to the [xMoney Merchant dashboard](https://merchants.crypto.xmoney.com).
2. [Log in](https://merchants.crypto.xmoney.com/sign-in), or [sign up](https://merchants.crypto.xmoney.com/onboarding/sign-up) if you haven't yet.
3. Open _Integrations_ › _API Keys_ and select _WooCommerce_ as the integration type.
4. If no credentials are shown, click _Generate credentials_.
5. You will now see your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   :warning: You will only be able to see the `Webhook Secret` once! After refreshing or changing page you will no longer be able to copy it. However, you can always regenerate your credentials as needed.

   :no_entry_sign: Don't share your credentials with anyone. They can use it to place orders **on your behalf**.

### On the Wordpress side

1. Go to your Wordpress admin dashboard.
2. Navigate to _WooCommerce > Settings_.
3. Choose the _Payments_ tab.
4. Find the plugin, listed as _Utrust_, and click _Manage_.
5. Add your `Api Key` and `Webhook Secret` and click _Save changes_.
6. (Optional) You can change the `Callback URL` if you are not using the default WooCommerce API.

   :warning: Make sure all your products have the `SKU` attribute, otherwise the buyer will get an error on checkout.

### Known conflicts with other Plugins

Some plugins that may create problems with the WooCommerce API:

- [Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) – xMoney plugin doesn't support yet automatic subscriptions, so the payment method won't be displayed when there is a Subscription on the cart.

- [WPML](https://wpml.org/) – If configurated to use URL parameters, it redirects the HTTP requests to the WooCommerce API to the site URL with the `lang=en` parameter. One of the solutions is to change WPML to a folder system (`/en/`), another is to add the default language parameter in the `Callback URL` setting (e.g. `https://<your-site>/?lang=en&wc-api=wc_utrust`).

Found another conflict missing from this list? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

## Frequently Asked Questions

Find below a list of the most common questions about the xMoney for WooCommerce plugin.

Don't find what you're looking for in this list? Feel free to reach us [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

### Does this support test mode?

Not at the moment. The plugin has a _Test (Sandbox)_ environment setting, but the sandbox it connects to is currently unavailable, so payments in test mode fail. Live and test API keys are different: live keys don't work in test mode, and vice versa.

### What happens if I cancel the Order manually?

The plugin doesn't send manual order changes to xMoney. If you need to change an order's status, change it in WooCommerce, then start any refund from the xMoney Merchant Dashboard.

## Features

:sparkles: These are the features of the xMoney for WooCommerce plugin:

- Create the order and redirect the customer to the xMoney payment widget.
- Receive and handle the webhook for a received payment.
- Receive and handle the webhook for a cancelled payment.
- Save logs in the WordPress admin dashboard under _WooCommerce > Status > Logs_.
- Support pre-orders paid upfront (it doesn't support charging on the release date).
- Work with both the block checkout and the classic checkout.

Not supported: sending manual order status changes to the xMoney Merchant API, and refunds from WooCommerce (issue refunds in the xMoney Merchant Dashboard).

Need something else? Please let us know [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new). Or, better yet, help us by [contributing](#Contribute) with your missing feature :pray:.

## Support

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new) if you need any help with the xMoney for WooCommerce plugin.

If you're having specific problems with your account, then please contact support@xmoney.com.

In both cases, our team will be happy to help :purple_heart:.

## Contribute

This plugin was initially written by a third-party contractor ([HelloDev](https://github.com/hellodevapps)), and is now maintained by the xMoney development team.
We have now opened it to the world so that the community using this plugin may have the chance of shaping its development.

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix :blush:.

### Development

If you want to get your hands dirty and make your own changes to the xMoney for WooCommerce plugin, we recommend you to install it in a local WooCommerce store (either directly on your computer or using a virtual host) so you can make the changes in a controlled environment.
Alternatively, you can also do it in a WooCommerce online store that you have for testing/staging.

Once the plugin is installed in your store, the source code should be in `wp-content/plugins/utrust-for-woocommerce`.
All the changes there will be reflected live in the store.
Check the xMoney logs in the Admin Dashboard, in _WooCommerce > Status > Logs_, and search for the file `utrust-for-woocommerce-<date>-<random_hash>.log`. If something went wrong in this plugin, the error message should be in there.

## Publishing

For now only members of the xMoney development team can publish new versions of the xMoney for WooCommerce plugin.
Publishing goes through the GitHub workflow `.github/workflows/create-release.yml`, which commits to the plugin's WordPress.org SVN repository (`utrust-for-woocommerce`).

1. On a branch named `release/x.y.z`, set the new version in the `Version:` header of `xmoney-crypto-for-woocommerce.php` and in `WC_UTRUST_VERSION`, set `Stable tag: x.y.z` in `readme.txt`, and add the changes to the changelog in `readme.txt` and `CHANGELOG.md`.
2. Push the branch. The workflow runs a dry run: it builds the plugin as WordPress.org would receive it and prints the SVN changes without committing. Check that nothing under `vendor/` or `includes/` is deleted.
3. Open a pull request and merge it into `master`.
4. Tag the merge commit `vx.y.z` (for example `v2.1.4`, never `v.2.1.4`) and push the tag. The workflow publishes that version to WordPress.org and creates the GitHub release with the zip.

`vendor/` is committed and must ship: the plugin loads `vendor/autoload.php`. Never add it to `.distignore`.
Page images (icon, banners, screenshots) live in `.wordpress-org/`; the deploy mirrors that folder onto the SVN `assets/` folder, so a file missing there is deleted from the page.

## License

The xMoney for WooCommerce plugin is maintained with :purple_heart: by the xMoney development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/xMoney-Crypto-for-WooCommerce/blob/master/LICENSE) for further details.

&copy; xMoney
