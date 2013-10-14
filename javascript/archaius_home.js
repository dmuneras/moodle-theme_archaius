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
        maxwidth: 'auto',
        namespace: "large-btns"
      }); 
    }
}

$(function(){
	if(activateSlideshow == true){
		startSlideShow();
		$("#toggle-admin-menu").on("click",function(){
			$(this).next().slideToggle();
		});
		//Delete slideshow using AJAX to avoid page reload.
		$(".delete-slide").on("click",function(event){
			event.preventDefault();
			$this = $(this);
			//TODO: The message has to be multilanguage.
			if(confirm("Really. Do you want to delete this slide?")){
				var url = $this.attr("href") + "&ajax=1";
				$.get(url , function(data) {
					$(".rslides_container").html("");
					$('.rslides_container').html(data);
					startSlideShow();
					var index = $(".delete-slide").index($this);
					var slidesTable = $(".admin-options table"); 
					if(slidesTable.find("tr").length > 2){
						$this.closest("tr").remove();
					}else{
						slidesTable.remove();
						$(".admin-options").append("<h2>There are not slides at the moment</h2>");
					}
					
					$(".admin-options .notice").show().html("<p>Slide deleted</p>")
						.delay( 1000 ).fadeOut('slow');
				});
			}
		});
	}
});