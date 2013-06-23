//Global variables
var FILE = 'asg-assets/themes/default/custom-ajax.php';
var WIDTH = 300;

// Show modal, get user email and create button to copy it.

function get_email(id) {
    TINY.box.show({
        url: FILE,
        post: 'action=get&id=' + id,
        openjs: function() {
            // Get the email
            var the_email = $('.the_email').text();
            // Reverse it
            var rev_text = the_email.split("").reverse().join("");
            // Copy it to clipboard
            $('button#copy-button').zclip({
                path: 'asg-assets/themes/default/js/ZeroClipboard.swf',
                copy: rev_text,
                afterCopy: function() {
                    remove(id);
                    TINY.box.hide();
                }
            });
        },
        width: WIDTH,
        height: 120,
        opacity: 60,
        topsplit: 3
    });
}

// Remove the request on click

function remove(id) {
    // Remove invite request using Ajax
    $.post(FILE, {
        action: 'remove',
        id: id,
        rand: Math.random()
    }, function(data) {
        // If request is succesfull
        if (data == 'Yes') {
            // Remove the actual request
            $('#request_' + id).fadeOut(400, function() {
                $(this).empty().remove();
            });
        }
    });
}

// Remove the request on click

function delete_request(id) {
    // Remove invite request using Ajax
    $.post(FILE, {
        action: 'delete',
        id: id,
        rand: Math.random()
    }, function(data) {
        // If request is succesfull
        if (data == 'Yes') {
            // Remove the actual request
            $('#request_' + id).fadeOut(400, function() {
                $(this).empty().remove();
            });
        }
    });
}

$('aside.sidebar-wrapper').waypoint('sticky', {
    alert('Top of thing hit top of viewport.');
});

// Request an Invite
$("#request_invite_form").submit(function() {
    $.post(FILE, {
        action: 'request',
        email: $('#email').val(),
        rand: Math.random()
    }, function(data) {
        // If request is succesfull
        if (data == 'Yes') {
            // Yey!!
            TINY.box.show({
                html: '<div class="box_inner">Your request has been registered. One community member will invite you as soon as possible! Thank you for your interest in Koding! Have a nice day!<br>' + '<div id="share">' + '<span>Spread the word</span><div id="shareme" data-url="http://stefanbc.beta.koding.com/request/" data-text="I\'ve just requested a @koding invite from the community! http://koding.com via "></div>' + '</div>' + '</div>',
                width: WIDTH,
                height: 95,
                opacity: 60,
                openjs: function() {
                    $('#shareme').sharrre({
                        share: {
                            twitter: true,
                            facebook: true,
                            googlePlus: true
                        },
                        template: '<div class="box"><div class="left">Share</div><div class="middle"><a href="#" class="facebook">f</a><a href="#" class="twitter">t</a><a href="#" class="googleplus">+1</a></div><div class="right">{total}</div></div>',
                        enableHover: false,
                        enableTracking: true,
                        render: function(api, options) {
                            $(api.element).on('click', '.twitter', function() {
                                api.openPopup('twitter');
                            });
                            $(api.element).on('click', '.facebook', function() {
                                api.openPopup('facebook');
                            });
                            $(api.element).on('click', '.googleplus', function() {
                                api.openPopup('googlePlus');
                            });
                        }
                    });
                },
                topsplit: 4
            });
            $('#email').val('').css({
                'background': '#fff',
                'color': '#444'
            });

        } else if (data == 'Bad Email') {

            input_error('#email', 'Please enter a valid email!');

        } else if (data == 'Exists') {

            input_error('#email', 'You have already requested an invite!');

        } else if (data == 'Already a user') {

            input_error('#email', 'You are already a Koding user!');

        } else if (data == 'No email') {

            input_error('#email', 'Please enter an email address first!');

        }
    });

    // Not to post the form physically
    return false;
});

// Refresh 2s to get the values for invited and queue
setInterval(function() {
    $.ajax({
        type: 'POST',
        url: FILE,
        data: {
            action: 'get_numbers',
            rand: Math.random()
        },
        success: function(values) {
            // Split data into array
            var numbers = values;
            var array = numbers.split(',');

            // Set invites number
            if (array[0] !== 'No') {
                var original_value = $('#invites_number .number').text();
                if (original_value < array[0]) {
                    $('#invites_number .number').empty();
                    $('#invites_number .number').fadeIn(500).html(array[0]);
                }
            }

            // Set queue number
            $('#queue_number .number').empty();
            $('#queue_number .number').fadeIn(500).html(array[1]);
        }
    });
}, 2000);

// Initial invites page number to load
$("#invites").load(FILE, {
    'action': 'paginate-invites',
    'page': 0
}, function() {
    $("#1-page_invites").addClass('active');
    tooltip('n');
    // Remove request
    $('.clean').click(function() {
        $('.clean').tipsy("hide");
        var id = this.getAttribute('data-id');
        delete_request(id);
    });
});

// Paginate invites
$(".invites_wrapper .paginate_item").click(function() {

    $("#invites").append('<div class="loading"><img src="asg-includes/images/preload.gif" /> Gathering data...</div>');

    // ID of clicked element, split() to get page number.
    var clicked_id = $(this).attr("id").split("-");
    // clicked_id[0] holds the page number we need 
    var page_num = parseInt(clicked_id[0]);

    $('.invites_wrapper .paginate_item').removeClass('active');

    // Post page number and load returned data into result element
    // Subtract 1 to get actual starting point
    $("#invites").load(FILE, {
        'action': 'paginate-invites',
        'page': (page_num - 1)
    }, function() {
        tooltip('n');
        // Remove request
        $('.remove_request').click(function() {
            $('.remove_request').tipsy("hide");
            var id = this.getAttribute('data-id');
            delete_request(id);
        });
    });

    $(this).addClass('active');
});

// Initial users page number to load
$("#leaderboard").load(FILE, {
    'action': 'paginate-users',
    'page': 0
}, function() {
    $("#1-page_leaderboard").addClass('active');
});

// Paginate users
$(".leaderboard_wrapper .paginate_item").click(function() {

    $("#leaderboard").append('<div class="loading"><img src="asg-includes/images/preload.gif" /> Gathering data...</div>');

    // ID of clicked element, split() to get page number.
    var clicked_id = $(this).attr("id").split("-");
    // clicked_id[0] holds the page number we need 
    var page_num = parseInt(clicked_id[0]);

    $('.leaderboard_wrapper .paginate_item').removeClass('active');

    // Post page number and load returned data into result element
    // Subtract 1 to get actual starting point
    $("#leaderboard").load(FILE, {
        'action': 'paginate-users',
        'page': (page_num - 1)
    });

    $(this).addClass('active');
});

// Account info
$('#stats').click(function() {
    TINY.box.show({
        url: FILE,
        post: 'action=stats',
        width: WIDTH,
        height: 200,
        opacity: 60,
        topsplit: 4
    });
});