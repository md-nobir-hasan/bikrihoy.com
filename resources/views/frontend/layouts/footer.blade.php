

{{-- Footer section --}}
<section class="footerSection">
    <div class="container">
        <div class="footerMain">
            {{-- Footer single section --}}
            <div class="footerLeft footerSingle">
                <p class="footerParagraph">Condimentum adipiscing vel neque dis nam parturient orci at scelerisque neque dis nam parturient.</p>
                <div class="footerLocation fLeftInner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                      </svg>

                    <span>{{$site_info->address}}</span>
                </div>
                <div class="footerPhone fLeftInner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                      </svg>

                    <a href="tel: 01786743293">{{$site_contact_info->phone}}</a>
                </div>
            </div>


            {{-- Footer single section --}}
            <div class="footerMiddle footerSingle">
                <h3 class="footerTitle">Important Links</h3>
                <a href="{{route('blog.list')}}" class="footerLink">Blogs</a>
                <a href="#" class="footerLink">Terms & Conditions</a>
                <a href="#" class="footerLink">Returns and Refund Policy</a>
                <a href="#" class="footerLink">Privacy Policy</a>
                <a href="#" class="footerLink">Delivery Timeline</a>
            </div>

            {{-- Footer single section --}}
            <div class="footerRight footerSingle">
                <h3 class="footerTitle">Socials</h3>
                <div class="footerSocialMain">
                    <a href="{{$site_contact_info->facebook_page_link}}" target="_blank" class="footerSocial facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg>
                    </a>
                    <a href="#" target="_blank" class="footerSocial twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>
                    </a>
                    <a href="#" target="_blank" class="footerSocial youtube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>
                    </a>
                    <a href="#" target="_blank" class="footerSocial linkedin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>


</section>
<div class="footerBotto">
    <div class="container">
        <p class="footerBottomData">&copy; 2024 Developed By <a href="https://softwareserviceit.com" target="_blank">Sotware Service IT.</a></p>
    </div>
</div>

   <!-- Jquery js -->
    <script src="/assets/frontend/bootstrap.min.js"></script>
    <script src="/assets/frontend/jQuery3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/assets/frontend/script.js"></script>

    {{-- Global js --}}
    <script>
        $(document).ready(function(){

            // Prevent multiple form submissions
            $('.multiple-submit-prevent').on('submit', function(e) {
                let form = $(this);
                let submitButton = form.find('button[type="submit"]');

                if (form.data('submitted') === true) {
                    e.preventDefault();
                    return;
                }

                submitButton.prop('disabled', true);
                submitButton.text('Processing...');
                form.data('submitted', true);
            });

            //Shift + N = login page
            $(document).keydown(function(e){
                console.log(e,'Shift + N');
                if(e.shiftKey && e.key === 'N'){
                    window.open("{{route('login')}}", '_blank');
                }
            });
        });
    </script>

<script>
    $('.order-now-button-track').on('click',function(){
        fbq('track', 'OrderNow');
    });

    $('.search-form').on('submit', function() {
        fbq('track', 'Search', {
            search_string: $('#search-input').val()
        });
    });
</script>
{{-- in page js  --}}
@stack('custom-js')



@stack('g_fb_js')


