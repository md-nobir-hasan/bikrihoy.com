<!DOCTYPE html>
<html dir="ltr" lang="bn">
@include('frontend.layouts.header')

<body>
    {{-- notification  --}}
    @include('frontend.partials.notification')
    {{-- End notification  --}}

    {{-- End menue navbar toggle  --}}

    <!-- Navbar Start -->
    @include('frontend.partials.navbar')
    <!-- Navbar End -->


    <div class="toastr-div">

    </div>
    @yield('page_conent')

    @include('frontend.layouts.footer')

    </html>
