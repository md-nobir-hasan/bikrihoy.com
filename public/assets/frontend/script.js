$(document).ready(function () {
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
                    slidesToShow: 2,
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
        let count = 1;
        let countInput = $(".countShow");
        $(".plusBtn").click(function () {
            count++;
            countInput.val(count);
        });
        $(".minusBtn").click(function () {
            if (count > 1) {
                count = count - 1;
                countInput.val(count);
            }
        });

        $(".apply").click(function (e) {
            e.preventDefault();
            $(this).closest(".couponaply").hide();
            $(".couponApplied").show();
        });
    }
});
