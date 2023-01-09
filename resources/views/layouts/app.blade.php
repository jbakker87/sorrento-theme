<div class="main">
    @include('sections.header')
        <main id="main" class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    @include('sections.footer')
</div>

