(function($){

$(document).ready(function(){
/****************************
*							*
*							*
*		ACCOUNT				*
*							*
*							*
****************************/
	var fName,
		lName,
		aboutMe,
		email,
		passOld,
		passNew,
		passConf;
	$("h2 a").click(function(){
		$("h2 a").hide();
		var section = $(this).attr("data-dl");
		if(section === "personal"){
			fName = $(".fName").text(),
			lName = $(".lName").text(),
			aboutMe = $(".aboutMe").text();
			$(".infoContainer dl.personal").css({
				'paddingTop':'6px'
			}).find("dd.fName").html("<p class='error' style='display:none;margin:0 0 4px 0;color:red;'>oh hi</p><input id='fNameNew' type='text' name='fNameNew' value='"+fName+"' >")
				.next().next().html("<input id='lNameNew' type='text' name='lNameNew' value='"+lName+"'>")
				.next().next().html("<textarea id='aboutMeNew' rows='5'>"+aboutMe+"</textarea>")
				.parent().append("<button type='button' id='savePersonal'>SUBMIT</button>"
					+"<a href='' id='cancelPersonal'>cancel</a>")
			;
			return false;
		}else if(section === "account"){
			email = $(".email").text();
			$(".infoContainer dl.account").css({
				"paddingTop":"6px"
			}).find("dd.email").html("<input id='emailNew' type='email' name='acctEmail' value='"+email+"'>")
				.next().html("Old Password:")
				.next().html("<input id='passOld' type='password' name='passOld' value=''>")
				.parent().append("<dt>New Password:</dt>"
					+"<dd><input id='passNew' type='password' name='passNew' value=''></dd>"
					+"<dt>New Password:</dt>"
					+"<dd><input id='passConf' type='password' name='passConf' value=''></dd>"
					+"<button type='button' id='saveAccount'>SUBMIT</button>"
					+"<a href='' id='cancelPersonal'>cancel</a>"
				)
			;				
			return false;
		}
	});
/*=================================
==========EDIT PERSONAL============
=================================*/
	$("body").on("click", "div.personal button", function(){
		fName = $("#fNameNew").val(),
		lName = $("#lNameNew").val(),
		aboutMe = $("#aboutMeNew").val();
		$(".infoContainer dl.personal").css({
			"paddingTop":"0"
		}).find("dd.fName").html(fName)
			.next().next().html(lName)
			.next().next().html(aboutMe)
		;
		$(".infoContainer button").remove();
		$("dl.personal > a").remove();
		$("h2 a").show();
	});
	
	$("body").on("click", "dl.personal > a", function(){
		$(".infoContainer dl.personal").css({
			"paddingTop":"0"
		}).find("dd.fName").html(fName)
			.next().next().html(lName)
			.next().next().html(aboutMe)
		;
		$(".infoContainer button").remove();
		$("dl.personal > a").remove();
		$("h2 a").show();
		return false;
	});
/*=================================
==========EDIT ACCOUNT=============
=================================*/
	$("body").on("click", "div.account button", function(){
		email = $("#emailNew").val(),
		passOld = $("#passOld").val(),
		passNew = $("#passNew").val(),
		passConf = $("#passConf").val();
		$(".infoContainer dl.account").css({
			"paddingTop":"0"
		}).find("dd.email").html(email)
			.next().html("Password:")
			.next().html("[hidden]")
			.nextAll().remove()
		;
		$("h2 a").show();
		return false;
	});

	$("body").on("click", "dl.account > a", function(){
		$(".infoContainer dl.account").css({
			"paddingTop":"0"
		}).find("dd.email").html(email)
			.next().html("Password:")
			.next().html("[hidden]")
			.nextAll().remove()
		;
		$("h2 a").show();
		return false;
	});
});

})(jQuery);