<div class="d-flex align-items-center order-0 order-lg-4 ml-auto ml-lg-0">
    <div class="shopping-cart mr-4 mr-lg-0" id="shopping-cart">
        <a class="shopping-cart-icon"
            href="{{ function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url() }}"><i class="fas fa-cart-plus"></i><span
                class="shopping-cart-icon-span"></span></a>
    </div>
</div>
