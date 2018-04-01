$(document).ready(function(){
	$('#banner_home').after('<div id="cycle-control">').cycle({       
        fx      : 'scrollLeft',
        pager   : '#cycle-control',
        timeout : 5000,
        pause   : true 
    });	
	$("#banner_interno").after('<div id="cycle-control">').cycle({
				fx      : 'scrollLeft',
		        pager   : '#cycle-control',
		        timeout : 5000,
		        pause   : true 
    });
});
