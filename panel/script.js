document.addEventListener("DOMContentLoaded", function(){

	let cancelDelete = document.getElementsByClassName('cancelDelete');
	let category__delete = document.getElementsByClassName('category__delete');
	let deleteCategory = document.getElementsByClassName('deleteCategory');
	let deleteBox = document.getElementsByClassName('deleteBox');

	for(let i = 0; i < category__delete.length; i++){
		category__delete[i].addEventListener('click', function(){
			let categoryName = this.parentElement.children[0].children[0].textContent.replace(/\s\([0-9]*\)/, '');
			deleteBox[0].children[0].textContent = 'Czy na pewno usunąć ' + categoryName + '?';
			deleteBox[0].style.top = this.parentElement.offsetTop - 10 + 'px';
			deleteBox[0].style.left = this.parentElement.offsetLeft + 840 + 'px';
			deleteBox[0].classList.add('showDeleteBox');
			deleteCategory[0].parentElement.setAttribute('href', 'panel/functions/category-delete.php/?name=' + categoryName);
		});	
	}
	cancelDelete[0].addEventListener('click', function(){
		deleteBox[0].style.top = '-160px';
		deleteBox[0].style.left = '840px';
		deleteBox[0].classList.remove('showDeleteBox');
	});
	
});