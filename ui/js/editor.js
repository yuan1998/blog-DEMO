$(function(){
	const form = document.querySelector('#articleForm');

	form.addEventListener('submit',function(e){
		e.preventDefault();
		let data = get_form_data(form);
		$.post('/a/article/add',data).then(function(res){
			console.log(res);
		})
	})


	function get_form_data(el){
		let input = el.querySelectorAll('[name]');
		let data = {};
		for(let i of input){
			data[i.name] = i.value;
		}
		return data;
	}
})