$(document).ready(function(){
	
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

	var scroll_start = 0;
  var width = $(document).width();
	
	if(width >= 768)
	{
		var startchange = $('#unique');
	}
	else
	{
		var startchange = $('#apply_now');
	}
	
  var offset = startchange.offset();
	
	/*
    if (startchange.length){
	   $(document).scroll(function() { 
	   	// alert("ssss");
	      scroll_start = $(this).scrollTop();
	      if(scroll_start > offset.top) {
	          $(".navbar-default").css('background-color', '#4155dc');
	          $("#onscroll-top").addClass('onscroll-top');
	       } else {
	          $('.navbar-default').css('background-color', 'transparent');
	           $("#onscroll-top").removeClass('onscroll-top');
	       }
	   });
    }
	*/

// 	$(window).on("scroll", function() {
// 		/* if($(window).scrollTop() > 20) {
// 			$(".navbar-default").css('background-color', '#fff');
// 			$(".after-scroll-img").css('display','block');
// 			$(".before-scroll-img").hide();
// 			$(".after-scroll-img").css('visibility','visible');
// 			$("#navbar .nav li a").css('color','#4155D9');
// 		} else {
// 			//remove the background property so it comes transparent again (defined in your css)
// 			$('.navbar-default').css('background-color', 'transparent');
// 			$(".after-scroll-img").css('display','none');
// 			$(".before-scroll-img").css('visibility','visible');
// 			$(".before-scroll-img").show();
// 			$("#navbar .nav li a").css('color','#fff');
// 		} */
		
// 		if($(window).scrollTop() > 20) {
// 			$('.navbar-fixed-top').addClass('custom-scroll-css');
// 		}
// 		else
// 		{
// 			$('.navbar-fixed-top').removeClass('custom-scroll-css');
// 		}
// 	});
	
	
    $(document).on('click', '#navbar ul li a', function(){
        var val = $('#navbar').attr('aria-expanded');
        if(val == false)
        {
            $('#navbar').addClass('in');
        }
        else
        {
            $('#navbar').removeClass('in');
        }
    });
	
		$(document).on('click', '.navbar-brand', function(){
        var val = $('#navbar').attr('aria-expanded');
        $('#navbar').removeClass('in');
    });
	
	$(document).on('click', '.panel-section', function() {
       $('.panel-section').removeClass('active');
       $(this).addClass('active');
   });
	
});
