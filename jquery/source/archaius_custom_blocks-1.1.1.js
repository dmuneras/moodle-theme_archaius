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
@copyright  2013 Daniel Munera Sanchez

IMPORTANT
----------

This plugin needs jquery.velocity :  http://julian.com/research/velocity/

*/
! function(window,$,undefined){
    
    $.fn.extend({
        archaiusCustomBlocks:function(options){
            var defaults={
                regionLocation:"pre",
                regionTabClass:"div.header-tab",
                blockContainerClass:".region-content",
                editContainerClass:".commands"
            };
            var options=$.extend(defaults,options);
            return this.each(function(){
                var o=options;
                var obj=$(this);
                var $tabsId="tabs-"+o.regionLocation;

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
                obj.find(o.blockContainerClass).attr("id",$tabsId);
                var tabs=$("#"+$tabsId);tabs.prepend($(o.regionTabClass+":first",obj));
                var subcont=obj.find("div.block",tabs);
                if($(o.regionTabClass,obj).length>1){
                    $(o.regionTabClass,obj).on("click",{blocks:subcont},function(event){
                        var data=event.data;
                        var $this=$(this);
                        if(!$this.hasClass("current")){
                            obj.find(o.regionTabClass).removeClass("current");
                            $this.addClass("current");
                            var index=obj.find(o.regionTabClass).index($(this));
                            //data.blocks.slideUp().eq(index).slideDown();
                            data.blocks.velocity("slideUp",{duration : 700});
                            data.blocks.eq(index).velocity("slideDown",{duration : 700});
                            
                        }else{
                            var index=obj.find(o.regionTabClass).index($this);
                            $this.removeClass("current");
                            //data.blocks.eq(index).slideUp(); 
                            data.blocks.velocity("slideUp",{duration : 700});
                        }
                        if($this[0]==obj.find(o.regionTabClass+":last")[0] ){
                            if($this.hasClass("current")){
                                $this.css(cssBordersOff);
                            }else{
                                $this.css(cssBordersOn);
                            }
                        }else{
                            obj.find(o.regionTabClass+":last").css(cssBordersOn);
                        }
                    });
                    obj.find(o.regionTabClass+":last").css(cssBordersOn);
                }
                $(subcont).css("display","none").first().css("display","block");
                var firstSelector=o.regionTabClass+":first";
                obj.find(firstSelector,tabs).addClass("current");
                if($(o.editContainerClass).length>0){
                    var editContainerSelector=".header "+o.editContainerClass;
                    $.map(obj.find(editContainerSelector),function(item,index){
                        obj.find(o.regionTabClass)
                            .eq(index)
                            .after("<div class='com'></div>")
                            .next().append(item);
                    })
                }
                obj.show()
            });
        }
    });
} (window,jQuery);