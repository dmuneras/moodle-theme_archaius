$(function(){
	$("#toggle-admin-menu").on("click",function(){
		$(this).next().slideToggle();
	});
	$("#go-to-courses").on("click",function(){
		$("body").animate({ scrollTop: ($("#moodle-page-title").offset().top) - 10 }, 'slow');	
	});
});