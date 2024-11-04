   <!-- Jquery js -->
    <script src="/assets/frontend/jQuery3.7.1.min.js"></script>
    <script src="/assets/frontend/script.js"></script>


{{-- in page js  --}}
@stack('custom-js')


{{-- Facebook google tag or link here  --}}
{!! $google_tag ? $google_tag->gtag_footer : '' !!}
{!! $pixel_tag ? $pixel_tag->ptag_footer : '' !!}
{{-- End Facebook google tag or link  --}}

@stack('g_fb_js')


