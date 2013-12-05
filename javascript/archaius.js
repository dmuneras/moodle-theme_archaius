/* --------------------------------------------------------------                             
   Effects that can be added in the footer      
   Adding accordion effect to blocks moodle.
-------------------------------------------------------------- */
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

/* --------------------------------------------------------------                             
   Definition of functions
----------------------------------------------------------------*/

//Script to modify the moodle menu, adding the accodion effect with all tabs on top                                     
function customizeMenu(region,regionLocation){
    var $tabsId = "tabs-" + regionLocation;
    region.find('.region-content').attr('id',$tabsId);
    var tabs = $("#" + $tabsId);
    tabs.prepend($('div.header-tab', region));
    var subcont = region.find("div.block",tabs);

    $(".header-tab", region).on('click',
                     { blocks : subcont } , function(event){
        var data = event.data;
        var $this = $(this);
        if(!($this.hasClass("current"))){
            region.find(".header-tab").removeClass("current");
            $this.addClass("current");
            var index = region.find("div.header-tab").index($(this)); 
            data.blocks
                .slideUp()
                .eq(index).slideDown();
        }
    });


    //Avoid first efect when the page is loaded                                                                                                                
    $(subcont)
        .css("display","none")
        .first().css("display","block");

    //add Rounded borders to the first tab and set as current
    region.find('div.header-tab:first',tabs)
        .css({
            '-moz-border-radius':'5px 5px 0px 0px',
                'border-radius':'5px 5px 0px 0px'
        })
        .addClass("current");

    if($('.commands').length > 0){
        $.map(region.find(".header .commands") , function(item , index){
        region.find(".header-tab").eq(index).after("<div class='com'></div>");
        region.find(".header-tab").eq(index).next().append(item);
        });
    }
    region.show();
}
//Function to expand and shrink the question bank div.   
function expandBank(questionBank){
    questionBank.find('.header').first().find(".title")
    .append("<a id = 'expand-bank' class='shrink btn-warning btn pretty-link-button'>expand</input>");
    var page = $('#page-mod-quiz-edit div.quizcontents');
    $('#expand-bank').on("click",function(){
            var $this = $(this);
            if($this.hasClass("shrink")){
                questionBank.animate({
                        'width' : '50%'
                },300,null);
                page.animate({
                        'width' : '50%'
                            },300,null);

                $this.removeClass("shrink");
                $this.html("shrink");

            }else{
                questionBank.animate({
                        'width' : '30%'
                },300,null);
                page.animate({
                        'width' : '70%'
                            },300,null);
                $this.addClass("shrink");
                $this.html("expand");
            }
        });
}
function organizeBlockSummary(){
    var blockSummary = $('#inst2');
    if(blockSummary.prev(".header-tab").length == 0){
        var header = $('#region-post .header-tab:first');
        var clon = header.clone();
        clon.find("h2").html("");
        blockSummary.before(clon);
    }
}

function organizeRegionCenter(region){
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
}
/* --------------------------------------------------------------                             
   DOM is ready to execute everything
   The script is in the footer but is just to be sure
--------------------------------------------------------------*/

