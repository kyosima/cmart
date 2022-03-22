    $(document).ready(function() {

        $('.items').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 3,
            responsive: [
                {
                breakpoint: 1024, 
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 3,
                        infinite: true
                    }
                },
                {
                breakpoint: 600,
                    settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                    }
                }
            ]
        });
        $('.items-brand').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 1,


            responsive: [{
                breakpoint: 1024,
                settings: {
                    speed: 1000,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            }]
        });
        $('.items-blog').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,



        });
    });
