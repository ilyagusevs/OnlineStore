(function(){
	const currentImage = document.querySelector('#currentImage');
	const images = document.querySelectorAll('.details_image_thumbnail');

	images.forEach((element) => element.addEventListener('click', thumbnailClick));

	function thumbnailClick(e) {
		currentImage.src = this.querySelector('img').src;

		images.forEach((element) => element.classList.remove('active'));
		this.classList.add('active');
	}

})();


