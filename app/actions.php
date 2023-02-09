<?php

namespace App;

// Gravity Forms
add_action('gform_after_save_form', [ new \App\Actions\GravityForms(), 'defaultSettings' ], 10, 2);
add_action('admin_head', [ new \App\Actions\GravityForms(), 'fixMergeTags' ], 10, 0);

/**
 * Woocommerce.
 */
add_action('woocommerce_check_cart_items', [ new \App\Actions\WooCommerce(), 'minimumOrderAmount' ], 999, 0);
add_action('woocommerce_thankyou', [ new \App\Actions\ThankyouController(), 'handle' ], 10, 1);

// Add the field to the checkout.
add_action('woocommerce_before_order_notes', function ($checkout) {
    woocommerce_form_field('order_delivery_date', array(
        'type'          => 'date',
        'required'      => true,
        'class'         => ['form-row-wide'],
        'label'         => __('Bezorgdatum'),
        ), $checkout->get_value('order_delivery_date'));
}, 10, 1);

// Check if custom field is set, if it's not set add an error.
add_action('woocommerce_checkout_process', function () {
    if (! $_POST['order_delivery_date']) {
        wc_add_notice(__('Please enter something into this new shiny field.'), 'error');
    }
}, 10, 0);

add_action('woocommerce_checkout_update_order_meta', function ($orderID) {
    if (! empty($_POST['order_delivery_date'])) {
        update_post_meta($orderID, '_order_delivery_date', \sanitize_text_field($_POST['order_delivery_date']));
    }
}, 10, 1);
