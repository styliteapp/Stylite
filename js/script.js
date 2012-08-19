(function($){

$(document).ready(function(){
/****************************
*****************************
*****************************
********ACCOUNT**************
*****************************
*****************************
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

/****************************
*****************************
*****************************
***********CREATE************
*********STYLEBOARD**********
*****************************
****************************/
	$(".boardCreation button").click(function(){
		$("section.newItemPanel").css({
			"left":"0",
			"-webkit-box-shadow":"2px 5px 15px 0px rgba(0, 0, 0, .5)"
		});
	});
	$(".stepThree > a").click(function(){
		$("section.newItemPanel").css({
			"left":"-341.5px",
			"-webkit-box-shadow":"0px 0px 0px 0px rgba(0, 0, 0, .5)"})
			.find(".stepTwo select")
			.delay(150).val("")
			.next().val("")
			.next().val("")
			.parent().next()
			.html("<select name='color' id='itemArticle'>"
				+"<option value='' selected='selected'>what color is it?</option>"
				+"<option value='01'>red</option>"
				+"<option value='02'>white</option>"
				+"<option value='03'>blue</option>"
				+"<option value='04'>yellow</option>"
				+"<option value='05'>purple</option>"
				+"<option value='06'>green</option>"
				+"<option value='07'>orange</option>"
				+"<option value='08'>brown</option>"
				+"<option value='09'>black</option>"
				+"<option value='10'>teal</option>"
				+"<option value='11'>tan</option>"
				+"<option value='12'>gray</option>"
				+"<option value='13'>navy</option>"
				+"</select>"
				+"<a href=''>add another color</a>"
			)
		;
		$(".newItemError").addClass("hide");
		return false;
	});
	$(".stepThree button").click(function(){
		if($("#itemArticle").val()!="" && $(".stepTwo input[name=brand]").val()!="" && $(".stepTwo input[name=store]").val()!=""){
			$(".newItemError").addClass("hide");
			alert("SUCCESS");
		}else{
			$(".newItemError").removeClass("hide");
		}
	});
/*=================================
============ADD COLORS=============
=================================*/
	$(".stepTwo .col2 > a").click(function(){
		if($(this).prev().val()!=''	&& $(".stepTwo .col2 select").length < 4){
			$(this).before("<select name='color' id='itemArticle'>"
				+"<option value='' selected='selected'>what color is it?</option>"
				+"<option value='01'>red</option>"
				+"<option value='02'>white</option>"
				+"<option value='03'>blue</option>"
				+"<option value='04'>yellow</option>"
				+"<option value='05'>purple</option>"
				+"<option value='06'>green</option>"
				+"<option value='07'>orange</option>"
				+"<option value='08'>brown</option>"
				+"<option value='09'>black</option>"
				+"<option value='10'>teal</option>"
				+"<option value='11'>tan</option>"
				+"<option value='12'>gray</option>"
				+"<option value='13'>navy</option>"
				+"</select>"
			);
		}
		return false;
	});
/*=================================
============HELP SCREEN============
=================================*/
	$("header > a").click(function(){
		$("div.helpStyleboard").removeClass("hide");
		return false;
	});
	$("div.helpStyleboard").click(function(){
		$(this).addClass("hide");
		return false;
	});
});

})(jQuery);