$(function() {
    // JSON that stores the proficiencies
    prof_list = {};
    prof_definition = {
        1: "Beginner",
        2: "Intermediate",
        3: "Advanced",
        4: "Master"
    }
    // Show the first page
    $('#step1').fadeIn('fasst');


    // Remove invalid email address
    $('#appendedInput').on('keyup', function(e) {
        if($(this).val().match(/^.+@/)) {
            $(this).val($(this).val().replace(/^.+@/, ''));
        }
    });



    $('.proficiency-slider').slider({
        min: 1,
        max: 4,
        value: 1
    });

    // FORM INTERACTION =============================
    $('#step1_submit').on('click', function(e) {
        e.preventDefault();
        // Hide the first step
        $('#step1').fadeOut(350);
        $('#step2').fadeIn(350);
        $('#progress_step1').addClass('btn-success');

    });

    $('#step2_back').on('click', function(e) {
        e.preventDefault();
        // Hide the second step
        $('#step2').fadeOut(350);
        $('#step1').fadeIn(350);
        $('#progress_step1').removeClass('btn-success');
    });

    // PROFICIENCIES INTERACTION
    $('.proficiency-checkbox').change(function() {

        var sliderContainer = $(this).parent().parent().find('.proficiency-container');
        var sliderElement = $(this).parent().parent().find('.proficiency-slider');
        var slider_id = sliderElement.attr('data-id');


        // if the proficiency checkbox is checked...
        if($(this).is(":checked")) {

            // show the slider to the user
            console.log("Checkbox checked!", $(this).next());
            sliderContainer.slideDown('fast');
            sliderElement.slider('value','1');

            // Set the default beginning value into the proficiency JSOn
            prof_list[slider_id] = sliderElement.slider('value');


        } else {
            // The user unchecked the checkbox, remove the set values from JSON
            var sliderElement = $(this).parent().parent().find('.proficiency-slider');
            var slider_id = sliderElement.attr('data-id');
            var slider_value = sliderElement.slider('value');

            delete prof_list[slider_id];

            // Hide the slider from the user
            sliderContainer.slideUp('fast');
        }
    });


    $('.proficiency-slider').slider({
        slide: function(e, ui) {
            // push the new slider value to JSON
            prof_id = e.target.getAttribute('data-id').toString();
            prof_value = ui.value;
            prof_list[prof_id] = prof_value;

            // Update the proficiency labels
            $(this).prev().removeClass('label-info').addClass('label label-success').text(prof_definition[ui.value]);
        }
    });

    $('#proficiencies a.prof-catagory').toggle(function(e) {
        $(this).stop();
        // get the name of the skill
        var skill = ($(this).attr('data-name'));
        console.log($(this).prop('checked'));
        $('.slider-' + skill).slideDown(300);
        $(this).attr
    }, function(e) {
        // get the name of the skill
        var skill = ($(this).attr('data-name'));
        $('.slider-' + skill).slideUp(300);
    });


    // Final step is clicked
    $('#step2_submit').on('click', function(e) {
        // Get the list of proficiencies
        var interests = getInterests();
        var email = $('#appendedInput').val();
        var bio = $('textarea').val();
        var screen_name = $('#step1 input[name="username"]').val();

        // Prepare the final JSON to be sent to the server
        var userData = {
            "email": email,
            "screen_name": screen_name,
            "bio": bio,
            "interests": interests,
            "proficiencies": prof_list
        }

        // Sent. Now get message from the server
        $.post('account/create', {
            'userData': userData
        }, function(response, xhr, status) {
            console.log("Sent data:", userData);
            console.log("Received data: ", response, status.status, xhr);
            if(status.status !== 200) {
                alert(status + ": an error occured while processing your request!");
                window.location.href = '/';
            } else {
                $('#step2').fadeOut('fast');
                $('#step3').fadeIn('fast');
                $('#progress_step2').addClass('btn-success');
            }
        }).error(function(e) {
            alert("An error occured while processing your request!");
            window.location.href = 'signup/';
        });
    });
});



function getInterests() {
    var interests = [];

    // Iterate through each interest input and get the data
    $('.interest-input').each(function(k, v) {
        var interest = v.value;

        // the user didn't enter anything 
        if(interest.length == 0 || interest.replace(/\s+/, '').length == 0) {
            return true; //continue
        }

        interests.push(interest);
    });

    return interests.join(',');
}