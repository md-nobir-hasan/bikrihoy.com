@include('frontend/layouts/header')




@foreach ($data->landing_page_sections as $datum)
    @if (!$datum->is_with_previous)
        @if ($loop->index != 0)
                </div>
            </section>
        @endif

        <section class="landingPageSection">
             <div class="landingMain">
    @endif

    {{-- image  --}}
    @if ($datum->image)
        <div class="imgDiv image{{$loop->index}}">
            <img src="/storage/{{$datum->image}}" alt="{{$datum->title}}">
        </div>
    @endif

    {{-- Video  --}}
    @if ($datum->video)
        <div class="imgDiv">
            {!! $datum->video_link !!}
        </div>
    @endif

    {{-- Title  --}}
    @if ($datum->title)
        <h1 class="landing_title">{!! $datum->title !!}</h1>
    @endif

    {{-- Subtitle  --}}
    @if ($datum->sub_title)
        <h4 class="subtitle">{!! $datum->sub_title !!}</h4>
    @endif

    {{-- description  --}}
    @if ($datum->description)
        <p class="landingParagraph my-3 my-lg-4">{!! $datum->description !!}</p>
    @endif

    {{-- button  --}}
    @if ($datum->button)
        <a href="{{route('checkout',$data->slug)}}" class="landingBtn">{{$datum->button}}</a>
    @endif

    @if ($loop->last)
        </div>
            </section>
    @endif
@endforeach





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
