$(document).ready(function(){

	$("iframe").css("display","none");
	
	$("#buyerb").click(function(){
		//$("#topthree").fadeOut();

	})

	$("#bsignup").click(function(){
<<<<<<< HEAD
		$("#frm").children("#frames").remove();
		$("#frm").append('<iframe id="frames" src="login/bsignup.html" frameborder="0" scrolling="yes"></iframe>');
		$("#frames").fadeIn(2000);
	})

	$("#ssignup").click(function(){
		$("#frm").children("#frames").remove();
		$("#frm").append('<iframe id="frames" src="login/ssignup.html" frameborder="0" scrolling="yes"></iframe>');
		$("#frames").fadeIn(2000);
	})

	$("#bsignin").click(function(){
		$("#frm").children("#frames").remove();
		$("#frm").append('<iframe id="frames" src="login/bsignin.html" frameborder="0" scrolling="yes"></iframe>');
		$("#frames").fadeIn(2000);
	})

	$("#ssignin").click(function(){
		$("#frm").children("#frames").remove();
		$("#frm").append('<iframe id="frames" src="login/ssignin.html" frameborder="0" scrolling="yes"></iframe>');
		$("#frames").fadeIn(2000);
=======
		$("iframe").fadeIn(2000);
>>>>>>> 3d11a93e748df12fcf9596b314a80037af8bc40c
	})

})