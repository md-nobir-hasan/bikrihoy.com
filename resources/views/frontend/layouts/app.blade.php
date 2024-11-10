

    @include('frontend.layouts.header')


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
