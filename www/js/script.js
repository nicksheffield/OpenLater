$(document).ready(function(){
	
	$('.actions a').click(function(){
		var elem = $(this);
		
		if(elem.attr('href').indexOf('delete')>0){
			if(!confirm('Are you sure you want to do that?'))return false;
		}
		
		$.ajax({
			url:elem.attr('href'),
			success:function(msg){
				if(msg){
					elem.parent().parent().fadeOut(500);
				}
			}
		});
		
		return false;
	});
	
});