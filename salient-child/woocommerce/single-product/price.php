<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?><span style="background: #363636;border: 1px dashed #555;color: #fff;padding: 10px;font-size: 16px!important;line-height: 20px!important;letter-spacing: 0px;margin-left: 10px;margin-top: -24px;line-height: -15px;">Use coupon at checkout: <span style="color:#d2ff00;font-size: 24px;vertical-align: middle;font-family: proxima-nova;font-weight: 600;">  APTSUPPS10</span></span></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
