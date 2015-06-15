$(document).ready(function(){
	
	$("#urlInput").keydown(function(event) {
    	if(event.keyCode == 13){
           $(".btn-opticraft-url-check").click();
       }
	});


	$(".btn-opticraft-url-check").click(function(){
		var urlInput = $('.url-opticraft-input').val();

		$.post( "ajax.php?page=url_check", { url_post_param: urlInput } ,function(data){
  			$( ".result" ).html(data);
		});
	});

});