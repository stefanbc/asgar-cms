//Global variables
var FILE = 'asg-includes/ajax/general.php';
var WIDTH = 300;

$(document).ready(function(){
    
    // Log Header
    log('[c="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #fff; font-size: 20px; padding: 15px 20px; background: #444; border-radius: 4px; line-height: 100px; text-shadow: 0 1px #000"]Koding Community Platform Log[c]');
    // Log Style
    var log_style = 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 13px; color: #444; padding: 8px 0; line-height: 40px';
    
    // Action on logo click
    $('.logo').click(function(){ href(this); });
    
    // Top Navigation
    $('.nav_item[data-url]').click(function(){ href(this); });

    // Click on account action
    $('#account').click(function(){
        TINY.box.show({
            url     : FILE,
            post    : 'action=user-details',
            width   : WIDTH,
            height  : 430,
            opacity : 60,
            openjs  : function(){
                // Tooltips
                tooltip('w');
                // Update user details when he enters new values in the input
                $('#account-email').on('change keyup', function() {
                    var data = $('#account-email').val();
                    change_info(data,'email');
                });
                // Update user details when he enters new values in the input
                $('#account-twitter').on('change keyup', function() {
                    var data = $('#account-twitter').val();
                    change_info(data,'twitter_handler');
                });
                // Update user details when he enters new values in the input
                $('#account-password').on('change keyup', function() {
                    var data = $('#account-password').val();
                    change_info(data,'password');
                });
                // Update user details when he checks the box
                $('#account-notification').on('change', function() {
                    var data = $('#account-notification').val();
                    if(data == '1') {
                        data = 0;
                    } else if (data == '0') {
                        data = 1;
                    }
                    change_info(data,'notification');
                });
                // Delete account
                $("#account_form").submit(function () {                    
                    $.post(FILE, {
                        action : 'delete-account',
                        rand: Math.random()
                    }, function (data) {
                        if (data == 'Yes') {
                            TINY.box.hide();
                            logout();
                        }                        
                    });
                    // Not to post the form physically
                    return false;
                });
            },
            topsplit: 4
        });
    });

    // Account info
    $('#badges').click(function(){
        TINY.box.show({
            url     : FILE,
            post    : 'action=badges',
            width   : WIDTH,
            height  : 200,
            opacity : 60,
            topsplit: 4
        });
    });

    // Disclaimer button
    $('#disclaimer').click(function(){
        TINY.box.show({
           html:'<div class="box_inner"><h2>Usage</h2>This platform is for Koding users, to be able to send you invites, without waiting for Koding to send batches of invites!<h2>Invites</h2>In case you received multiple invite emails, you can forward them to other people, so they can also enjoy the Koding awesomeness!<h2>Privacy</h2>We take privacy seriously, we will not share any personal information with anybody, ever! However, the information you provide may be stored in a database for archive purposes.<h2>Issues</h2>If you notice any problems with this app or you just want to say hi you can drop a line <a href="mailto:koding.community@gmail.com" title="Issues">here</a>.</div>',
           width: WIDTH,
           height: 375,
           opacity: 60,
           openjs: function(){
                // Easter Egg #1
                log.l('%cNo, no nothing to see here!', log_style);
           },
           topsplit: 4
        });
    });
    
    // Login button
    $('#login').click(function(){
        TINY.box.show({
            html: '<div class="box_inner"><h2>Login / Create an account</h2>You can login and create an account in the same place!' +
                    '<form id="login_form" name="login_form">' +
                        '<div class="spacer2"><input type="text" class="input" name="username" id="username" placeholder="Your Koding username"></div>' +
                        '<div class="spacer2"><input type="password" class="input tooltip" name="password" id="password" placeholder="Your password" original-title="Please use a different password than the one used on Koding!"></div>' +
                        '<div class="spacer2 button_center_2">' +
                            '<button class="button left" id="submit" type="submit">GO</button>' + 
                            '<button class="button right width-20 entypo-key tooltip" id="forgot_pass" original-title="I forgot my password!"></button>' +
                        '</div>' +
                    '</form>' + 
                    '</div>',
            width: WIDTH,
            height: 220,
            opacity: 60,
            openjs: function(){
                // Tooltips
                tooltip('s');
                // Submit the form
                $("#login_form").submit(function () {                    
                    $.post(FILE, {
                        action : 'login-create',
                        username: $('#username').val(),
                        password: $('#password').val(),
                        rand: Math.random()
                    }, function (data) {
                        if (data == 'Yes') {
                            TINY.box.hide();
                            location.reload();
                        } else if (data == 'No 1'){
                            
                            input_error('#username','You forgot to enter the username!');
                            
                        } else if (data == 'No 3'){              
                            
                            input_error('#password','You got the password wrong!');
                            
                        }
                    });    
                    // Not to post the form physically
                    return false;
                });
                // Forgot password
                $("#forgot_pass").click(function(){
                    TINY.box.show({
                        html: '<div class="box_inner"><h2>Forgot password?</h2>Enter your email address and we\'ll reset your password in just a few seconds!' +
                                '<form id="forgot_form" name="forgot_form">' +
                                    '<div class="spacer2"><input type="email" class="input" name="forgot_email" id="forgot_email" placeholder="Your email"></div>' +
                                    '<div class="spacer2 button_center">' +
                                        '<button class="button" id="submit" type="submit">RESET</button>' +
                                    '</div>' +
                                '</form>' + 
                                '</div>',
                        width: WIDTH,
                        height: 180,
                        opacity: 60,
                        openjs: function(){
                            $("#forgot_form").submit(function(){
                                $.post(FILE, {
                                    action : 'forgot_pass',
                                    email: $('#forgot_email').val(),
                                    rand: Math.random()
                                }, function (data) {
                                    if (data == 'Yes') {
                                        // Notify the user
                                        notify('Password Reset!','Your password has been changed. Please check your inbox (spam or trash) for the email with your new password.',110);
                                    } else {
                                        // Notify the user
                                        notify('Password Reset Error!','The email you provided is not in our database. Please try again with the correct email address!',100);
                                    }
                                });    
                                return false;
                            });
                        },
                        topsplit: 4
                    });
                });
            },
            topsplit: 4
        });
    });
    
    // Logout button
    $('#logout').click(function(){ logout(); });
    
	// Request an Invite
    $("#request_invite_form").submit(function () {
        $.post(FILE, {
            action	: 'request',
            email   : $('#email').val(),
            rand: Math.random()
        }, function (data) {
            // If request is succesfull
            if (data == 'Yes') {
                // Yey!!
                TINY.box.show({
					html:'<div class="box_inner">Your request has been registered. One community member will invite you as soon as possible! Thank you for your interest in Koding! Have a nice day!<br>' +
                        '<div id="share">' +
                            '<span>Spread the word</span><div id="shareme" data-url="http://stefanbc.beta.koding.com/request/" data-text="I\'ve just requested a @koding invite from the community! http://koding.com via "></div>' +
                        '</div>' +
                    '</div>',
					width:WIDTH,
					height:95,
					opacity:60,
                    openjs: function(){
                        $('#shareme').sharrre({
                            share: {
                                twitter: true,
                                facebook: true,
                                googlePlus: true
                            },
                            template: '<div class="box"><div class="left">Share</div><div class="middle"><a href="#" class="facebook">f</a><a href="#" class="twitter">t</a><a href="#" class="googleplus">+1</a></div><div class="right">{total}</div></div>',
                            enableHover: false,
                            enableTracking: true,
                            render: function(api, options){
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
					topsplit:4
				});
                $('#email').val('').css({'background':'#fff','color':'#444'});
                
            } else if (data == 'Bad Email') {
                
                input_error('#email','Please enter a valid email!');
                
            } else if (data == 'Exists') {
                
                input_error('#email','You have already requested an invite!');
                
            } else if (data == 'Already a user') {
                
                input_error('#email','You are already a Koding user!');
                
            } else if (data == 'No email') {
                
                input_error('#email','Please enter an email address first!');
                
            }
        });

        // Not to post the form physically
        return false;
    });
    
    // Refresh 2s to get the values for invited and queue
    setInterval(function(){
        $.ajax({  
            type: 'POST',  
            url: FILE,  
            data: { 
                action    : 'get_numbers',
                rand: Math.random() 
            },
            success: function(values) {  
                // Split data into array
                var numbers = values;
                var array = numbers.split(',');
                
                // Set invites number
                if (array[0] !== 'No') {                
                    var original_value = $('#invites_number .number').text();                
                    if(original_value < array[0]) {
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
    
    // Submit an app idea
    $("#app_idea_form").submit(function () {
        
        notify('Coming soon!','This feature will be available soon!', 60);
        
        var name = $('#app_name').val();
        var email = $('#email').val();
        
        TINY.box.show({
            html: '<div class="box_inner"><div class="spacer2">We need a few more details before you can submit your awesome contest entry!</div>' +
                    '<form id="main_app_form" name="main_app_form">' +
                        '<span>Your Email:</span><input type="text" class="input" name="app_email" id="app_email" value="' + email + '">' +
                        '<span>Koding Username:</span><input type="text" class="input" name="username" id="username">' +
                        '<span>App Name:</span><input type="text" class="input" value="' + name + '" name="app_name" id="app_name">' +
                        '<span>App icon / screenshot URL:</span><input type="text" class="input" name="image_url" id="image_url">'+
                        '<span>App short description:</span><textarea class="textarea" id="description"></textarea>' +
                        '<div class="button_center">' +
                            '<button class="button" id="submit" type="submit">SUBMIT ENTRY</button>' +
                        '</div>' +
                    '</form>' + 
                    '</div>',
            width: WIDTH,
            height: 450,
            opacity: 60,
            topsplit: 4,
            openjs: function(){
                $('#main_app_form').submit(function(){
                    $.post(FILE , {
                        action: 'submit_app_entry',
                        email: $('#app_email').val(),
                        username: $('#username').val(),
                        app_name: $('#app_name').val(),
                        image_url: $('#image_url').val(),
                        description: $('#description').val(),
                        rand: Math.random()
                    }, function (data) {
                        // If request is succesfull
                        if (data == 'Yes') {
                            log(data);
                            TINY.box.hide();
                        }
                    });
                    return false;        
                });
            }
        });
        
        // Not to post the form physically
        return false;
    });

    // Go to the Invite page
    $('#giveaway').click(function(){
        $('.first_wrapper').fadeOut(500,function(){
            $('.invite_wrapper').fadeIn(500,function(){
                $('html, body').animate({
                    scrollTop: $(".invite_wrapper").offset().top
                }, 500);
            });
        });
    }); 

    // Go back [H1] to the main page
    $('h1.invite_back').click(function(){
        $('.invite_wrapper').fadeOut(500,function(){
            $('.first_wrapper').fadeIn(500);
        });
    });
    
    // The hover effect on the back button
    $('h1.invite_back').hover(
        function(){
            $(this).html('Request an Invite!').prepend( $('<span>&#8678;</span>') );
        }, 
        function () {
            $(this).html('Giveaway an Invite!').find('span').remove();
        }
    );
    
    // General tooltips
    tooltip('n');
        
    // Show invite list based on url parameter
    if(location.search == "?inviteList"){
        $('.special-edition').hide();
        $('.first_wrapper').hide();
        $('.invite_wrapper').show();       
    }
        
    // Check if it's called in the Koding iframe
    var isInIframe = (window.location != window.parent.location) ? true : false;
    // And hide the footer because we don't need it
    if(isInIframe){
        // Refresh the page every 10s
        if ( $(".invite_wrapper").is(':visible') ){
            setInterval(function(){
                document.location = '?invite_list=1';
            },10000);
        }
    }
    
    // Initial invites page number to load
    $("#invites").load(FILE, {
        'action'    : 'paginate-invites',
        'page'      : 0
    },function(){
        $("#1-page_invites").addClass('active');
        tooltip('n');
        // Remove request
        $('.remove_request').click(function(){
            $('.remove_request').tipsy("hide");
            var id = this.getAttribute('data-id');
            delete_request(id);
        });
    });
    
    // Initial users page number to load
    $("#leaderboard").load(FILE, {
        'action'    : 'paginate-users',
        'page'      : 0
    }, function() {
        $("#1-page_leaderboard").addClass('active');
    });
    
    // Paginate invites
    $(".invite_wrapper .paginate_item").click(function(){
        
        // ID of clicked element, split() to get page number.
		var clicked_id = $(this).attr("id").split("-");
        // clicked_id[0] holds the page number we need 
		var page_num = parseInt(clicked_id[0]); 
		
		$('.invite_wrapper .paginate_item').removeClass('active'); 
		
        // Post page number and load returned data into result element
        // Subtract 1 to get actual starting point
		$("#invites").load(FILE, {
            'action'    : 'paginate-invites',
            'page'      : (page_num - 1)
        },function(){
            tooltip('n');
            // Remove request
            $('.remove_request').click(function(){
                $('.remove_request').tipsy("hide");
                var id = this.getAttribute('data-id');
                delete_request(id);
            });
        });

		$(this).addClass('active');
	});
    
    // Paginate users
	$(".second_wrapper .paginate_item").click(function(){
        
        // ID of clicked element, split() to get page number.
		var clicked_id = $(this).attr("id").split("-");
        // clicked_id[0] holds the page number we need 
		var page_num = parseInt(clicked_id[0]); 
		
		$('.second_wrapper .paginate_item').removeClass('active'); 
		
        // Post page number and load returned data into result element
        // Subtract 1 to get actual starting point
		$("#leaderboard").load(FILE, {
            'action'    : 'paginate-users',
            'page'      : (page_num - 1)
        });

		$(this).addClass('active');
	});
});

// Analytics
analytics.initialize({
    'Google Analytics' : 'UA-23832918-8',
    'GoSquared'        : 'GSN-404465-F'
});