var searchList = function(){
	
	var initlist = function(obj,options){
		obj.find(".mws-search-box").focus(function(){
			obj.find(".mws-search-box").val("");
			$(this).parent().find(".mws-search-list").show();
		});
		obj.find(".mws-search-box").blur(function(){
			setTimeout(function(){
				var cval = obj.find(".mws-search-val").val();
				obj.find(".mws-search-box").val(obj.find(".mws-search-list li[data='"+cval+"']").html());
				obj.find(".mws-search-list li").show();
				obj.find(".mws-search-list").hide();
			}, 200);			
		});
		obj.find(".mws-search-box").bind('input propertychange', function() {
			var obj = $(this);
			var list = obj.parent().find(".mws-search-list li");
			var cur = obj.val();
			
			obj.parent().find(".mws-search-list li").each(function(){
				if(!cur || cur ==''){
					$(this).show();
				}else if($(this).html().indexOf(cur) <= -1){
					$(this).hide();
				}else{
					$(this).show();
				}
			});			
		});
		
		obj.find(".mws-search-btn").bind('click propertychange', function() {
			var obj = $(this).parent().find(".mws-search-box").focus();
		});
		
		obj.find(".mws-search-list li").bind('click propertychange',function(){
			$(this).addClass("on").siblings().removeClass("on");
			$(this).parent().parent().find(".mws-search-box").val($(this).html());
			$(this).parent().parent().find(".mws-search-val").val($(this).attr("data"));
			$(this).parent().hide();
			$(this).parent().find("li").show();
			if(options.fnc){
				options.callback();
			}
		});
	}
	return {
		init : function(options){
			var obj = options.obj;
			initlist(obj,options);
			
			obj.find(".mws-search-box").val(obj.find(".mws-search-list li").eq(0).html());
			obj.find(".mws-search-val").val(obj.find(".mws-search-list li").eq(0).attr('data'));
		}		
	}
}();