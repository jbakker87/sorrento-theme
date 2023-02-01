<?php

namespace App\Filters;

class WooCommerce
{
    public function cartFragments(array $fragments): array
    {
        global $woocommerce;

        $fragments['.shopping-cart-icon']        = sprintf('<a class="shopping-cart-icon" href="%s"><span class="shopping-cart-icon-span" id="shopping-cart-icon-span">%d</span></a>', \wc_get_cart_url(), $woocommerce->cart->cart_contents_count ?? 0);
        $fragments['.shopping-cart-icon-mobile'] = sprintf('<a class="shopping-cart-icon-mobile" href="%s"><span class="shopping-cart-icon-mobile-span">%d</span></a>', \wc_get_cart_url(), $woocommerce->cart->cart_contents_count ?? 0);

        return $fragments;
    }
}
