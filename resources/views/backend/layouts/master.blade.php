@include('backend.inc.header')
@include('backend.inc.sidebar')

<main id="main" class="main">
    <section class="section dashboard">
        @yield('content')
    </section>
</main>

@include('backend.inc.footer')
