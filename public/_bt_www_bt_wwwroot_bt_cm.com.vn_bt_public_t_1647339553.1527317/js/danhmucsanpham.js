//-----JS for Price Range slider-----

$(function() {
	$( "#slider-range" ).slider({
	  range: true,
	  min: 40000,
	  max: 9850000,
	  values: [ 40000, 9850000 ],
	  slide: function( event, ui ) {
		$( "#amount1" ).val( ui.values[ 0 ].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") );
		$( "#amount2" ).val( ui.values[ 1 ].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") );
	  }
	});
	$( "#amount1" ).val( $( "#slider-range" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") );
	$( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") );
});

