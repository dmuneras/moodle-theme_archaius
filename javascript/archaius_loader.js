M.theme_archaius_loader = {
    activateTopicsCourseMenu: 1,
    activateSlideshow: 0,
    activateHideAndShowBlocks: 1 ,
    archaiusJSEffects : ArchaiusJSEffects.getInstance(),
    init: function (trash, params) {
        if(window.console) console.log(params);
        window["params"] = params;
       this.activateSlideshow = params.activateSlideshow;
       this.activateHideAndShowBlocks = params.hideShowBlocks;
       this.activateTopicsCourseMenu = params.collasibleTopics;
        
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