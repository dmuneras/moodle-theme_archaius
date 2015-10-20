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

@copyright  2013 on wards Daniel Munera Sanchez

*/

/* ARCHAIUS JS EFFECTS
-----------------------------------------------------------------------------*/

//I am using !function(){}(); because (function()()) has problem with
// Moodle javascript compression.

//Archaius effects object to execute JS effects
window.ArchaiusJSEffects = (function(window,$,undefined){

  var ArchaiusJSEffectsInstance;

  //Function to create the unique Archaius effect object
  var createArchaiusJSEffects = function(){

    //Regions of Archaius that can be converted into
    //accordions of moodle blocks
    var regionPost = $("#region-post");
    var regionPre = $("#region-pre");
    var regionCenterPre = $('#region-center-pre');
    var regionCenterPost = $('#region-center-post');
    var mediaQueries = Modernizr.mq('only all');

    //Function to animate regions using velocity or
    //any other jquery plugin in the future.
    var animateRegion = function(region,main,cssRuleRegion,cssRuleMain){
      region.velocity(cssRuleRegion,400,null);
      main.velocity(cssRuleMain ,400,null);
    }

    //Function to animate any DOM element.
    var animate = function(region,action,options){
      region.velocity(action, options);
    }

    //Effect to expand and shrink question bank
    var expandBank = function(questionBank){
      //If the display if too small, do no attach any
      //event and put question bank after quiz content
      var viewPortWidth = $(window).width();
      if(viewPortWidth <= 768){
        $("#quizcontentsblock").after($('.questionbankwindow.block'));
      }else{
        //Append button to shrink question bank
        var buttonHTML = "<a id = 'expand-bank' class='shrink"+
        " btn-warning btn pretty-link-button'>expand</input>";

        questionBank
            .find('.header')
            .first()
            .find(".title")
            .append(buttonHTML);

        var page = $('#page-mod-quiz-edit div.quizcontents');

        //Bind click event
        $('#expand-bank').on("click",function(){
          var $this = $(this);
          if($this.hasClass("shrink")){
            $this.removeClass("shrink");
            $this.html("shrink");
            animateRegion(
                questionBank,
                page,
                {'width' : '50%'},
                {'width' : '50%'}
            );
          }else{
            $this.addClass("shrink");
            $this.html("expand");
            animateRegion(
                questionBank,
                page,
                {'width' : '30%'},
                {'width' : '70%'}
            );
          }
        });
      }
    };

    var getDistanceToParent = function(item,KingOfParent){
      return item.parents(KingOfParent).length;
    };

    //Function to do some DOM transformations with window is resized
    var checkOnResize = function(){
      var viewPortWidth = $(window).width(),
        mobileCustommenu = $("#mobile-custommenu"),
        pageHeader = $("#page-header");

      if(viewPortWidth <= 768){
        if(mediaQueries == false){
          $("html").addClass("no-media-queries");
        }
        $("#custommenu").addClass("collapsed");
        if(mobileCustommenu.length == 0 ){
          var nav ="<nav id='mobile-custommenu' class='collapsed'></nav>";
          pageHeader.append(nav);

          if($("#custommenu").length > 0){
            var items = $("#custommenu ul li a");
            var clonedItems = items.clone();
            $.each(items,function(index){
              var $this = $(this),
                hierarchyLevel = getDistanceToParent($this,"div") - 4;
              //Coefficient to calculate the hierarchy of
              //menu items is 4 (minimum number of elements
              //to the parent element)
              var hierarchyLine = "";
              for(var i=0;i<hierarchyLevel;i++){
                  var itemClass = "hierarchy-mark";
                  if(i == 0 && hierarchyLevel == 1){
                      itemClass += " parent-item";
                  }else{
                      if(i == hierarchyLevel-1)
                          itemClass += " parent-item";
                  }
                  hierarchyLine += "<span class='"+ itemClass +"'></span>";
              }
              var content = hierarchyLine.concat(" ",$this.text());
              clonedItems.eq(index).prepend(hierarchyLine).removeClass();
            });
            $("#mobile-custommenu").append(clonedItems);
          }
        }else{
          pageHeader.find(".menu-icon").show();
        }
      }else{
        if(mediaQueries == false){
          $("html").removeClass("no-media-queries");
        }
        $("#custommenu").removeClass("collapsed");
        mobileCustommenu.hide();
        pageHeader.find(".menu-icon").hide();
        mobileCustommenu.addClass("collapsed");
      }
      return viewPortWidth;
    };
    var stickyCustommenu = function(){
      if(!$('#page-header').hasClass('login'))
        if($("#custommenu").length > 0 ){ $('#custommenu').waypoint('sticky'); }
    };

    var initEffects = function(){
      window.ArchaiusBlocks.organizeRegionCenter(regionCenterPre);
      window.ArchaiusBlocks.organizeRegionCenter(regionCenterPost);
      window.ArchaiusBlocks.organizeBlockSummary();
      stickyCustommenu();

      var questionBank = $(".questionbankwindow.block");
      if(questionBank.length > 0 && !(questionBank.hasClass("collapsed"))){
        expandBank($(".questionbankwindow.block"));
      }
      var windowSize = checkOnResize();
      if(windowSize >= 768 ){
        $("#custommenu").removeClass("collapsed");
      }
      $("#page-header").on("click",".menu-icon",function(){
        var $this = $(this);
        if($this.hasClass("deactive")){
          $this.removeClass("deactive");
          $this.addClass("active");
        }else{
          $this.removeClass("active");
          $this.addClass("deactive");
        }
        $("#mobile-custommenu").slideToggle();
      });

      if($("#custommenu").length > 0 || $("div.langmenu").length > 0){
        $(window).resize(function() {
          //resize just happened, pixels changed
          checkOnResize();
        });
      }
      $(".notifysuccess").velocity(
        { opacity: 0 },
        { visibility: "hidden", duration:3000 }
      );
    };
    //public functions
    return {
      hideShowBlocks: window.ArchaiusBlocks.hideShowBlocks,
      topicsCourseMenu : window.ArchaiusCourse.topicsCourseMenu,
      initSlideshow :  window.ArchaiusSlideshow.initSlideshow,
      accordionBlocks : window.ArchaiusBlocks.accordionBlocks,
      commonBlocks :  window.ArchaiusBlocks.commonBlocks,
      initEffects: initEffects
    };
  };

  return {
    getInstance: function(){
      if(!ArchaiusJSEffectsInstance){
        ArchaiusJSEffectsInstance = createArchaiusJSEffects();
      }
      return ArchaiusJSEffectsInstance;
    }
  };
})(window, jQuery);

//Init ArchaiusJSEffects when this JS is loaded!
ArchaiusJSEffects.getInstance().initEffects();

