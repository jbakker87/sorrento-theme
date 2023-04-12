@if ($deliveryTime)
    <div id="delivery-box" class="d-flex align-items-center order-0 order-lg-2 ml-auto ml-lg-0 px-2 | delivery-box">
        @include('partials.icons.information-shake') Verwachte bezorgtijd: {{ $deliveryTime }} minuten.
    </div>
@endif
