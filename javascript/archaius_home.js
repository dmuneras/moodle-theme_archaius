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
	$("#go-to-courses").on("click",function(){
		$("body").animate({ scrollTop: ($("#moodle-page-title").offset().top) - 10 }, 'slow');	
	});

	$(".delete-slide").on("click",function(event){
		event.preventDefault();
		$this = $(this);
		if(confirm("Really. Do you want to delete this slide?")){
			var url = $this.attr("href") + "&ajax=1";
			$.get(url , function(data) {
				$(".rslides_container").remove();
				$('#content-left').html(data);
				startSlideShow();
				var index = $(".delete-slide").index($this);
				$this.closest("tr").remove();
			});
		}
	});


});