//Global variables
var FILE = 'asg-includes/ajax/general.php';
var WIDTH = 300;

// Log Header
log('[c="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #fff; font-size: 20px; padding: 15px 20px; background: #444; border-radius: 4px; line-height: 100px; text-shadow: 0 1px #000"]Asgar Log[c]');
// Log Style
var log_style = 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 13px; color: #444; padding: 8px 0; line-height: 40px';

// Action on logo click
$('.logo').click(function() {
    href(this);
});

// Dynamic link
$('.anchor[data-url]').click(function() {
    href(this);
});

// Header Navigation
$('.nav_item[data-url]').click(function() {
    href(this);
});

// Admin Panel Navigation
$('.admin-nav-item[data-url]').click(function() {
    admin_href(this);
});

// Admin Panel Sub Navigation
$('.admin-nav-subitem[data-url]').click(function(e) {
    e.stopPropagation();
    admin_href(this);
});

// Click on account action
$('#account').click(function() {
    TINY.box.show({
        url: FILE,
        post: 'action=user-details',
        width: WIDTH,
        height: 410,
        opacity: 60,
        openjs: function() {
            // Tooltips
            tooltip('w');
            // Update user details when he enters new values in the input
            $('#account-email').on('change keyup', function() {
                var data = $('#account-email').val();
                change_info(data, 'email');
            });
            // Update user details when he enters new values in the input
            $('#account-twitter').on('change keyup', function() {
                var data = $('#account-twitter').val();
                change_info(data, 'twitter_handler');
            });
            // Update user details when he enters new values in the input
            $('#account-password').on('change keyup', function() {
                var data = $('#account-password').val();
                change_info(data, 'password');
            });
            // Update user details when he checks the box
            $('#account-notification').on('change', function() {
                var data = $('#account-notification').val();
                if (data == '1') {
                    data = 0;
                } else if (data == '0') {
                    data = 1;
                }
                change_info(data, 'notification');
            });
            // Delete account
            $("#account_form").submit(function() {
                $.post(FILE, {
                    action: 'delete-account',
                    rand: Math.random()
                }, function(data) {
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

// Login button
$('#login').click(function() {
    TINY.box.show({
        html: '<div class="box_inner"><h2>Login / Create an account</h2>You can login and create an account in the same place!' + '<form id="login_form" name="login_form">' + '<div class="spacer2"><input type="text" class="input" name="username" id="username" placeholder="Your Koding username"></div>' + '<div class="spacer2"><input type="password" class="input tooltip" name="password" id="password" placeholder="Your password" original-title="Please use a different password than the one used on Koding!"></div>' + '<div class="spacer2 button_center_2">' + '<button class="button left" id="submit" type="submit">GO</button>' + '<button class="button left secondary entypo-key tooltip" id="forgot_pass" original-title="I forgot my password!"></button>' + '</div>' + '</form>' + '</div>',
        width: WIDTH,
        height: 220,
        opacity: 60,
        openjs: function() {
            // Tooltips
            tooltip('s');
            // Submit the form
            $("#login_form").submit(function() {
                $.post(FILE, {
                    action: 'login-create',
                    username: $('#username').val(),
                    password: $('#password').val(),
                    rand: Math.random()
                }, function(data) {
                    if (data == 'Yes') {
                        TINY.box.hide();
                        location.reload();
                    } else if (data == 'No 1') {

                        input_error('#username', 'You forgot to enter the username!');

                    } else if (data == 'No 3') {

                        input_error('#password', 'You got the password wrong!');

                    }
                });
                // Not to post the form physically
                return false;
            });
            // Forgot password
            $("#forgot_pass").click(function() {
                TINY.box.show({
                    html: '<div class="box_inner"><h2>Forgot password?</h2>Enter your email address and we\'ll reset your password in just a few seconds!' + '<form id="forgot_form" name="forgot_form">' + '<div class="spacer2"><input type="email" class="input" name="forgot_email" id="forgot_email" placeholder="Your email"></div>' + '<div class="spacer2 button_center">' + '<button class="button" id="submit" type="submit">reset password</button>' + '</div>' + '</form>' + '</div>',
                    width: WIDTH,
                    height: 180,
                    opacity: 60,
                    openjs: function() {
                        $("#forgot_form").submit(function() {
                            $.post(FILE, {
                                action: 'forgot_pass',
                                email: $('#forgot_email').val(),
                                rand: Math.random()
                            }, function(data) {
                                if (data == 'Yes') {
                                    // Notify the user
                                    notify('Password Reset!', 'Your password has been changed. Please check your inbox (spam or trash) for the email with your new password.', 110);
                                } else {
                                    // Notify the user
                                    notify('Password Reset Error!', 'The email you provided is not in our database. Please try again with the correct email address!', 100);
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
$('#logout').click(function() {
    logout();
});

// General tooltips
tooltip('n');

// Analytics
analytics.initialize({
    'Google Analytics': 'UA-23832918-8',
    'GoSquared': 'GSN-404465-F'
});