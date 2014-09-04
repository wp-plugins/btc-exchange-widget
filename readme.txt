=== BTC Exchange Widget ===
Contributors: csmicfool
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=C2A8GHH997USA
Tags: bitcoin, currency, exchange, btc, widget
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

BTC Exchange Widget Plugin adds a simple converter from Bitcoin to multiple currencies. This plugin uses live data to provide accurate exchange rates.

== Description ==

<p>Simple widget for converting Bitcoin to multiple currencies.</p>

<p>More than 20 global currencies supported!</p>
<br>
<p>This plugin reads remote data from bitcoinaverage.com in order to provide accurate and up-to-date exchange rates.
<ul><li>*OpenSSL or equivalent module must be enabled to utilize this remote data.*</li></ul></p>

== Installation ==

1. Upload `btc_echange` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Drag and drop the "Bitcoin Exchange Rate" plugin in to the desired widget area
1. Enable OpenSSL PHP extension if it is not already enabled

== Frequently Asked Questions ==

= What currencies does this widget support? =

* USD
* CNY
* JPY
* SGD
* HKD
* CAD
* AUD
* NZD
* GBP
* DKK
* SEK
* BRL
* CHF
* EUR
* RUB
* SLL
* PLN
* THB

(list changes frequently)

= Where does the widget get it's data? =

This widget gets the most-recent available exchange rate data from bitcoinaverage.com by using their ticker API.

== Screenshots ==

1. This is an example of the widget w/ default settings - exact display is dependent on your theme.

== Changelog ==

= 1.0 =
* Initial Release

= 1.0.1 =
Code and style cleanup

= 1.0.2 =
Styling and UI improvements

= 1.0.4 =
Added reverse exchange rate from any currency to BTC

= 1.0.5 =
New feature - Default BTC value in widget options

= 1.0.6 =
WP 3.9 Compatibility

= 1.0.7 =
WP 3.9 fix for transient bug

= 1.0.8 =
More WP 3.9 fixes, added Blockchain API key to bypass and prevent rate limits and IP blocks.

= 1.0.9 =
Added jquery autosize plugin for input fields.  Makes the UI nicer ;)

= 1.0.91 =
Bug Fix

= 1.1 =
Switched data source from blockchain.info to bitcoinaverage.com because blockchain started blocking all of our IPs.

= 1.1.2 =
Bug fix reduces API utilization

= 1.2 =
Added new currency symbol supprot and a more informational end-user UI

= 1.2.1 =
Bugfix for character encoding

= 1.2.3 =
Bugfix for character encoding

= 1.2.4 =
Some currencies return a zero value from API due to lack of data.  They are now filtered out when their data is invalid.

= 1.2.5 =
WP 4.0 compatibility

== Upgrade Notice ==

= 1.0 =
This version is the newly released plugin - install it if you want it ;)

= 1.0.4 =
Great new feature added - reverse exchange rate

= 1.0.5 =
New feature - Default BTC value in widget options

= 1.0.6 =
WP 3.9 Compatibility

= 1.0.7 =
WP 3.9 fix for transient bug

= 1.0.8 =
More WP 3.9 fixes, added Blockchain API key to bypass and prevent rate limits and IP blocks.

= 1.0.9 =
Added jquery autosize plugin for input fields.  Makes the UI nicer ;)

= 1.0.91 =
Bug Fix

= 1.1 =
Switched data source from blockchain.info to bitcoinaverage.com because blockchain started blocking all of our IPs.  Please upgrade to restore full functionality.

= 1.1.2 =
Bug fix reduces API utilization

= 1.2 =
Added new currency symbol supprot and a more informational end-user UI

= 1.2.1 =
Bugfix for character encoding

= 1.2.3 =
Bugfix for character encoding