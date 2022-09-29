$(document).ready(function() {
    $('.list-variation-items .variation-item:first-child').addClass('active');
})
$(document).on('click', '.list-variation-items .variation-item', function() {
    $('.list-variation-items .variation-item').removeClass('active');
    $(this).addClass('active');
    $('input[name="variation_id"]').val($(this).data('id'));
    $('.multi-variation .price-single').text($(this).find('.variation-price').text());
})
$(document).on('click', '#readmore-desc-product', function() {
    $('.product-long-content-text').css('max-height', 'max-content');
    $('.bg-article').remove();
    $(this).remove();
})