$(function(){

        var regionPre = $('#region-pre');
        var regionPost = $('#region-post');
        var regionCenterPre = $('#region-center-pre');
        var regionCenterPost = $('#region-center-post');        

       //Move options to edit blocks to the header tab
       organizeRegionCenter(regionCenterPre);
       organizeRegionCenter(regionCenterPost);


        organizeBlockSummary();
        if(regionPre.length != 0){
            customizeMenu(regionPre,"pre");
        }
        if(regionPost.length != 0 ){
            customizeMenu(regionPost,"post");
        }

        var questionBank = $(".questionbankwindow.block");
        if(questionBank.length > 0 && !(questionBank.hasClass("collapsed"))){
            expandBank($(".questionbankwindow.block"));
        }
        $('#page-header').prepend($('div.footer form.adminsearchform')); //add search form to the header page               
        $("#page-header form.adminsearchform input:regex(type,submit)").remove(); //remove search button                                                                                      
        $("#adminsearchquery").attr("placeholder",searchTranslation); //add placeholder to search input                                                   
        $('#region-post-box').prepend($('.blogsearchform'));

    /* --------------------------------------------------------------                               
      COURSE 
      To modify the course content view and add the collapsible                                                                                              
      list effect.                                                                                                                                             
    ----------------------------------------------------------------*/

    var topics = $('ul.topics'); //unordered list of topics.  
    var editing = $('div.commands').length > 0;            
    //Verify if we are in the man view of chapters.                                                                                                                               
    if(($("div.summary").length > 2) && (topics.length != 0)
       && (activateTopicsCourseMenu == true) && !(editing)){

        // course sections.                                                                         
        var sections = topics.find('li.section.main');
        var tabSelector = "h3.sectionname";
        if(topics.find(tabSelector).length != topics.find("li.section.main").length ){
            sections.each(function(index){
                    $this = $(this);
                    if($this.find("h3.sectionname").length == 0){
                        $this.find("div.summary").prepend(
                            "<h3 class='sectionname'> Topic " + index  + "</h3>");
                    }

                });
        }
        var topicTab = topics.find(tabSelector);
        topicTab.addClass("topic-tab");
        topicTab.prepend("<span class='triangle'></span>");
        //update the sections variable after prepend the first section.                                                                                                                   
        sections = topics.find('li.section.main');
        //put each summary as a tab (outside of the container).                                                                                                                           
        sections.each(function(){$(this).before($(this).find(tabSelector))});
        topicTab.bind("click", function(){
                var content = $(this).next();
                if($(this).hasClass("current")){
                    $(this).removeClass("current");
                    content.slideUp();
                } else {
                    $(this).addClass("current");
                    content.slideDown();
                }
            });
    }else if(activateTopicsCourseMenu == false){
            topics.find('li.section.main').show();
        }else{
            //If there is only one topic, display it.                                                                                                                                         
            $("li:regex(id,section)").css("display","block");
        }

    /* --------------------------------------------------------------                             
       event to show and hide blocks
    ----------------------------------------------------------------*/                             

    //Adding functionality to hide and show blocks
    if(activateHideAndShowBlocks == true){
         /*
            The left and margin is not the same in all mooodle modules,
            Thats way I have to use '-=' and '+=' to move the regions.
        */
        var regionMain = $("#region-main");
        if(regionPre.length > 0){
            var widthRegion = regionPre.css("width");
            $("#regions-control").append("<div id='move-region' class='move'></div>");
            $("#move-region").on("click", { region : regionPre 
                , wRegion : widthRegion , main : regionMain },function(event){
                var data = event.data;
                if(!($(this).hasClass("hidden-region"))){
                    $("#move-region").addClass("hidden-region");
                    data.region.animate({
                        'left' : '-=' + data.wRegion
                            },400,null);
                    data.main.animate({
                        'margin-left' : "-=" + data.wRegion
                            },400,null);
                }else{
                    $("#move-region").removeClass("hidden-region");
                    data.region.animate({
                        'left' : "+=" +  data.wRegion
                            },400, null);
                    data.main.animate({
                        'margin-left' : "+=" + data.wRegion
                            },400,null);
                    }
            });
        }
        if(regionPost.length > 0){
            var widthRegion = regionPost.css("width");
            $("#regions-control").append("<div id='move-region-right' class='move'></div>");
            $("#move-region-right").on("click",{ region : regionPost 
                , wRegion : widthRegion , main : regionMain },function(event){
                var data = event.data;
                if(!($(this).hasClass("hidden-region"))){
                    $("#move-region-right").addClass("hidden-region");  
                    data.region.animate({
                        'left' : '+=' + data.wRegion
                            },400,null);
                    data.main.animate({
                        'margin-right' : "-=" + data.wRegion
                            },400,null);
                }else{
                    $("#move-region-right").removeClass("hidden-region");
                    data.region.animate({
                        'left' : "-=" + data.wRegion
                            },400,null);
                    data.main.animate({
                        'margin-right' : "+=" + data.wRegion
                            },400,null);
                    }
            });
        }
    } 
});