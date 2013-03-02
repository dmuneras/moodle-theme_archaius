    if($("#custommenu .custom_menu_submenu").length > 0 ){
    	$("#custommenu .custom_menu_submenu").each(function(){
    		$this = $(this);
    		if($this.parents().length == 8 ){
    			$this.prepend("<div class='arrow-up'></div>");

    		}else{
    			$this.prepend("<div class='arrow-right'></div>");
    			$(".custom_menu_submenu .yui3-menu-content li").each(function(){
    				var item = $(this);
    				//alert(item.find("div.custom_menu_submenu").length);
    				if(item.find("div.custom_menu_submenu").length > 0){
    					item.on("hover",function(){
    						$(this).find("div.custom_menu_submenu .yui3-menu-content").css({
    							"position" : "absolute" ,
    							"left" : "8px" ,
    							"margin-top" : (parseInt($(this).css("height") + 20) * (-1)) + "px"
    						});

    					});
    				}
    			});
    		}
    	});
    }
