/* --------------------------------------------------------------                                                                                                                                                                                    
   Effects that can be added in the footer      
-------------------------------------------------------------- */

//Add arrow to custom sub menu and binding event 
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

//Adding functionality to hide and show blocks
if($("#region-pre").length > 0 ){
    $("#page").prepend("<div id='move-region' width= " +
		       $("#region-pre").css("width") + "></div>");
    $("#move-region").on("click",function(){
	    if(!($(this).hasClass("hidden-region"))){
		$("#move-region").addClass("hidden-region");
		$("#region-pre").animate({
			'left' : '-=' + $("#move-region").attr("width")
			    },400,null);
		$("#region-main").animate({
			'margin-left' : "-=" + $("#move-region").attr("width")
			    },400,null);
	    }else{
		$("#move-region").removeClass("hidden-region");
		$("#region-pre").animate({
			'left' : "+=" +  $("#move-region").attr("width")
			    },400, null);
		$("#region-main").animate({
			'margin-left' : "+=" + $("#move-region").attr("width")
			    },400,null);
	    }
	});
}
if($("#region-post").length > 0){
    $("#page").prepend("<div id='move-region-right' width=" +
		       $("#region-post").css("width") + "></div>");
    $("#move-region-right").on("click",function(){
	    if(!($(this).hasClass("hidden-region"))){
		$("#move-region-right").addClass("hidden-region");  
		$("#region-post").animate({
			'left' : '+=' + $("#move-region").attr("width")
			    },400,null);
		$("#region-main").animate({
			'margin-right' : "-=" + $("#move-region-right").attr("width")
			    },400,null);
	    }else{
		$("#move-region-right").removeClass("hidden-region");
		$("#region-post").animate({
			'left' : "-=" + $("#move-region-right").attr("width")
			    },400,null);
		$("#region-main").animate({
			'margin-right' : "+=" + $("#move-region-right").attr("width")
			    },400,null);
	    }
	    
	});
}