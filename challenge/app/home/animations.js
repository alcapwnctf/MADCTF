$(document).ready(function(){

      if($(window).width() <= 1024) {

	$(".ham").click(function(){
		console.log("asd");
		$(".side").css({left:"0px"});
		$(".ham").css({left:"230px"});
		$(".hamlines").css({background: "#eee",opacity:0});
		$(".main2").css({opacity:"1","z-index": "100"});
	});
	
	$(".mc").click(function(){
		$(".side").css({left:"-300px"});
		$(".ham").css({left:"50px"});
		$(".hamlines").css({background: "#0984e3",opacity:"1"});
		$(".main2").css({opacity:"0","z-index": "-100"});
	});
	
	$(".main2").click(function(){
		$(".side").css({left:"-300px"});
		$(".ham").css({left:"50px"});
		$(".hamlines").css({background: "#0984e3",opacity:"1"});
		$(".main2").css({opacity:"0","z-index": "-100"});
		
	});
     
      }
});

