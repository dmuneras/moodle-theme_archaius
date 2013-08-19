/* --------------------------------------------------------------                             
   Javascript functions for the frontpage. I am using responsive
   slides plugin.
-------------------------------------------------------------- */

//Function to start the slideshow using responsiveSlides 
//framework.
function startSlideShow(){
	if((".rslides").length > 0){
       $(".rslides").responsiveSlides({
        auto: false,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "large-btns"
      }); 
    }
}

$(function(){
	startSlideShow();

	$("#toggle-admin-menu").on("click",function(){
		$(this).next().slideToggle();
	});

	//Scroll down to courses.
	$("#go-to-courses").on("click",function(){
		$("body").animate({ 
			scrollTop: ($("#moodle-page-title").offset().top) - 10 },
			 'slow'
		);	
	});

	//Delete slideshow using AJAX to avoid page reload.
	$(".delete-slide").on("click",function(event){
		event.preventDefault();
		$this = $(this);
		//TODO: The message have to be multilanguage.
		if(confirm("Really. Do you want to delete this slide?")){
			var url = $this.attr("href") + "&ajax=1";
			$.get(url , function(data) {
				$(".rslides_container").remove();
				$('#content-left').html(data);
				startSlideShow();
				var index = $(".delete-slide").index($this);
				$this.closest("tr").remove();
				$(".admin-options .notice").show().html("<p>Slide deleted</p>")
					.delay( 1000 ).fadeOut('slow');
			});
		}
	});


});