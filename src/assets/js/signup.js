$(function () {
    // JSON that stores the proficiencies
    prof_list = {};

    // Show the first page
    $('#step1').fadeIn('fasst');

    // Disable the default behavior of all forms
    $('form').on('submit', function (e) {
        e.preventDefault();
    });


    // Remove invalid email address
    $('#appendedInput').on('keyup', function (e) {
        if ($(this).val().match(/^.+@/)) {
            $(this).val($(this).val().replace(/^.+@/, ''));
        }
    });


    // INTERESTS INTERACTION ====================
    $('#interests button').on('click submit', function (e) {
        var interest = $('#interests input').val();

        if (interest.length === 0) {
            return;
        }

        $('#interests-list').prepend('<li>' + interest + '</li>').fadeIn(500);

    });

    // User added interest
    $('#interests-list li').live('click', function () {
        $(this).remove();
    });


    // PROFICIENCY INTERACTION ====================
    $('#proficiencies button').on('click', function (e) {
        // Get the current selected proficiency and the proficiency id which will be injected into our DB
        var prof_id = $('#proficiencies select').val();
        var prof_name = $('#proficiencies option[value="' + prof_id + '"]').text()
		$('#proficiencies option[value="' + prof_id + '"]').remove();
        // Show the slider to the user
        setProficiencies(prof_id, prof_name);

    });

    $('.proficiency-slider').slider();

    // FORM INTERACTION =============================

    $('#step1_submit').on('click', function (e) {
        e.preventDefault();
        // Hide the first step
        $('#step1').fadeOut(350);
        $('#step2').fadeIn(350);
        $('#progress_step1').addClass('btn-success');

    });


    // Final step is clicked
    $('#step2_submit').on('click', function (e) {
        // Get the list of proficiencies
        var interests = getInterests();
        var email = $('#appendedInput').val();
		var bio = $('textarea').val()
        // Prepare the final JSON to be sent to the server
        var userData = {
            "email": email,
            "bio":bio,
            "interests": interests,
            "proficiencies": prof_list
        }
        // Sent. Now get message from the server
        $.post('signup/create', {
            'userData': userData
        }, function (response, xhr, status) {
            console.log(status.status,xhr);
            if (status.status !== 200) {
                alert(status + ": an error occured while processing your request!");
                window.location.href = '/';
            } else {
            	$('#step2').fadeOut('fast');
            	$('#step3').fadeIn('fast');
            	$('#progress_step2').addClass('btn-success');
            }
        }).error(function(e) {
            alert("An error occured while processing your request!");
            window.location.href = '/';	
        });
    });
});



// DOM HELPERS
function setProficiencies(prof_id, prof_name) {
    // Inject the slider into DOM
    var profElement = '<div class="proficiency"><div id="data-value="0" data-id=""></div><div class="proficiency-title">' + prof_name + '</div><span class="pull-left icon-thumbs-down"></span><span class="pull-right icon-thumbs-up"></span><div data-id="' + prof_id + '" class="proficiency-slider"></div></div>';

    // Now prime the event handler to update the selection when the user updates
    // the slider
    $('#proficiencies-list').prepend(profElement);
    $('.proficiency-slider').slider({
        slide: function (e, ui) {
            // push the new slider value to JSON
            prof_id = e.target.getAttribute('data-id').toString();
            prof_value = ui.value;
            prof_list[prof_id] = prof_value;
        }
    });
}



function getInterests() {
    var interests = [];
    $.each($('#interests-list li'), function (k, v) {
        interests.push(v.innerText);
    });
    return interests.join(','); // Comma separated vals

}