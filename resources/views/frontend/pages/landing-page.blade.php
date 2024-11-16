@include('frontend/layouts/header')


<div class="landingPageBody">
    @foreach ($data->landing_page_sections as $datum)

        {{-- Section starting or attaching --}}
        @if ($loop->first)
        <section class="landingPageSection section section{{$loop->index}}">
            <div class="landingMain">
        @else
            @if (!$datum->is_with_previous)
                    </div>
                </section>

                <section class="landingPageSection section section{{$loop->index}}">
                    <div class="landingMain">
            @endif
        @endif

        {{-- Title  --}}
        @if ($datum->title)
            <h1 class="landing_title title title{{$loop->index}}">{!! $datum->title !!}</h1>
        @endif

        {{-- description  --}}
        @if ($datum->description)
            <p class="shortParagrapg landingParagraph my-3 my-lg-4 description description{{$loop->index}}">{!! $datum->description !!}</p>
        @endif

        {{-- image  --}}
        @if ($datum->image)
            <div class="imgDiv image-div image-div{{$loop->index}}">
                <img class="image image{{$loop->index}}" src="/storage/{{$datum->image}}" alt="Product Image">
            </div>
        @endif

        {{-- Video  --}}
        @if ($datum->video_link)
            <div class="video_div video_div{{$loop->index}}">
                {!! $datum->video_link !!}
            </div>
        @endif


        {{-- Subtitle  --}}
        @if ($datum->sub_title)
            <h4 class="subtitle subtitle{{$loop->index}}">{!! $datum->sub_title !!}</h4>
        @endif

        {{-- description  --}}
        @if ($datum->description)
            <p class="landingParagraph my-3 my-lg-4 description description{{$loop->index}}">{!! $datum->description !!}</p>
        @endif

        {{-- button  --}}
        @if ($datum->button)
            <a href="{{route('checkout',$data->slug)}}" class="landingBtn button button{{$loop->index}}">{{$datum->button}}</a>
        @endif

        {{-- Section ending --}}
        @if ($loop->last)
            </div>
        </section>
        @endif
        
    @endforeach
</div>





<!-- Jquery js -->
<script src="/assets/frontend/bootstrap.min.js"></script>
<script src="/assets/frontend/jQuery3.7.1.min.js"></script>
<script src="/assets/frontend/script.js"></script>

<script>
$('.order-now-button-track').on('click',function(){
	fbq('track', 'OrderNow');
});
</script>
    {{-- in page js  --}}
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

		$(document).ready(function() {
        const productPrice = parseInt($('#productPrice').text()); // Product price in Tk

        // Function to update shipping, total cost, and order button text
        function updateCosts() {
            // Get the selected shipping cost
            let shippingCost = parseInt($("input[name='LanShiping']:checked").val());

            // Update the displayed shipping cost
            $('#shippingCost').text(shippingCost + ' Tk');

            // Calculate total cost
            let totalCost = productPrice + shippingCost;

            // Update the displayed total cost
            $('#totalCost').text(totalCost + ' Tk');

            // Update the order button text with the total cost
            $('#orderButton').text('Place Order Tk ' + totalCost);
        }

        // Initialize the costs on page load
        updateCosts();

        // Update costs when the shipping option changes
        $("input[name='LanShiping']").on('change', updateCosts);
    });

</script>

</body>
</html>
