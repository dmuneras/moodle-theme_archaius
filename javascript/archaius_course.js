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

/* ARCHAIUS COURSE JS
-----------------------------------------------------------------------------*/
window.ArchaiusCourse = (function(window,$,undefined){
  //Create collapsible topics effect
  var topicsCourseMenu = function(active){
    //unordered list of topics.
    var topics = $('ul.topics'),
      editing = $('div.commands').length > 0; //command is the class of editing containers.

    //Verify if we are in the main view of chapters. And
    //check if the effect it need(criteria topics > 2)
    if(($("div.summary").length > 2) && (topics.length != 0)
        && active != 0 && !(editing)){

      // course sections.
      var sections = topics.find('li.section.main');
      //tab selector the create the topic tabs
      var tabSelector = "h3.sectionname";
      if(topics.find(tabSelector).length != topics.find("li.section.main").length ){

        //Create a title for tabs if title is not present
        sections.each(function(index){
          $this = $(this);
          if($this.find(tabSelector).length == 0){
            var alternativeTabHTML = "<h3 class='sectionname'> Topic " + index  + "</h3>";
            $this.find("div.summary").prepend(alternativeTabHTML);
          }
        });
      }
      var topicTab = topics.find(tabSelector);
      //this hide first tab when it doesnt have title
      topicTab.addClass("topic-tab").removeClass("accesshide");
      topicTab.prepend("<span class='triangle'></span>");
      //update the sections variable after prepend the first section.
      sections = topics.find('li.section.main');
      //put each tab outside of the topics container.
      sections.each(function(){
        var $this = $(this);
        $this.before($this.find(tabSelector));
        //Add hidden class if section hidden
        if($this.hasClass('hidden'))
          $this.prev().addClass('hidden');
        if($this.hasClass('current'))
          $this.prev().addClass('highlighted');
      });

      //Bind click event to open and close topics
      topicTab.bind("click", function(){
        var content = $(this).next();
        if($(this).hasClass("current")){
          $(this).removeClass("current");
          content.velocity("slideUp",{duration : 300});
        } else {
          $(this).addClass("current");
          content.velocity("slideDown",{duration : 300});
        }
      });

      //Open highlighted topic
      $(tabSelector + '.highlighted').trigger('click');
    }else if(active == false){
      //Show all sections it the effect is deactive
      topics.find('li.section.main').show();
    }else{
      //If there is only one topic, display it.
      $("li.section.main").css("display","block");
    }
  };
  //public functions
  return {
    topicsCourseMenu : topicsCourseMenu
  };
})(window, jQuery);