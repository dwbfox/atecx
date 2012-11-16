$(function() {
  	var hash = window.location.hash;
  	$('a[href="' + hash + '"]').tab('show');

	$('#profile_menu a').click(function (e) {
      e.preventDefault();
	  $(this).tab('show');


	});
});