jQuery(document).ready(function() { 
	if(location.search.substr(1).split('=')[0] == 'addorder')
        $(".navbar-header").css('display', 'none');
    
	 $('.carousel-inner div:first').addClass('active');
});