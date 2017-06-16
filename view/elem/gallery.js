(function() {

	var button = document.querySelectorAll('#button'),
		like = document.querySelectorAll('#like');
	
	for (let i = 0; i < button.length; i++)
	{
		button[i].addEventListener('click', function(ev) {
			ev.preventDefault();
			console.log(like[i]);
			var pic = this.childNodes[1];
			if (this.getAttribute("is_like") == "true")
			{
				this.setAttribute("is_like", "false");
				pic.setAttribute("src", "/camagrugit/img/button/empty_heart.png");
				change_like(false, this.getAttribute("name"));
			}
			else
			{
				this.setAttribute("is_like", "true");
				pic.setAttribute("src", "/camagrugit/img/button/colored_heart.png");
				change_like(true, this.getAttribute("name"));
			}
		}, false);
	}

	function change_like(bool, id)
	{
		let state = (bool) ? "like" : "dislike";
		var xhr = new XMLHttpRequest();
		xhr.open('POST', url() + "gallery/" + state, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('id_picture=' + id);
	}

	function url() {
		var url = window.location.href;
		url = url.split("/");
		return(url[0] + '//' + url[2] + '/' + url[3] + '/');
	}

})();