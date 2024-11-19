$(document).ready(function () {
function handleIntersection(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Apply CSS transformations when the element is in the viewport
        $(entry.target).css({
          transform: "scale(1)",
          opacity: "1",
          translate: "0"
        });
      }
    });
  }
  
  // Create an Intersection Observer
  const observer = new IntersectionObserver(handleIntersection, {
    root: null, // Use the viewport as the root
    rootMargin: "0px",
    threshold: 0.1 // Trigger when 10% of the element is in view
  });
  
  // Target elements to observe
  $(".video_div iframe, .landingMain .imgDiv img, .landingBtn, .fb-page").each((index, element) => {
    observer.observe(element);
  });
  
    
    $(".smallImgs").slick({
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 440,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    $(".reviewInner").slick({
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    {
        let smallImg = $(".smallSingle");
        let leargeImg = $(".leargeImgSingle");
        smallImg.click(function () {
            smallImg.removeClass("active");
            let currentSmall = $(this);
            currentSmall.addClass("active");
            let index = smallImg.index(currentSmall);
            leargeImg.removeClass("active");
            leargeImg.eq(index).addClass("active");
        });
    }

    {
        // let count = 1;
        // let countInput = $(".countShow");
        
        // $(".plusBtn").click(function () {
        //     count++;
        //     countInput.val(count);
        // });
        // $(".minusBtn").click(function () {
        //     if (count > 1) {
        //         count = count - 1;
        //         countInput.val(count);
        //     }
        // });

        let count = 1;
        let countInput = $(".countShow");
        let originalPriceEl = $(".originalPrice");
        let discountPriceEl = $(".discountPrice");

        // Get base prices from data attributes
        let baseOriginalPrice = parseFloat(originalPriceEl.data("price"));
        let baseDiscountPrice = parseFloat(discountPriceEl.data("price"));

        function updatePrices() {
            // Calculate new prices based on quantity
            let newOriginalPrice = baseOriginalPrice * count;
            let newDiscountPrice = baseDiscountPrice * count;

            // Update the displayed prices
            originalPriceEl.html(`&#2547;${newOriginalPrice.toLocaleString()}`);
            discountPriceEl.html(`&#2547;${newDiscountPrice.toLocaleString()}`);
        }

        $(".plusBtn").click(function () {
            count++;
            countInput.val(count);
            updatePrices();
        });

        $(".minusBtn").click(function () {
            if (count > 1) {
                count--;
                countInput.val(count);
                updatePrices();
            }
        });


        $(".apply").click(function (e) {
            e.preventDefault();
            $(this).closest(".couponaply").hide();
            $(".couponApplied").show();
        });
    }

    $(window).on("scroll", function () {
        $(".fb-page").each(function () {
            const $this = $(this);
            const elementTop = $this.offset().top;
            const elementBottom = elementTop + $this.outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();
    
            // Check if the element is fully or partially visible
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $this.addClass("visible");
            } else {
                $this.removeClass("visible");
            }
        });
    });
});
