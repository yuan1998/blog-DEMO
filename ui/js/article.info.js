$(function(){
	'use strict';
	function GetQueryString(name)
	{
	     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	     var r = window.location.search.substr(1).match(reg);
	     if(r!=null)return  unescape(r[2]); return null;
	}
	const id = GetQueryString('id');
	const el_articleInfo = document.querySelector('#articleInfo');

	$.post('/a/article/id_read',{'id':id}).then(function(res){
		if(!res.data[0]||res.data[0].visible == 0)
		{}
	})
	
})