
document.querySelectorAll('.modal-button').forEach(function(el) {
	el.addEventListener('click', function() {
// debugger;
		var target = document.querySelector(el.getAttribute('data-target'));
		target.classList.add('is-active');
		var src = this.querySelector('img').src;
		var imageModal = document.getElementById("image-modal");
		imageModal.setAttribute("src", src);
		target.querySelector('#detailClose').addEventListener('click',   function() {
			target.classList.remove('is-active');
	   });
	});
  });
