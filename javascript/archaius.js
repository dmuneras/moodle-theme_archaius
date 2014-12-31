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
        var animateRegion = function(
            region,
            main,
            cssRuleRegion,
            cssRuleMain){

            region.velocity(cssRuleRegion,400,null);
            main.velocity(cssRuleMain ,400,null);

        }

        //Function to animate any DOM element.
        var animate = function(region,action,options){
            region.velocity(action, options);
        }

        //Hide and show effects for left and right block regions
        var hideShowBlocks = function(){
            var regionMain = $("#region-main");
            
            var reportRegionPre = $("#report-region-pre");

            var moveLeftTrigger = 
                "<div id='move-region' class='move'></div>";

            if(reportRegionPre.length > 0){

                $("#regions-control").append(moveLeftTrigger);

                if(M.theme_archaius_loader.showRegionPre === 0){
                    reportRegionPre.addClass('initial-hidden-region');
                    $("#move-region").addClass('hidden-region');
                    $(".report-page").find(".main-report-content").addClass('initial-left-region-hidden');
                }
                var reportRegionContent =  
                    $(".report-page").find(".main-report-content");

                $("#move-region").on("click",function(){
                    if(!($(this).hasClass("hidden-region"))){
                        $("#move-region").addClass("hidden-region");
                        animateRegion(
                            reportRegionPre,
                            reportRegionContent,
                            {'margin-left':'-=220px'},
                            {'width':'100%'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-pre',0);
                    }else{
                        $("#move-region").removeClass("hidden-region");
                        animateRegion(
                            reportRegionPre,
                            reportRegionContent,
                            {'margin-left' : '+=220px'},
                            {'width' : '75%'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-pre',1);
                    }
                });
            }
            if(regionPre.length > 0 ){

                $("#regions-control").append(moveLeftTrigger);

                if(M.theme_archaius_loader.showRegionPre === 0){
                    regionPre.addClass('initial-hidden-region');
                    $("#move-region").addClass('hidden-region');
                    regionMain.addClass('initial-left-region-hidden');
                }
                $("#move-region").on("click", function(){
                    var $this = $(this);
                    if(!($(this).hasClass("hidden-region"))){
                        $this.addClass("hidden-region");
                        animateRegion(
                            regionPre,
                            regionMain,
                            {'left' : '-=200px'},
                            {'margin-left' :'-=200px'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-pre',0);
                    }else{
                        $this.removeClass("hidden-region");
                        animateRegion(
                            regionPre,
                            regionMain,
                            {'left':'+=200px'},
                            {'margin-left':'+=200'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-pre',1);
                    }
                });
            }
            if(regionPost.length > 0){

                $("#regions-control")
                    .append("<div id='move-region-right' class='move'></div>");
                if(M.theme_archaius_loader.showRegionPost === 0){
                    regionPost.addClass('initial-hidden-region');
                    regionMain.addClass('initial-right-region-hidden');
                    $("#move-region-right").addClass('hidden-region');
                }else{
                    if(M.theme_archaius_loader.showRegionPre === 0){
                        regionMain.addClass('not-hidden-right');
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
                        animateRegion(
                            regionPost,
                            regionMain,
                            {'left':'+=200px'},
                            {'margin-right' : '-=200px'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-post',0);
                    }else{
                        $this.removeClass("hidden-region");
                        animateRegion(
                            regionPost,
                            regionMain,
                            {'left' : '-=200px'},
                            {'margin-right' : '+=200px'}
                        );
                        M.theme_archaius_loader.setUserPreference('side-post',1);
                    }
                });
            }
        };
        
        //Create collapsible topics effect
        var topicsCourseMenu = function(active){
            //unordered list of topics. 
            var topics = $('ul.topics');  
            //command is the class of editing containers.
            var editing = $('div.commands').length > 0;

            //Verify if we are in the main view of chapters. And
            //check if the effect it need(criteria topics > 2)                                                                                                                              
            if(($("div.summary").length > 2) && (topics.length != 0)
                && active != 0 && !(editing)){

                // course sections.                                                                         
                var sections = topics.find('li.section.main');
                //tab selector the create the topic tabs
                var tabSelector = "h3.sectionname";
                if(topics.find(tabSelector).length != 
                    topics.find("li.section.main").length ){

                    //Create a title for tabs if title is not present
                    sections.each(function(index){
                            $this = $(this);
                            if($this.find("h3.sectionname").length == 0){
                                var alternativeTabHTML = 
                                    "<h3 class='sectionname'> Topic " + 
                                        index  + "</h3>";
                                $this
                                    .find("div.summary")
                                    .prepend(alternativeTabHTML);
                            }

                        });
                }
                var topicTab = topics.find(tabSelector);
                
                //this hide first tab when it doesnt have title
                topicTab
                    .addClass("topic-tab")
                    .removeClass("accesshide"); 

                topicTab.prepend("<span class='triangle'></span>");

                //update the sections variable after prepend the first section.                                                                                                                   
                sections = topics.find('li.section.main');

                //put each tab outside of the topics container.                                                                                                                           
                sections.each(function(){
                    $(this).before($(this).find(tabSelector));
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
            }else if(active == false){
                    //Show all sections it the effect is deactive
                    topics.find('li.section.main').show();
            }else{
                //If there is only one topic, display it.                                                                                                                                         
                $("li.section.main").css("display","block");
            }
        };
        //Effect to expand and shrink question bank
        var expandBank = function(questionBank){
            //If the display if too small, do no attach any
            //event and put question bank after quiz content
            var viewPortWidth = $(window).width();
            if(viewPortWidth <= 768){
                $("#quizcontentsblock")
                    .after($('.questionbankwindow.block'));
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
        var initSlideshow = function(
            activatePausePlay, 
            slideshowTimeout, 
            confirmationDeleteSlide,
            noSlides){

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
                    animate($this.next(), action, { duration: 500 });       
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
                            var index = $(".delete-slide").index($this);
                            var slidesTable = $(".admin-options table"); 
                            if(slidesTable.find("tr").length > 2){
                                $this.closest("tr").remove();
                            }else{
                                slidesTable.remove();
                                $(".admin-options")
                                    .append("<h2>" + noSlides +"</h2>");
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

        var getDistanceToParent = function(item,KingOfParent){
            return item.parents(KingOfParent).length;
        };

        //Function to do some DOM transformations with window is resized
        var checkOnResize = function(){
            var viewPortWidth = $(window).width();
            var mobileCustommenu = $("#mobile-custommenu");
            var pageHeader = $("#page-header");
            if(viewPortWidth <= 768){
                if(mediaQueries == false){
                    $("html").addClass("no-media-queries");
                }
                $("#custommenu").addClass("collapsed");
                if(mobileCustommenu.length == 0 ){
                    var nav = 
                        "<nav id='mobile-custommenu' class='collapsed'></nav>";

                    pageHeader
                        .append(nav); 
                    
                    if($("#custommenu").length > 0){
                        var items = $("#custommenu ul li a");
                        var clonedItems = items.clone();
                        $.each(items,function(index){
                            var $this = $(this);
                            var hierarchyLevel = 
                                getDistanceToParent($this,"div") - 4;
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
                            clonedItems.eq(index)
                                .prepend(hierarchyLine)
                                .removeClass();
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
            if($("#custommenu").length > 0 ){
                $('#custommenu').waypoint('sticky');
            }  
        };
        var accordionBlocks = function(){
            if(regionPre.length != 0){
                    regionPre.archaiusCustomBlocks();
            }
            if(regionPost.length != 0 ){
                regionPost.archaiusCustomBlocks({regionLocation: "post"});
            }
            if($("#report-region-pre").length > 0){   
                $("#report-region-pre").archaiusCustomBlocks();
            }
        };
        var commonBlocks = function(){
            if(regionPre.length != 0){
                regionPre.addClass("no-accordion");
            }
            if(regionPost.length != 0 ){
                regionPost.addClass("no-accordion");
            }
            if($("#report-region-pre").length > 0){   
                $("#report-region-pre").addClass("no-accordion");
            }

        };
        var initEffects = function(){
            organizeRegionCenter(regionCenterPre);
            organizeRegionCenter(regionCenterPost);
            organizeBlockSummary();
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
                hideShowBlocks: hideShowBlocks,
                topicsCourseMenu : topicsCourseMenu,
                initSlideshow :  initSlideshow,
                accordionBlocks : accordionBlocks,
                commonBlocks : commonBlocks,
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

