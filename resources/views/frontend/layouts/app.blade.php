<!DOCTYPE html>
<html dir="ltr" lang="bn">

    @include('frontend.layouts.header')

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJ5X4FH6"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        {{-- notification  --}}
        @include('frontend.partials.notification')
        {{-- End notification  --}}

        <!-- Navbar Start -->
        @include('frontend.partials.navbar')
        <!-- Navbar End -->
        <div class="toastr-div">
        </div>

        @yield('page_conent')

        @include('frontend.layouts.footer')
    </body>
</html>
