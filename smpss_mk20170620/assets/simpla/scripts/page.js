var rowids = new Array();
function getListByAjax(a){
	var param = {
		main : a.main || '',
		url : a.url || '',
		page : a.page || 1,
		keyid : a.keyid || 'key',
		callback : a.callback || 'getListCallback',
		listbar : a.listbar || $('#listbar'),
		listlock : a.listlock || $('#listbar-lock'),
		pagebar : a.pagebar || $('#pagebar'),
		colcount : a.colcount || 5,
		ischeck : a.ischeck || false
	}
	
	var defaulthtm = '<tr class="alt-row"><td colspan="'+param.colcount+'" style="text-align:center;">暂无数据</td></tr>';
	var keyword = $("#"+param.keyid).val();
	var mold = $("#mold").val()||0;
	var changehtm = "";
	if(param.ischeck){
		changehtm = ' onchange="docheck(this,\''+param.listbar.attr("id")+'\',\''+param.listlock.attr("id")+'\','+param.ischeck+')"';	
	}
	$.post(param.url,{
		page : param.page,
		key : keyword,mold:mold,
		ajax : 1
	},function(res){
		if(res.data != null){
			var list = res.data.dataList;
			
			var htm = "";
			if(list != null && typeof(list) != "undefined"){
				var callbackfnc = eval(param.callback);	
				
				for(var i=0;i<list.length;i++){
					var rcl = (i%2 == 0) ? "alt-row" : "";
					var row = list[i];
					htm = htm + '<tr class="'+rcl+'">';
					htm = htm + callbackfnc.apply(this,[row,param.ischeck,changehtm]);
					htm = htm + "</tr>";
				}
			}else{
				htm = defaulthtm;	
			}
			
			param.listbar.html(htm);
			setPageBar(res.data.pageBar,param.pagebar,param.main);
		}
	},'json');	
}

function setPageBar(bar,obj,fn){
	var total = bar.totalSize;
	var page = bar.pageSize;
	var cur = bar.curPage;
	var totalpage = Math.ceil(total/page);
	
	var barhtm = '<div class="pagination"><button type="button" onclick="gotoPage(\''+fn+'\',1)">首页</button>';
	if(cur <= 1){
		barhtm += '<button type="button">上一页</button>';
	}else{
		barhtm += '<button type="button" onclick="gotoPage(\''+fn+'\','+(cur-1)+')">上一页</button>';	
	}
	for(var i=1;i<=totalpage;i++){
		var curclass = '';
		if(i == cur){
			curclass = 'current';	
		}
		barhtm += '<button type="button" class="number '+curclass+'" onclick="gotoPage(\''+fn+'\','+i+')">'+i+'</button>';
	}
	if(total == 0){
		barhtm += '<button type="button" class="number current">'+i+'</button>';
	}
	
	if(cur>=totalpage){
		barhtm += '<button type="button">下一页</button>';
	}else{
		barhtm += '<button type="button" onclick="gotoPage(\''+fn+'\','+(cur+1)+')">下一页</button>';						
	}
	
	barhtm += '<button type="button" onclick="gotoPage(\''+fn+'\','+totalpage+')">尾页</button></div>';		
	
	obj.html(barhtm);
}

function docheck(obj,listbar,listlock,ischeck){
	if(ischeck){
		if(obj.checked){
			rowids.push(obj.value);
			$("#"+listlock).append($(obj).parent().parent());
		}else{
			rowids.remove(obj.value);
			$("#"+listbar).append($(obj).parent().parent());	
		}
	}
}

function gotoPage(fn,page){
	var func = eval(fn);
	func.apply(this,[page]);
}

Array.prototype.remove = function(val) {
	var index = this.indexOf(val);
	if (index > -1) {
		this.splice(index, 1);
	}
};