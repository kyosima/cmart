$(document).ready(function(){


    let slide_full = ()=>{
        let $carousel= $('.product__detail .carousel_big');
        $carousel.flickity({
            // options
            cellAlign: 'right',
            wrapAround: true,
            contain: true,
            pageDots: false,
            prevNextButtons: false,
        });
        let $carouse2= $('.product__detail .carousel_small');
        $carouse2.flickity({
            // options
            asNavFor: '.carousel_big',
            cellAlign: 'right',
            wrapAround: true,
            contain: true,
            pageDots: false,
            prevNextButtons: false,
        });
        let $carouse3= $('.slide_product .slide_product-carousel');
        $carouse3.flickity({
            // options
            cellAlign: 'left',
            wrapAround: true,
            contain: true,
            pageDots: false,
            prevNextButtons: false,
        });
    };
    slide_full();

    let prev_et = ()=>{
        $('.slide_product .product-seen .title .arrow .prev').on( 'click', function() {
            $("main .slide_product .slide_product-carousel").flickity('next');
        });
    }
    prev_et();
    let next_et = ()=>{
        $('.slide_product .product-seen .title .arrow .next').on( 'click', function() {
            $("main .slide_product .slide_product-carousel").flickity('next');
        });
    }
    next_et();


    $('.tab_comment:first').show()
    $('.tab_navigation li:first').addClass('active')
    $('.tab_navigation li').click(function(event){
        index = $(this).index();
        $('.tab_navigation li').removeClass('active');
        $(this).addClass('active');
        $('.tab_comment').hide(); 
        $('.tab_comment').eq(index).show(); 
    });

})

