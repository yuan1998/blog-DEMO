$(function(){
	'use strict';
	function GetQueryString(name)
	{
	     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	     var r = window.location.search.substr(1).match(reg);
	     if(r!=null)return  unescape(r[2]); return null;
	}
	const id = GetQueryString('id');
	const el_content = document.querySelector('#articleContent');

	var article;
	init();

	function init(){
		$.post('/a/article/id_read',{'id':id}).then(function(res){
			if(!res.success)
				throw(alert(res.msg));
			article = res.data[0];
			render();
		})	
	}

	function render(){
		console.log(article);
		el_content.innerHTML = `
			
			<div class="articleNav">
				<div class="articleTitle center">
					<h1>${article.title}</h1>
				</div>
				<ul >
					<li class="nav-item authorName">POSTED BY ${article.author} • </li>
					<li class="nav-item createTime">${new Date(article.regtime*1000).toLocaleString('ko-KR')} • </li>
				</ul>
			</div>
			<div>
				<ul class="tagList">
				<li class="">Tags:</li>
				</ul>
			</div>
			<div class="contentWrap">
				<p class="content">${article.content}</p>
			</div>
		`;
		let tagList = el_content.querySelector('.tagList');
		tagRender(tagList);
	}

	function tagRender(el){
		if(!article.tags.length ==0){
			for(let item of article.tags){
				let li = document.createElement('li');
				li.innerText = item.title;
				li.classList.add('tag-item');
				el.appendChild(li);
			}
		}else{
			let li = document.createElement('li');
			li.innerText = "It Ain't Me";
			li.classList.add('tag-item');
			el.appendChild(li);
		}
	}

})