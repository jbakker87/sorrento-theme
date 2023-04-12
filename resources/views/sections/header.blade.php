@include('partials.delivery-time-modal')
<div class="navbar-wrapper" id="navbar">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg px-0">
                        @include('partials.shopping-cart')
                        {!! get_custom_logo() !!}
                        <button aria-controls="navbar-collapse-1" id="collapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="navbar-collapse-1"
                            data-toggle="collapse" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse">
                            @php
                                wp_nav_menu([
                                    'theme_location' => 'primary_navigation',
                                    // 'menu_id' => 'primary-menu',
                                    'echo' => true,
                                    'container' => 'div',
                                    'container_class' => 'collapse',
                                    'container_id' => 'navbar-collapse-1',
                                    'menu_class' => 'navbar-nav mr-auto',
                                    // 'add_li_class' => 'nav-item',
                                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                    'walker' => new WP_Bootstrap_Navwalker(),
                                ]);
                            @endphp
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
