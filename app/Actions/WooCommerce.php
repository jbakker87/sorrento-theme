<?php

namespace App\Actions;

class WooCommerce
{
    public function minimumOrderAmount(): void
    {
        $minimum = 20;

        if (WC()->cart->total < $minimum) {
            wc_clear_notices();
            wc_add_notice(
                sprintf(
                    'Uw totaalbedrag is %s, wij hanteren een minimum van %s om een bestelling te kunnen plaatsen.',
                    wc_price(WC()->cart->total),
                    wc_price($minimum)
                ),
                'error'
            );
        }
    }
}
