	// Show modal, get user email and create button to copy it.
	function get(id) {
		TINY.box.show({
			url		: FILE,
			post	: 'action=get&id=' + id,
			openjs	: function(){
				// Get the email
				var the_email = $('.the_email').text();
				// Reverse it
				var rev_text = the_email.split("").reverse().join("");
				// Copy it to clipboard
				$('button#copy-button').zclip({
					path:'asg-assets/js/modules/ZeroClipboard.swf',
					copy: rev_text,
					afterCopy:function(){
						remove(id);
						TINY.box.hide();
					}
				});
			},
			width	: WIDTH,
			height	: 120,
			opacity	: 60,
			topsplit: 3
		});
	}

	// Remove the request on click
	function remove(id) {
		// Remove invite request using Ajax
		$.post(FILE, {
			action	: 'remove',
			id		: id,
			rand    : Math.random()
		}, function (data) {
			// If request is succesfull
			if (data == 'Yes') {
				// Remove the actual request
				$('#request_' + id).fadeOut(400, function(){
					$(this).empty().remove();
				});
			}
		});
	}

	// Remove the request on click
	function delete_request(id) {
		// Remove invite request using Ajax
		$.post(FILE, {
			action	: 'delete',
			id		: id,
			rand    : Math.random()
		}, function (data) {
			// If request is succesfull
			if (data == 'Yes') {
				// Remove the actual request
				$('#request_' + id).fadeOut(400, function(){
					$(this).empty().remove();
				});
			}
		});
	}

	// Update user info
	function change_info(data,type){
		// Change user info using Ajax
		$.post(FILE, {
			action	: 'change-info',
			data	: data,
			type    : type,
			rand    : Math.random()
		}, function (result) {
			// If request is succesfull
			if (result == 'Yes') {
				// Notify user
				$('#info').text('Account details updated!');
				setTimeout(function(){
					$('#info').text('Account details');    
				}, 1000);
			}
		});
	}

	// Logout function
	function logout(){
		// The action
		$.post(FILE, {
			action: 'logout',
			rand: Math.random()
		}, function (data) {
			// If the logout has been succesfull
			if (data == 'Yes') {
				location.reload();
			}
		});
	}

	// Show a notification
	function notify(title, text, height) {
		TINY.box.show({
            html:'<div class="box_inner"><h2>' + title + '</h2>' + text + '</div>',
            width: WIDTH,
            height: height,
            opacity: 60,
            topsplit: 4
		});
	}

	// Link function
	function href(selector) {
		var url = selector.getAttribute('data-url');
        if(url == 'admin'){
            document.location = 'asg-' + url;
        } else {
            document.location = url;
        }
	}
    
    // Admin Link function
    function admin_href(selector) {
		var url = selector.getAttribute('data-url');
        document.location = 'asg-admin?page=' + url;
	}

	// Input error
	function input_error(selector, text) {
		$(selector).fadeIn(800,function(){
			if(selector == '#password'){
				$(selector)[0].type = 'text';
			}
			$(this).val(text).css({'background':'rgba(255,0,0,0.7)','color':'#fff'});
		});
		$(selector).click(function(){
			if(selector == '#password'){
				$(selector)[0].type = 'password';
			}
			$(this).val('').css({'background':'#fff','color':'#444'});
		});
	}

	// Tooltip function
	function tooltip(gravity){
		// Set up the tooltip
        $(".tooltip").each(function() {
            $(this).tipsy({
                gravity: gravity,
                fade: true,
                opacity: 1,
                title: function() {
                    var title = $(this).attr('original-title');
                    if(title.length > 0) {
                        return title;
                    }
                }
            });
        });
	}