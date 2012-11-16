$(function() {

	// Initialize the datepicker
	$('.datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
	 	constrainInput: false,
	 	onSelect:function(date,datepickerObj)
	 	{
	 		// Change the forward slash date separator to a dash
	 		datepickerObj.input.val(date.replace(/\//g,'-'));
	 	}
	});

});