$(function(){
	const form = document.querySelector('#articleForm');
	const tags = document.querySelector('#tagForm');

	const tagInput = tags.querySelector('#tagInput');
	const tagAddBtn = tags.querySelector('button');


	const tagBar = document.querySelector('.tagList');

	form.addEventListener('submit',function(e){
		e.preventDefault();
		let data = get_form_data(form);
		let tags = get_form_tags();
		$.post('/a/article/add',data).then(function(res){
			if(res.success){
				let data = {};
				for (var i = 0; i <= tags.length-1;i++) {
					data[i]={'title':tags[i],'aid':res.data};
				}
				$.post('/a/tags/multipleAdd',data)
			}

		})
	})

	tagAddBtn.addEventListener('click',function(){
		let li = document.createElement('li');
		li.innerHTML = `${tagInput.value} <span class="delete">X</span>`;
		li.querySelector('.delete').addEventListener('click',function(e){
			e.target.parentNode.remove();
		})
		tagBar.appendChild(li);
	})

	function get_form_tags(){
		let ul = tagBar.querySelectorAll('li');
		let data = [];
		for(let item of ul){
			data.push(item.childNodes[0].nodeValue);
		}
		return data;
	}

	function get_form_data(el){
		let input = el.querySelectorAll('[name]');
		let data = {};
		for(let i of input){
			data[i.name] = i.value;
		}
		return data;
	}
})