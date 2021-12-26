jQuery(document).ready(function($) {
	$('input[type=checkbox][name=waraper]').on('click', function(event) {
		if(this.checked)
		{
		    $('#waraper_total').html($(this).val());
            $('#grand_total').html(
                    $('#sub_total').val() 
                    - (-$('#waraper_total').html())
                    - (-$('#shipping_charge').val())
                );
		} else {
		    $('#waraper_total').html(0);
            $('#grand_total').html(
                    $('#sub_total').val() 
                    - (-$('#waraper_total').html())
                    - (-$('#shipping_charge').val())
                )
		}
	});

	$('#shipping_charge').on('change', function(event) {
		$('#shipping_total').html($(this).val());
        $('#grand_total').html(
                $('#sub_total').val() 
                - (-$('#waraper_total').html())
                - (-$('#shipping_charge').val())
            )
	});

});