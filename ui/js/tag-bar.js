$(function(){
	'use strict';

	const bar = document.querySelector('.tag-list');
	const articleBar = document.querySelector('.article-list');


	var tags;
	var articles;

	init();

	function init(){
		$.post('/a/tags/read').then(function(res){
			tags = res;
			tagRender();
		})
		$.post('/a/article/read',{'page':1}).then(function(res){
			articles = res.data;
			articleRender();
		})
	}
	
	function articleRender(){
		for(let item of articles){
			let div = document.createElement('li');
			div.innerHTML = `<a href="/article/info?id=${item.id}">${item.title}</a>`
			div.classList.add("article-bar-item");
			articleBar.appendChild(div);
		}
	}

	function tagRender(){
		for(let item of tags){
			let div = document.createElement('li');
			div.innerHTML = `<a href="#">${item.title} (${tagConut(item.title)})</a>`
			div.classList.add("tag-bar-item");
			bar.appendChild(div);
		}
	}

	function tagConut(tag){
		let conut = 0;
		for(let item of tags){
			if(item['title'] == tag)
				conut++;
		}
		return conut;
	}
})