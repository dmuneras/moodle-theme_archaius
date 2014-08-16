/*  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

This plugin is part of Archaius theme.
@copyright  2013 onwards Daniel Munera Sanchez

IMPORTANT
----------

This plugin needs jquery.velocity :  http://julian.com/research/velocity/

/* ARCHAIUS CUSTOM BLOCKS
-----------------------------------------------------------------------------*/

! function(window,$,undefined){
    
    $.fn.extend({
        archaiusCustomBlocks:function(options){
            var defaults={
                regionLocation:"pre",
                regionTabClass:"div.header-tab",
                blockContainerClass:".region-content",
                editContainerClass:".commands",
                speed:300
            };
            
            var options=$.extend(defaults,options);

            var getIndex = function(container,selector,object){
                return container.find(selector).index(object);
            }
            
            return this.each(function(){
                var o = options,
                    obj = $(this),
                    $tabsId="tabs-"+o.regionLocation;

                //Styles to add and remove rounded corners
                var cssBordersOn = {
                    "border-radius":"0px 0px 5px 5px",
                    "-moz-border-radius":"0px 0px 5px 5px",
                    "-webkit-border-radius":"0px 0px 5px 5px"
                };

                var cssBordersOff = {
                    "border-radius":"0px",
                    "-moz-border-radius":"0px",
                    "-webkit-border-radius":"0px"
                };
                
                //Add unique identifier to avoid collitions.
                obj.find(o.blockContainerClass).attr("id",$tabsId);

                //Select tabs to be used
                var tabs=$("#"+$tabsId);
                tabs.prepend($(o.regionTabClass+":first",obj));

                //Blocks inside the region
                var blocks = obj.find("div.block",tabs);

                if($(o.regionTabClass,obj).length>1){
                    $(o.regionTabClass,obj).on("click",function(event){
                        var $this= $(this);
                        var action = "slideDown";

                        if(!$this.hasClass("current")){
                            $.each($(o.regionTabClass,obj),function(){
                                var tab = $(this);
                                if(tab.hasClass("current")){
                                    blocks
                                        .eq(getIndex(obj,o.regionTabClass,tab))
                                        .velocity("slideUp",{
                                            duration : o.speed
                                        });
                                    tab.removeClass("current");
                                }
                                                             
                            });
                            $this.addClass("current");
                            blocks
                                .eq(getIndex(obj,o.regionTabClass,$this))
                                .velocity("slideDown",{
                                    duration : o.speed, 
                                    queue : false
                                });
                            
                        }else{
                            action = "slideUp";
                            $this.removeClass("current");
                        }
                        blocks
                                .eq(getIndex(obj,o.regionTabClass,$this))
                                .velocity(action,{duration : o.speed});

                        if($this[0]==obj.find(o.regionTabClass+":last")[0] ){
                            if($this.hasClass("current")){
                                $this.css(cssBordersOff);
                            }else{
                                $this.css(cssBordersOn);
                            }
                        }else{

                            obj
                                .find(o.regionTabClass+":last")
                                .css(cssBordersOn);
                        }
                    });
                    obj.find(o.regionTabClass+":last").css(cssBordersOn);
                }

                //Initial setup of accordion effect
                //Prevent effect
                $(blocks)
                    .css("display","none")
                    .first().css("display","block");
                
                //Select first tab as current.
                obj
                    .find(o.regionTabClass+":first",tabs)
                    .addClass("current");

                if($(o.editContainerClass).length > 0 ){
                    var editContainerSelector= 
                        ".header " + o.editContainerClass;
                        
                    $.map(obj.find(editContainerSelector),function(item,index){
                        obj.find(o.regionTabClass)
                            .eq(index)
                            .after("<div class='com'></div>")
                            .next()
                            .append(item);
                    })
                }
                obj.show()
            });
        }
    });
} (window,jQuery);