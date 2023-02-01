<?php

namespace App;

/**
 * Add "… Continued" to the excerpt.
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

// Woocommerce
add_filter('woocommerce_add_to_cart_fragments', [ new \App\Filters\WooCommerce(), 'cartFragments' ], 10, 1);

// Gravity Forms
add_filter('gform_phone_formats', [ new \App\Filters\GravityForms(), 'nlPhoneFormat' ], 10, 2);
add_filter('gform_disable_auto_update', '__return_true');
