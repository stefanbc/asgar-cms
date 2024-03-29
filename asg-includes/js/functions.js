	// Update user info

	function change_info(data, type) {
		// Change user info using Ajax
		$.post(AJAX_FILE, {
			action: 'change-info',
			data: data,
			type: type,
			rand: Math.random()
		}, function(result) {
			// If request is succesfull
			if (result == 'Yes') {
				// Notify user
				$('#info').text('Account details updated!');
				setTimeout(function() {
					$('#info').text('Account details');
				}, 1000);
			}
		});
	}

	// Logout function

	function logout() {
		// The action
		$.post(AJAX_FILE, {
			action: 'logout',
			rand: Math.random()
		}, function(data) {
			// If the logout has been succesfull
			if (data == 'Yes') {
				location.reload();
			}
		});
	}

	// Show a notification

	function notify(title, text, height) {
		TINY.box.show({
			html: '<div class="box_inner"><h2>' + title + '</h2>' + text + '</div>',
			width: WIDTH,
			height: height,
			opacity: 60,
			fixed: false,
			topsplit: 4
		});
	}

	// Link function

	function href(selector) {
		var url = selector.getAttribute('data-url');
		if (url == 'admin') {
			document.location = 'asg-' + url;
		} else {
			document.location = url;
		}
	}

	// Input error

	function input_error(selector, text) {
		$(selector).fadeIn(800, function() {
			if (selector == '#password') {
				$(selector)[0].type = 'text';
			}
			$(this).val(text).css({
				'background': 'rgba(255,0,0,1)',
				'color': '#fff'
			});
		});
		$(selector).click(function() {
			if (selector == '#password') {
				$(selector)[0].type = 'password';
			}
			$(this).val('').css({
				'background': '#fff',
				'color': '#ccc'
			});
		});
	}

	// Tooltip function

	function tooltip(gravity) {
		// Set up the tooltip
		$(".tooltip").each(function() {
			$(this).tipsy({
				gravity: gravity,
				fade: true,
				opacity: 1,
				title: function() {
					var title = $(this).attr('original-title');
					if (title.length > 0) {
						return title;
					}
				}
			});
		});
	}