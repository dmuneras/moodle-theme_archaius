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

@copyright  2015 on wards Daniel Munera Sanchez

*/

/* ARCHAIUS SLIDESHOW JS
-----------------------------------------------------------------------------*/
window.ArchaiusSlideshow = (function(window,$,undefined){
  var startSlideShow = function(activatePausePlay,slideshowTimeout){
    var pausePlay = parseInt(activatePausePlay);
    if(slideshowTimeout < 1500){
      var slideshowTimeout = 1500;
    }
    if($(".rslides").length > 0){
      var options = {
        auto : true,
        speed : 1000,
        timeout : slideshowTimeout,
        pausePlay : pausePlay,
        pager : true,
        nav : true,
        maxwidth : 'auto',
        namespace : "large-btns",
        callback : function(){
          $(".rslides_container").addClass("ready");
        }
      }
      $(".rslides").responsiveSlides(options);
    }
  };
  var initSlideshow = function(activatePausePlay,slideshowTimeout,confirmationDeleteSlide,noSlides){
    startSlideShow(activatePausePlay,slideshowTimeout);
    $("#toggle-admin-menu").on("click",function(){
      var action = "slideUp";
      $this = $(this);
      if(! $this.hasClass("expanded")){
        var action = "slideDown";
        $this.addClass("expanded");
      }else{
        $this.removeClass("expanded");
      }
      _animate($this.next(), action, { duration: 500 });
    });
    //Delete slideshow using AJAX to avoid page reload.
    $(".delete-slide").on("click",function(event){
      event.preventDefault();
      $this = $(this);
      if(confirm(confirmationDeleteSlide)){
        var url = $this.attr("href") + "&ajax=1";
        $.get(url , function(data) {
          $(".rslides_container").html("");
          $('.rslides_container').html(data);
          startSlideShow(activatePausePlay,slideshowTimeout);
          var index = $(".delete-slide").index($this),
            slidesTable = $(".admin-options table");
          if(slidesTable.find("tr").length > 2){
            $this.closest("tr").remove();
          }else{
            slidesTable.remove();
            $(".admin-options").append("<h2>" + noSlides +"</h2>");
          }
          $(".admin-options .notice")
            .show()
            .html("<p>Slide deleted</p>")
            .delay( 1000 )
            .fadeOut('slow');
        });
      }
    });
  };

  //Function to animate any DOM element.
  var _animate = function(region,action,options){
    region.velocity(action, options);
  }

  //public functions
  return {
    initSlideshow : initSlideshow
  };
})(window, jQuery);