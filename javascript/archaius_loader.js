M.theme_archaius_loader = {
    activateTopicsCourseMenu: 1,
    activateSlideshow: 0,
    activateHideAndShowBlocks: 1 ,
    archaius : ArchaiusJSEffects.getInstance(),
    init: function (
        activateTopicsCourseMenu,
        activateSlideshow,
        activateHideAndShowBlocks) {

       this.activateTopicsCourseMenu = activateTopicsCourseMenu;
       this.activateSlideshow = activateSlideshow;
       this.activateHideAndShowBlocks = activateHideAndShowBlocks;
       this.archaiusJSEffects = ArchaiusJSEffects.getInstance();
        
        if(Y.one("#adminsearchquery") != undefined )
            Y.one("#adminsearchquery")
                .setAttribute("placeholder", M.str.moodle.search);
        if(this.activateHideAndShowBlocks)
            this.hideShowBlocks();

        if(this.activateSlideshow)
            this.startSlideshow();   

        this.topicsCourseMenu(this.activateTopicsCourseMenu);   
    },

    hideShowBlocks: function(){
        this.archaiusJSEffects.hideShowBlocks();
    },
    topicsCourseMenu: function(active){
       this.archaiusJSEffects.topicsCourseMenu(active); 
    },
    startSlideshow: function(){
        // Load a single JavaScript resource.
        Y.Get.js(
            M.cfg.wwwroot + "/theme/archaius/javascript/archaius_home.js" 
        );
    }
};