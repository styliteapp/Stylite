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
});
})(jQuery);