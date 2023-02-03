<?php

namespace App;

// Gravity Forms
add_action('gform_after_save_form', [ new \App\Actions\GravityForms(), 'defaultSettings' ], 10, 2);

// Woocommerce
add_action('woocommerce_check_cart_items', [ new \App\Actions\WooCommerce(), 'minimumOrderAmount' ], 999, 0);
add_action('woocommerce_thankyou', [ new \App\Actions\ThankyouController(), 'handle' ], 10, 1);
