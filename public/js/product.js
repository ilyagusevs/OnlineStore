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

$(document).ready(function() {
	$('.minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$('.plus').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});
});

