$(document).ready(function(){
	
	$(".btn-opticraft-url-check").click(function(){
		var urlInput = $('.url-opticraft-input').val();

		$.post( "ajax.php?page=url_check", { url_post_param: urlInput } ,function(data){
  			$( ".result" ).html(data);
		});
	});
});