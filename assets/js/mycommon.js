/*
tableid：主表格的ID
obj：被点的<span>对象
trid：被点中的行
每行需要如下几个属性：
1、parentId，父节点的ID，如果自己是父节点，则不需要该树形
2、status，所点中行的状态：open和close状态
*/
function viewmytab(tableid,obj,trid){
	//alert('1');
	var mytable = document.getElementById(tableid);
	var myTbody = mytable.children[0];
	var j = 0;
	while(myTbody.tagName!='TBODY'){
		j++;
		myTbody = mytable.children[j];
	}
	var myTrList = myTbody.children;
	
	var myTr = null;
	if(trid==null){
		myTr = document.getElementById(trid);
	}else{
		myTr = obj.parentNode.parentNode;
		trid = myTr.id;
	}
	var Tr = document.getElementById(trid);
	var trChildId = Tr.getAttribute("childId");
	var status = myTr.getAttribute("status");
	if(status=="close"){  //加入现在是关闭的，则打开它。
		openMytab(myTrList,obj,trChildId);
		document.getElementById(trid).setAttribute("status","open");
	}else{
		closeMytabb(myTrList,obj,trChildId);
		document.getElementById(trid).setAttribute("status","close");	
	}
}

function openMytab(myTrList,obj,trChildId){
	
	for(var i=0; i<myTrList.length; i++){
		var tr = myTrList[i];
		//alert(tr.getAttribute("parentId")+' '+trChildId);
		if(tr.getAttribute("parentId")==trChildId){
			tr.style.display="";
		}
	}
	//obj.innerText = "-";
	obj.src="/assets/images/f_open.gif";
}

function closeMytabb(myTrList,obj,trChildId){
	//alert( myTrList.length);
	for(var i=0; i<myTrList.length; i++){
		var tr = myTrList[i];
		if(tr.getAttribute("parentId")==trChildId){
			tr.style.display="none";
		}
	}
	//obj.innerText = "+";
	obj.src="/assets/images/f_close.gif";
}