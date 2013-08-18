function startSlideShow(){
	if((".slidetabs").length > 0){
        $(".slidetabs").tabs(".slides > div.slide", {
        // enable "cross-fading" effect
        effect: 'fade',
        fadeOutSpeed: "slow",
     
        // start from the beginning after the last tab
        rotate: true
     
        // use the slideshow plugin. It accepts its own configuration
        }).slideshow();
    }
}

$(function(){

	$(".rslides").responsiveSlides({
        auto: false,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "large-btns"
      });

	//startSlideShow();
	$("#toggle-admin-menu").on("click",function(){
		$(this).next().slideToggle();
	});
	$("#go-to-courses").on("click",function(){
		$("body").animate({ scrollTop: ($("#moodle-page-title").offset().top) - 10 }, 'slow');	
	});

	$(".delete-slide").on("click",function(event){
		event.preventDefault();
		$this = $(this);
		if(confirm("Really. Do you want to delete slide:")){
			$.get($this.attr("href"), function() {
  				alert('slide number: '+ index +' was successfull deleted');
			});
		}
	});


});