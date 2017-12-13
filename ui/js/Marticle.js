$(function(){
	'use strict';

	const wrap = document.querySelector('#articleWrap');

	init();

	function init(){
		read(1,render);
	}

	function read(page,callback){
		$.post('/a/article/read',{'page':page,'limit':10}).then(function(res){
			if(res.success)
				callback(res.data);
		})
	}

	function getTags(aid,callback,el){
		$.post('/a/tags/read',{'where':{'aid':aid}}).then(function(res){
			callback(res,el);
		})
	}

	function render(data){
		wrap.innerHTML='';
		for(let item of data){
			let div = document.createElement('div');
			div.innerHTML=`
				<h3>${item.title}</h3>
				<div><span>标题:</span><input type="text" name="title" value="${item.title}"/></div>
				<div>
					<ul>
						<li>
							<span>作者：</span>
							<input type="text" name="author" value="${item.author}"/>
						</li>
						<li>
							<span>发表于：</span>
							<span>${printTime(item.regtime)}</span>
						</li>
						<li>
							<span>阅读：</span>
							<input type="text" name="reading" value="${item.reading}"/>
						</li>
						<li>
							<span>喜欢：</span>
							<span>${item.like}</span>
							<input type="text" name="like" value="${item.like}"/>
						</li>
					</ul>
				</div>
				<div>
					<p style="text-indent:1cm;">${item.content}</p>
					<input type="text" name="content" value="${item.content}"/>
				</div>
				<div class="articleTags">
					<span>Tag：</span>
					<span class="tagsBar"></span>
					<span class="addTagBtn" style="border:1px solid black;">+</span>
					<span class="addTagInput" hidden>
						<span class="closeInput" style="border:1px solid black;">X</span>
						<form class="tagForm">
							<input type="text" name="title"/>
							<button type="submit">提交</button>
						</form>
					</span>
				</div>
			`;
			let el = div.querySelector('.addTagInput');

			addTagEvent(item.id,el);

			let addTagBtn = div.querySelector('.addTagBtn');
			addTagBtn.addEventListener('click',function(e){
				el.hidden = false;
			})
			let tagBar = div.querySelector('.tagsBar');
			getTags(item.id,TagsRender,tagBar);
			wrap.appendChild(div);
		}
	}
})