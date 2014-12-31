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
@copyright  2014 Daniel Munera Sanchez

*/

/* ARCHAIUS LOADER
-----------------------------------------------------------------------------*/

M.theme_archaius_loader = M.theme_archaius_loader||{};

M.theme_archaius_loader = {

    activateAccordionBlocks:1,

    activateTopicsCourseMenu: 1,

    activateSlideshow: 0,

    activateHideAndShowBlocks: 1 ,

    activatePausePlaySlideshow: 0,

    archaiusJSEffects : ArchaiusJSEffects.getInstance(),

    slideshowTimeout : 4000,

    pageType: "",

    subpage: undefined,

    contextId: 0,

    showRegionPre:1,

    showRegionPost:1,

    init: function (params) {

        this.activateAccordionBlocks =  parseInt(params.accordionBlocks,10);

        this.activateSlideshow = parseInt(params.activateSlideshow,10);

        this.activateHideAndShowBlocks = parseInt(params.activateHideAndShowBlocks,10);

        this.activateTopicsCourseMenu = parseInt(params.activateTopicsCourseMenu,10);

        this.activatePausePlaySlideshow = parseInt(params.activatePausePlaySlideshow,10);

        this.slideshowTimeout = parseInt(params.slideshowTimeout,10);

        this.confirmationDeleteSlide = params.confirmationDeleteSlide;

        this.noSlides = params.noSlides;

        this.contextId = params.contextId;

        this.pageType = params.pageType;

        if(params.subpage !== ""){
            this.subpage = params.subpage;
        }

        this.showRegionPre = parseInt(params.showRegionPre,10);

        this.showRegionPost = parseInt(params.showRegionPost,10);

        if(this.activateAccordionBlocks){
            this.accordionBlocks();
        }else{
            this.commonBlocks();
        }

        if(this.activateHideAndShowBlocks){
            this.hideShowBlocks();
        }
        if(this.activateSlideshow){
            this.startSlideshow(
                this.activatePausePlaySlideshow,
                this.slideshowTimeout,
                this.confirmationDeleteSlide,
                this.noSlides
            );
        }
        this.topicsCourseMenu(this.activateTopicsCourseMenu);
    },
    commonBlocks: function(){
        this.archaiusJSEffects.commonBlocks();
    },
    accordionBlocks: function(){
        this.archaiusJSEffects.accordionBlocks();
    },
    hideShowBlocks: function(){
        this.archaiusJSEffects.hideShowBlocks();
    },
    topicsCourseMenu: function(active){
       this.archaiusJSEffects.topicsCourseMenu(active);
    },
    startSlideshow: function(activatePausePlaySlideshow,timeout,confirmationDeleteSlide,noSlides){
        this.archaiusJSEffects
            .initSlideshow(
                activatePausePlaySlideshow,
                timeout,
                confirmationDeleteSlide,
                noSlides
            );
    },
    getUserPreferenceName: function(region){
        var userPreference = "theme_archaius_blocks_region_" + region + "_context_" 
            + this.contextId + "_page_type_" + this.pageType;
        if(this.subpage !== undefined){
            userPreference += "_sub_" + this.subpage;
        }
        return userPreference;
    },
    setUserPreference: function(region,value){
        var preferenceName = this.getUserPreferenceName(region);
        M.util.set_user_preference(preferenceName, value);
    }
};