$(document).ready(function(){
	
	$('#mensaje').slideDown('slow');
		setTimeout(function(){
			$('#mensaje').slideUp('slow');
		},3000);
});