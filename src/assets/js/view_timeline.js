$(function() {
	$('#push_status').on('submit',function() { return false;});
	$('#push_status button').on('click',function(e){
		e.preventDefault();
		var submitButton = $('#push_status button')
		// Disabled the submit button while the transaction is cmplete
		submitButton.attr('disabled','disabled');
		submitButton.text("Submitting...");

		var update = $('input[name="update"]').val();
		var project_id = $('input[name="project_id"]').val();

		var sendData = {'update':update,'project_id':project_id}
		$.post('/atecx/src/project/milestone',sendData,function(res) {
			console.log(res);
			setTimeout(function() {
				submitButton.removeAttr('disabled')
				submitButton.text("Push");
				window.location.reload();
			},1500);
		});
	})
})