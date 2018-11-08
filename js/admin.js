function m_over(obj){
	if(obj.className=="s_out"){
		obj.className="s_over";
	}
}

function m_out(obj){
	if(obj.className=="s_over"){
		obj.className="s_out";
	}
}
function c_chang(obj){
	var e=obj.parentNode.parentNode;
	if(e.className=="s_over"){
		e.className="s_click";
	}else{
		e.className="s_over";
	}
}
function CheckAll(form){
	for (var i=0;i<form.elements.length;i++){
		var e = form.elements[i];
		if (e.name != 'chkall'){
			e.checked = form.chkall.checked;
		}
		if(e.type == 'checkbox' && e.name != 'chkall' && e.name != 'chkall_box2'){
			var obj = e.parentNode.parentNode;
			e.checked ? obj.className="s_click" : obj.className="s_out";
		}
	}
}
function getSelect(form){
	var ids='';
	for (var i=0;i<form.elements.length;i++) {
		var e = form.elements[i];
		if(e.type == 'checkbox' && e.name != 'chkall' && e.name != 'chkall_box2'){
			if(e.checked) ids += e.value + ',';
		}
	}
	return ids.replace(/,$/mg, "");;
}
function get(id) {
	return document.getElementById(id);
}
function show(id) {
	get(id).style.display = 'block';
}
function hide(id) {
	get(id).style.display = 'none';
}
function heightAdd(name) {
	style = get(name + '___Frame').style;
	height = parseInt(style.height);
	style.height = height + 100;
}
function heightSub(name) {
	style = get(name + '___Frame').style;
	height = parseInt(style.height);
	if (height > 100) style.height = height - 100;
}
function getContent(name) {
	return FCKeditorAPI.GetInstance(name).GetXHTML(true);
}
function getEditor(name) {
	return FCKeditorAPI.GetInstance(name);
}
function allPrpos(obj) { // 用来保存所有的属性名称和值
	var props = ""; // 开始遍历
	for (var p in obj) { // 方法
		if (typeof(obj[p]) == "function") {
			obj[p]();
		} else { // p 为属性名称，obj[p]为对应属性的值
			props += p + "=" + obj[p] + "\t";
		}
	} // 最后显示所有的属性
	return props;
}
function child(obj) {
	obj = obj.parentNode.parentNode;
	var tbl = document.getElementById("listtable");
	var lvl = parseInt(obj.lang);
	var fnd = false;
	for (i = 0; i < tbl.rows.length; i++) {
		var row = tbl.rows[i];
		if (tbl.rows[i] == obj) {
			fnd = true;
		} else {
			if (fnd == true) {
				var cur = parseInt(row.lang);
				if (cur > lvl) {
					row.style.display = (row.style.display != 'none') ? 'none': '';
				} else {
					fnd = false;
					break;
				}
			}
		}
	}
}
function ResumeError() {
	return true;
}
window.onerror = ResumeError;
function onloadEvent(func) {
	var one = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() {
			one();
			func();
		}
	}
}

function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}
