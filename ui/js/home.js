$(function(){
	'use strict';

	const wrap = document.querySelector('#articleWrap');

	init();

	function init(){
		read(1,render);
	}

	function read(page,callback){
		$.post('/a/article/read',{'page':page,'limit':10,'where':{'visible':1}}).then(function(res){
			if(res.success)
				callback(res.data);
		})
	}

	function getTags(aid,callback,el){
		$.post('/a/tags/read',{'where':{'aid':aid}}).then(function(res){
			callback(res,el);
		})
	}

	function TagsRender(data,el){
		let div = document.createElement('div');
		if(!data){
			div.innerText='空';
		}else{
			for(let item of data){
				let span = document.createElement('span');
				span.classList.add('tagItem');
				span.innerText=item.title;
				div.appendChild(span);
			}
		}
		el.appendChild(div);
	}

	function render(data){
		wrap.innerHTML='';
		for(let item of data){
			let div = document.createElement('div');
			div.innerHTML=`
				<h3>${item.title}</h3>
				<div>
					<ul>
						<li>
							<span>作者：</span>
							<span>${item.author}</span>
						</li>
						<li>
							<span>发表于：</span>
							<span>${printTime(item.regtime)}</span>
						</li>
						<li>
							<span>阅读：</span>
							<span>${item.reading}</span>
						</li>
						<li>
							<span>喜欢：</span>
							<span>${item.like}</span>
						</li>
					</ul>
				</div>
				<div>
					<p style="text-indent:1cm;">${item.content}</p>
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
			div.classList.add("article-item");
			let el = div.querySelector('.addTagInput');

			addTagEvent(item.id,el);

			let addTagBtn = div.querySelector('.addTagBtn');
			addTagBtn.addEventListener('click',function(e){
				el.hidden = false;
			})
			let tagBar = div.querySelector('.tagsBar');
			tagBar.classList.add("col");
			getTags(item.id,TagsRender,tagBar);
			wrap.appendChild(div);
		}
	}

	function addTagEvent(aid,el){
		let form = el.querySelector('form');
		form.addEventListener('submit',function(e){
			e.preventDefault();
			let data = getFormData(form);
			data['aid'] = aid;
			$.post('/a/tags/add',data).then(function(res){
				if(!res.success)
					console.log(res.msg);
			})
		});
		el.querySelector('.closeInput').addEventListener('click',function(e){
			el.hidden = true;
		})
	}

	function getFormData(el){
		let arr = el.querySelectorAll('[name]');
		let data = {};
		for(let item of arr){
			data[item.name] = item.value;
		}
		console.log(data);
		return data;
	}

	function printTime(time){
		let min = 60;
		let hour = min*60;
		let day = 24*hour;
		let month = 30*day;
		let year = month *12;

		let now = (new Date().getTime())/1000;
		now = Math.floor(now);
		let diff = now - time;
		let test = {'年前': diff/year,
		'月前': diff/month,
		'天前':diff/day,
		'小时前': diff/hour,
		'分钟前': diff/min};
		

		for(let i in test){
			if(test[i]>=1)
				return Math.floor(test[i]) + i;
		}
	}

})