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

/* ARCHAIUS BLOCKS JS
-----------------------------------------------------------------------------*/
window.ArchaiusBlocks = (function(window,$,undefined){

  //REGEX BY JAMES PADOLSEY
  $.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
    validLabels = /^(data|css):/,
    attr = {
        method: matchParams[0].match(validLabels) ?
        matchParams[0].split(':')[0] : 'attr',
        property: matchParams.shift().replace(validLabels,'')
    },
    regexFlags = 'ig',
    regex = new RegExp(matchParams.join('')
               .replace(/^\s+|\s+$/g,''), regexFlags);
    return regex.test($(elem)[attr.method](attr.property));
  }

  var regionPost = $("#region-post"),
    regionPre = $("#region-pre"),
    regionCenterPre = $('#region-center-pre'),
    regionCenterPost = $('#region-center-post');

  //Hide and show effects for left and right block regions
  var hideShowBlocks = function(){
    var regionMiddle = $("#region-middle"),
    moveLeftTrigger =
      "<div id='move-region-left' class='move fa fa-bars'></div>";

    if(regionPre.length > 0 ){
      $("#regions-control").append(moveLeftTrigger);
      if(M.theme_archaius_loader.showRegionPre === 0){
        regionPre.addClass('initial-hidden-region');
        $("#move-region-left").addClass('hidden-region');
        regionMiddle.addClass('initial-left-region-hidden');
      }
      $("#move-region-left").on("click", function(){
        var $this = $(this);
        if(!($(this).hasClass("hidden-region"))){
            $this.addClass("hidden-region");
            _animateRegion(
                regionPre,
                regionMiddle,
                {'margin-left' : '-=20%'},
                {'width' :'+=20%'}
            );
            M.theme_archaius_loader.setUserPreference('side-pre',0);
        }else{
            $this.removeClass("hidden-region");
            _animateRegion(
                regionPre,
                regionMiddle,
                {'margin-left':'+=20%'},
                {'width':'-=20%'}
            );
            M.theme_archaius_loader.setUserPreference('side-pre',1);
        }
      });
    }
    if(regionPost.length > 0){
      $("#regions-control").append("<div id='move-region-right' class='move fa fa-bars'></div>");
      if(M.theme_archaius_loader.showRegionPost === 0){
        regionPost.addClass('initial-hidden-region');
        regionMiddle.addClass('initial-right-region-hidden');
        $("#move-region-right").addClass('hidden-region');
      }else{
        if(M.theme_archaius_loader.showRegionPre === 0){
          regionMiddle.addClass('not-hidden-right');
          regionPre.addClass('not-hidden-right');
        }
      }
      if(M.theme_archaius_loader.showRegionPost === 0 &&
        M.theme_archaius_loader.showRegionPre === 0){
        regionPre.addClass('both');
      }
      $("#move-region-right").on("click",function(){
        var $this = $(this);
        if(!($this.hasClass("hidden-region"))){
          $this.addClass("hidden-region");
          _animateRegion(
            regionPost,
            regionMiddle,
            {'margin-right':'-=20%'},
            {'width' : '+=20%'}
          );
          M.theme_archaius_loader.setUserPreference('side-post',0);
        }else{
          $this.removeClass("hidden-region");
          _animateRegion(
            regionPost,
            regionMiddle,
            {'margin-right' : '+=20%'},
            {'width' : '-=20%'}
          );
          M.theme_archaius_loader.setUserPreference('side-post',1);
        }
      });
    }
  };

  //Function to append header to Block summary in order to
  //make it works with accordion effect.
  var organizeBlockSummary = function(){
    var blockSummary = $('#inst2');
    if(blockSummary.prev(".header-tab").length == 0){
      var header = $('#region-post .header-tab:first');
      var clon = header.clone();
      clon.find("h2").html("");
      blockSummary.before(clon);
    }
  };

 var accordionBlocks = function(){
    if(regionPre.length != 0){ regionPre.archaiusCustomBlocks(); }
    if(regionPost.length != 0 ){ regionPost.archaiusCustomBlocks({regionLocation: "post"}); }
    if($("#report-region-pre").length > 0){ $("#report-region-pre").archaiusCustomBlocks(); }
  };

  var commonBlocks = function(){
    if(regionPre.length != 0){ regionPre.addClass("no-accordion"); }
    if(regionPost.length != 0 ){ regionPost.addClass("no-accordion"); }
    if($("#report-region-pre").length > 0){ $("#report-region-pre").addClass("no-accordion"); }
  };

  var organizeRegionCenter = function(region){
    if((region.length != 0) && ($(".commands").length == 0)){
      region.find(".header-tab").on("click",function(){
        $(this).next().slideToggle( "slow");
      });
    }else{
      region.find(".commands").each(function(){
        $(this).appendTo($(this).parent().parent().parent().prev());
      });
      region.find("div:regex(id,inst)").show();
    }
  };

  //Function to animate regions using velocity or
  //any other jquery plugin in the future.
  var _animateRegion = function(region,main,cssRuleRegion,cssRuleMain){
    region.velocity(cssRuleRegion,400,null);
    main.velocity(cssRuleMain ,400,null);
  }

  //public functions
  return {
    hideShowBlocks : hideShowBlocks,
    organizeRegionCenter : organizeRegionCenter,
    organizeBlockSummary: organizeBlockSummary,
    accordionBlocks : accordionBlocks,
    commonBlocks : commonBlocks
  };
})(window, jQuery);