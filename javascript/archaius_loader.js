M.theme_archaius_loader = {
    activateTopicsCourseMenu: 1,
    activateSlideshow: 0,
    activateHideAndShowBlocks: 1 ,

    init: function (
        activateTopicsCourseMenu,
        activateSlideshow,
        activateHideAndShowBlocks) {

       this.activateTopicsCourseMenu = activateTopicsCourseMenu;
       this.activateSlideshow = activateSlideshow;
       this.activateHideAndShowBlocks = activateHideAndShowBlocks;
        Y.one("#adminsearchquery")
            .setAttribute("placeholder", M.str.moodle.search);

        if(this.activateHideAndShowBlocks)
            this.hideShowBlocks();

        if(this.activateSlideshow)
            this.startSlideshow();   

        this.topicsCourseMenu(this.activateTopicsCourseMenu);   
    },
    hideShowBlocks: function(){
        ArchaiusJSEffects.hideShowBlocks();
    },
    topicsCourseMenu: function(active){
        ArchaiusJSEffects.topicsCourseMenu();
    },
    startSlideshow: function(){
        // Load a single JavaScript resource.
        Y.Get.js(
            M.cfg.wwwroot + "/theme/archaius/javascript/archaius_home.js" 
        );
    }
};