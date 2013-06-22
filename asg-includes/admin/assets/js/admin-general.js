// Admin Link function

function admin_href(selector) {
	var url = selector.getAttribute('data-url');
	document.location = 'asg-admin?panel=' + url;
}

// Admin Panel Navigation
$('.admin-item[data-url]').click(function() {
	admin_href(this);
});

// Admin Panel Sub Navigation
$('.admin-item-subitem[data-url]').click(function(e) {
	e.stopPropagation();
	admin_href(this);
});

// Init the editor
tinymce.init({
	selector: "#editor",
	plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste moxiemanager"
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});