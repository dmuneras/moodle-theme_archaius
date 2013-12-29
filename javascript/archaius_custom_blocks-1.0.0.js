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

@copyright  2013 Daniel Munera Sanchez

*/
(function(window,$,undefined){
     $.fn.extend({ 
         
         archaiusCustomBlocks: function(options) {
            // regionLocation: used to build the element HTML class.
            // regionTabClass: header of the moodle blocks that is 
            // going to be used as a tab.
            // blockContainerClass: blocks container class.
            // editContainerClass: edit container class where moodle
            // is in edition mode
            var defaults = {
                regionLocation : 'pre',
                regionTabClass: "div.header-tab",
                blockContainerClass: ".region-content",
                editContainerClass: ".commands"
            }
                
            var options =  $.extend(defaults, options);
            return this.each(function() {
                var o = options;
                var obj = $(this);
                //Script to modify the moodle menu, 
                //adding the accodion effect with all tabs on top                                     
                var $tabsId = "tabs-" + o.regionLocation;
                obj.find(o.blockContainerClass).attr('id',$tabsId);
                var tabs = $("#" + $tabsId);
                tabs.prepend($(o.regionTabClass, obj));
                var subcont = obj.find("div.block",tabs);

                $(o.regionTabClass, obj).on('click',
                                 { blocks : subcont } , function(event){
                    var data = event.data;
                    var $this = $(this);
                    if(!($this.hasClass("current"))){
                        obj.find(o.regionTabClass).removeClass("current");
                        $this.addClass("current");
                        var index = obj.find(o.regionTabClass).index($(this)); 
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
                var firstSelector = o.regionTabClass + ':first';
                obj.find(firstSelector,tabs).addClass("current");

                if($(o.editContainerClass).length > 0){
                    var editContainerSelector = ".header " + o.editContainerClass;
                    $.map(obj.find(editContainerSelector) , function(item , index){
                        obj.find(o.regionTabClass).eq(index)
                            .after("<div class='com'></div>")
                            .next().append(item);
                    });
                }
                obj.show();
            
            });
        }
    });
    
})(this,jQuery);