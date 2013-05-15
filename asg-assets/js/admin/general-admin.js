//Global variables
var FILE = 'asg-includes/ajax/general.php';
var WIDTH = 300;

$(document).ready(function(){    
    
    // Top Navigation
    $('.admin-nav-item[data-url]').click(function(){ 
        admin_href(this);
    });
    
    $('.admin-nav-subitem[data-url]').click(function(e){
        e.stopPropagation();
        admin_href(this);
    });
    
});