function close_popup_detail()
{
	$('.popup-detail').fadeOut(300);
}

$(document).ready(function(){
	// submit form search when click enter
	$(".button-search-product").on( "keypress", function(event) {
		if (event.which == 13 && !event.shiftKey) {
		    event.preventDefault();
		    $(".form-search-product").submit();
		}
	});

	// adjusting height of bg product image
	var bg_product_width = $( '.bg-product-image' ).width();
	$( '.bg-product-image' ).height(bg_product_width + 'px');
});