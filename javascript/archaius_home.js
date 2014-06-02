/*  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

This plugin is part of Archaius theme, if you use it outside the theme
you should create your own styles. You can use archaius stylesheet as
a example.

@copyright  2013 Daniel Munera Sanchez

*/

/* --------------------------------------------------------------                             
   Javascript functions for the frontpage. I am using responsive
   slides plugin.
-------------------------------------------------------------- */
(function(window, $, undefined){
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
                namespace: "large-btns",
                callback: function(){ 
                    $(".rslides_container").addClass("ready");
                }
            });
        }
    }
	if(M.theme_archaius_loader.activateSlideshow == true){
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
}(this,jQuery));