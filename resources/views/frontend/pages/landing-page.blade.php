@include('frontend/layouts/header')


{{-- @push('custom-js')
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
@endpush --}}

<section class="landingPageSection">
	<div class="landingMain">
		<h1 class="landing_title">NAVIFORCE 9188 Man’s Premium Watch Blue</h1>
		<p class="landingParagraph my-3 my-lg-4">শীতকালের বিশেষ উপহার, যা আপনার স্বাদ এবং পুষ্টির ঘাটতি পূরণ করবে, সম্পূর্ণ প্রাকৃতিক উপায়ে তৈরি।</p>
		<h5 class="subtitle">প্রি-অর্ডার চলছে!</h5>
		<a href="#" class="landingBtn my-3 my-lg-4">Order now</a>

		{{-- Img --}}
		<div class="imgDiv">
			<img src="{{asset('/images/ignore/1.1-564x600.jpg')}}" alt="">
		</div>
		
		<h3 class="subtitle1 my-3 my-lg-4">"আড়াই মিঠাই – খেজুরের খাঁটি নলেন দানাদার গুড়"</h3>
		<p class="landingParagraph">আমাদের আড়াই মিঠাই খেজুরের নলেন গুড় সম্পূর্ণ প্রাকৃতিক উপায়ে তৈরি। খেজুর গাছ থেকে তাজা রস সংগ্রহের পর ঐতিহ্যবাহী পদ্ধতিতে এটি তৈরি হয়, যা শীতের মিষ্টি স্বাদের প্রকৃত অনুভূতি নিয়ে আসে। দানাদার এই গুড় প্রতিটি কামড়ে আপনাকে সরাসরি প্রকৃতির সাথে সংযুক্ত করবে।</p>
		<a href="#" class="landingBtn">Order now</a>

		<ul class="landingofferList">
			<li class="landingOfferItem">
				<h3 class="colorTitle">কেন আমাদের আড়াই মিঠাই খেজুরের নলেন গুড় বেছে নেবেন:</h3>
				<h3 class="subtitle2">১০০% প্রাকৃতিক এবং খাঁটি: কোনো প্রিজারভেটিভ বা কৃত্রিম উপাদান ছাড়াই তৈরি।</h3>
				<h3 class="subtitle2">শীতকালীন সেরা মিষ্টি: খেজুরের নলেন গুড়ের দানাদার টেক্সচার এবং মিষ্টতার জন্য এটি বিশেষভাবে পরিচিত।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
			</li>

			<li class="landingOfferItem">
				<h3 class="colorTitle">কেন আমাদের আড়াই মিঠাই খেজুরের নলেন গুড় বেছে নেবেন:</h3>
				<h3 class="subtitle2">১০০% প্রাকৃতিক এবং খাঁটি: কোনো প্রিজারভেটিভ বা কৃত্রিম উপাদান ছাড়াই তৈরি।</h3>
				<h3 class="subtitle2">শীতকালীন সেরা মিষ্টি: খেজুরের নলেন গুড়ের দানাদার টেক্সচার এবং মিষ্টতার জন্য এটি বিশেষভাবে পরিচিত।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
			</li>

			<li class="landingOfferItem">
				<h3 class="colorTitle">কেন আমাদের আড়াই মিঠাই খেজুরের নলেন গুড় বেছে নেবেন:</h3>
				<h3 class="subtitle2">১০০% প্রাকৃতিক এবং খাঁটি: কোনো প্রিজারভেটিভ বা কৃত্রিম উপাদান ছাড়াই তৈরি।</h3>
				<h3 class="subtitle2">শীতকালীন সেরা মিষ্টি: খেজুরের নলেন গুড়ের দানাদার টেক্সচার এবং মিষ্টতার জন্য এটি বিশেষভাবে পরিচিত।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
				<h3 class="subtitle2">স্বাদে ও গন্ধে অতুলনীয়: খেজুর রসের প্রাকৃতিক মিষ্টতা, যা সুগন্ধের মাধ্যমে শীতের আনন্দ বাড়িয়ে তোলে।</h3>
				<p class="colorparagraph">নভেম্বরের ১৫ - ২০ তারিখের পর থেকে ইনশাআল্লাহ আমরা আপনার অর্ডার ডেলিভারির জন্য পিকআপ শুরু করব। এই বছরের প্রথম খাঁটি দানাদার গুড় ঘরে তুলতে আজই প্রি-অর্ডার নিশ্চিত করুন!</p>
			</li>
		</ul>
		<h3 class="colorTitlecall">প্রয়োজনে কল করুন- 09639 81 25 25 , 01979 91 25 25</h3>
		{{-- <p class="orderParagraph"><b>"The Watch"</b> নেয়ার জন্য, নিচের ফর্মটি সম্পূর্ণ পূরণ করুন</p> --}}

		{{-- Order form --}}
		{{-- <form action="#" class="orderFormLanding">
			
			<div class="orderFormInnerL">
				
				<div class="orderRightL">
					<h3 class="orderformtitle">NAVIFORCE 9188 Man’s Premium Watch Blue</h3>
					

					<div class="productFill">
						<div class="productName">
							<img src="{{asset('/images/ignore/1.1-564x600.jpg')}}" alt="">
							<p class="lanpName">NAVIFORCE 9188 Man’s Premium Watch Blue</p>
						</div>
						<p class="LanPrice"  id="productPrice">2000 Tk</p>
					</div>

					<div class="shipingCostTotal">
						<div class="shipingCostLand">
							<p class="shipingLan">Shipping Cost</p>
							<p class="LandTk" id="shippingCost">50 Tk</p>
						</div>
						
						
						<div class="shipingCostLand">
							<p class="shipingLan">Total Cost</p>
							<p class="LandTk" id="totalCost">2050 Tk</p>
						</div>
					</div>

					<div class="payrntTypelan">
						<p class="pamentType">Pament type</p>
						<div class="cashonDeliLan">
							<div>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
								  </svg>									  
								<p class="cashLan">Cash On Delivery</p>
							</div>
							<span>Pay with cash upon delivery.</span>
						</div>
					</div>
				</div>

				
				<div class="orderLeftL">
					<p class="oaragraph">Billing info.</p>
					<label for="LanName">নাম (Name)*</label>
					<input type="text" name="" id="LanName" required>
					<label for="LanMobile">মোবাইল নাম্বার (Mobile No)*</label>
					<input type="tel" name="" id="LanMobile" required>

					<label >শিপিং এরিয়া (Shipping Area)</label>
					
					<div class="shipingAreaCheck">
						<label for="lanDhaka">ঢাকার মধ্যে (Dhaka) 60Tk</label>
						<input type="radio" name="LanShiping" id="lanDhaka" value="60" checked>
					</div>
					<div class="shipingAreaCheck">
						<label for="lannotDhaka">ঢাকার বাইরে (Outside of Dhaka) 120Tk</label>
						<input type="radio" name="LanShiping" id="lannotDhaka" value="120">
					</div>
					<label for="lanadderss">ডেলিভারি ঠিকানা (Delivery Address)*</label>
					<textarea name="3" id="lanadderss" ></textarea>
					<button class="lanOrderConirm" id="orderButton">place Order Tk 2,060.00</button>
				</div>
			</div>
		</form> --}}
	</div>
</section>




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
@stack('custom-js')