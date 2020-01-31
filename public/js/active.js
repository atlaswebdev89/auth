jQuery(document).ready(function() {
$(function () { 
    $('#menu li a').each(function () {
        var location = window.location.href;
	var last = location[location.length-1];
        var link = this.href; 
	if (last == "/") {
				var location = location.slice(0, -1);
			}
	if(location == link) {
            $(this).addClass('active');
        }
    });
});
});
