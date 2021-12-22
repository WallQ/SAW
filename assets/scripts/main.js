function Like(id) {
	if (document.getElementById('like-' + id).classList.contains('bi-heart')) {
		document.getElementById('like-' + id).classList.remove('bi-heart');
		document.getElementById('like-' + id).classList.add('bi-heart-fill');
	} else {
		document.getElementById('like-' + id).classList.remove('bi-heart-fill');
		document.getElementById('like-' + id).classList.add('bi-heart');
	}
}
