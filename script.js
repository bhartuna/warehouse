document.addEventListener("DOMContentLoaded", function(){

	showErrors();

});

function showErrors(){
	let error = document.getElementsByClassName('error');
	if(error[0].children[0].textContent != ''){
		error[0].classList.toggle('error--show');
	}
	setTimeout(function(){ hideErrors(); }, 2000);
}

function hideErrors(){
	let error = document.getElementsByClassName('error');
	error[0].classList.toggle('error--show');
}