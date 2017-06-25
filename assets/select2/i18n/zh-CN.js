/*! Select2 4.0.3 | https://github.com/select2/select2/blob/master/LICENSE.md */

(function() {
	if(jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) var e = jQuery.fn.select2.amd;
	if(typeof simplePinyin != 'function')return console.log('缺少拼音插件库:simple-pinyin-master.js');
    $.extend(jQuery.fn.select2.defaults.defaults, {
        matcher:function(params,data) {
			var mod,inFull=false,inShort=false;
		    // 子查询的直接返回
		    if (typeof params.term == 'undefined') {
		        return data;
		    }
		    else{
		    	if(typeof data.text == 'undefined' || data.text == '')return data;
		    	mod = simplePinyin(data.text);
		    	var term = simplePinyin(params.term);
		    	term = term.short.toUpperCase();
		    	term = term.split('-');
		    	//拆开，支持空格 模糊搜索
		    	if(term.length >1){
		    		inFull1 = mod.full.toUpperCase().indexOf(term[0].toUpperCase()) != -1;
		    		inFull2 = mod.full.toUpperCase().indexOf(term[1].toUpperCase()) != -1;
	           		inShort1 = mod.short.toUpperCase().indexOf(term[0].toUpperCase()) != -1;
	           		inShort2 = mod.short.toUpperCase().indexOf(term[1].toUpperCase()) != -1;
	           		
					if(inFull1 || inShort1 || inFull2 || inShort2) {
				        return data;
				    }
		    	}
		    	
		    	inFull = mod.full.toUpperCase().indexOf(term[0].toUpperCase()) != -1;
           		inShort = mod.short.toUpperCase().indexOf(term[0].toUpperCase()) != -1;
				if(inFull || inShort) {
			        return data;
			    }
		    	return null;
		    }
		}
    });

	return e.define("select2/i18n/zh-CN", [], function() {
		return {
			errorLoading: function() {
				return "无法载入结果。"
			},
			inputTooLong: function(e) {
				var t = e.input.length - e.maximum,
					n = "请删除" + t + "个字符";
				return n
			},
			inputTooShort: function(e) {
				var t = e.minimum - e.input.length,
					n = "请再输入至少" + t + "个字符";
				return n
			},
			loadingMore: function() {
				return "载入更多结果…"
			},
			maximumSelected: function(e) {
				var t = "最多只能选择" + e.maximum + "个项目";
				return t
			},
			noResults: function() {
				return "没可选项."
			},
			searching: function() {
				return "搜索中…"
			}
		}
	}), {
		define: e.define,
		require: e.require
	}

})();