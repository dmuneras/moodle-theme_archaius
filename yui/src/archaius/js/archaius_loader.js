M.theme_archaius_loader = M.theme_archaius_loader||{};

M.theme_archaius_loader = {

    activateTopicsCourseMenu: 1,

    activateSlideshow: 0,

    activateHideAndShowBlocks: 1 ,

    archaiusJSEffects : ArchaiusJSEffects.getInstance(),

    init: function (params) {
        this.activateSlideshow = params.activateSlideshow;
        this.activateHideAndShowBlocks = params.activateHideAndShowBlocks;
        this.activateTopicsCourseMenu = params.activateTopicsCourseMenu;
        if(Y.one("#adminsearchquery") !== null){

            Y.one("#adminsearchquery").setAttribute("placeholder",params.search);
        }
        if(parseInt(this.activateHideAndShowBlocks)){
            this.hideShowBlocks();
        }
        if(parseInt(this.activateSlideshow)){
            this.startSlideshow();
        }
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