<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('woocommerce_add_to_cart_fragments', function (array $fragments) {
    global $woocommerce;

    $fragments['.shopping-cart-icon']        = sprintf('<a class="shopping-cart-icon" href="%s"><i class="fas fa-cart-plus"></i><span class="shopping-cart-icon-span" id="shopping-cart-icon-span">%d</span></a>', \wc_get_cart_url(), $woocommerce->cart->cart_contents_count ?? 0);
    $fragments['.shopping-cart-icon-mobile'] = sprintf('<a class="shopping-cart-icon-mobile" href="%s"><span class="shopping-cart-icon-mobile-span">%d</span></a>', \wc_get_cart_url(), $woocommerce->cart->cart_contents_count ?? 0);

    return $fragments;
});
