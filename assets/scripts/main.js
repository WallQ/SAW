function Like(id) {
	if (document.getElementById('like-' + id).classList.contains('bi-heart')) {
		document.getElementById('like-' + id).classList.remove('bi-heart');
		document.getElementById('like-' + id).classList.add('bi-heart-fill');
	} else {
		document.getElementById('like-' + id).classList.remove('bi-heart-fill');
		document.getElementById('like-' + id).classList.add('bi-heart');
	}
}

lightbox.option({
	alwaysShowNavOnTouchDevices: true,
	albumLabel: 'Image %1 of %2',
	disableScrolling: true,
	fadeDuration: 600,
	fitImagesInViewport: true,
	imageFadeDuration: true,
	resizeDuration: 700,
	showImageNumberLabel: true,
	wrapAround: true,
});
