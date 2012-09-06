(function($){

$(document).ready(function(){
	$("nav a").on("click", function(){
		var articleId = $(this).attr("href");
		$("nav a").removeClass("active");
		$(this).addClass("active");
		$("article").hide();
		$(articleId).show();
		return false;
	});

	$("#launch .timer").countdown({until: new Date(2012, 8, 27, 19)});

	//$("#launch #email").validate();

	$("#sendEmail").click(function(){
		var eAddress = $("#launch #email").val();
		if(/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$/.test(eAddress)){
			$.ajax({
				url		:	Stylite.url('api/signup'),
				type	:	'POST',
				dataType:	'json',
				data	:	{
					email	:	eAddress
				},
				success	:	function(response){
					console.log(response);
				}
			});
		}else{
			alert("Please type in a valid email address to subscribe.");
		}
	});
});
})(jQuery);