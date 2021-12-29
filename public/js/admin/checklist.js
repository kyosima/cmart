
$(document).on('change', 'input[name="checkAll"]', function(event) {
	event.preventDefault();
	$('input[name="id[]"]').prop('checked', $(this).prop('checked'));
		if($(this).prop('checked') == true){
			$('input[name="checkAll"]').prop('checked', true);
			$(".action-multiple").removeAttr('style');
		}
		else{
			$('input[name="checkAll"]').prop('checked', false);
			$(".action-multiple").css('display', 'none');
		}
});
$(document).on('change', 'input[name="id[]"]', function(event) {
	event.preventDefault();
	if($('input[name="id[]"]:checked').length > 0){
        $(".action-multiple").removeAttr('style');
    }else{
        $(".action-multiple").css('display', 'none');
    }
	if($(this).prop('checked') == false){
		$('input[name="checkAll"]').prop('checked', false);
	}
	if($('input[name="id[]"]:checked').length == $('input[name="id[]"]').length){
		$('input[name="checkAll"]').prop('checked', true);
	}
});