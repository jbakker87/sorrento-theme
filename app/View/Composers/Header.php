<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header'
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     */
    public function override(): array
    {
        return [
            'deliveryTime' => $this->time(),
        ];
    }

    public function time(): string
    {
        if (! is_front_page() || ! $this->isRestaurantOpen()) {
            return '';
        }
        
        $time = get_option('delivery_time', '');
        
        if (empty($time)) {
            return '';
        }

        return $time;
    }

    protected function isRestaurantOpen(): bool
    {
        if (! class_exists('\Barn2\Plugin\WC_Restaurant_Ordering\Util')) {
            return false;
        }

        return \Barn2\Plugin\WC_Restaurant_Ordering\Util::is_restaurant_open();
    }
}
