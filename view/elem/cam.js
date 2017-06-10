(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas_cam   = document.querySelector('#canvas_cam'),
      canvas_up    = document.querySelector('#canvas_up'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      upload_img	= document.querySelector('#upload_img'),
      width = 500,
      height = 0;
   

	cam_up(); // call the camera view at first/

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

	video.addEventListener('canplay', function(ev){
    	if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas_cam.setAttribute('width', width);
			canvas_cam.setAttribute('height', height);
			canvas_up.setAttribute('width', width);
			canvas_up.setAttribute('height', height);
			streaming = true;
		}
}, false);

	function takepicture() {
		canvas_cam.width = width;
    	canvas_cam.height = height;
    	canvas_cam.getContext('2d').drawImage(video, 0, 0, width, height);
    	var data = canvas_cam.toDataURL('image/png');
    	photo.setAttribute('src', data);
		savePic();
}

	startbutton.addEventListener('click', function(ev) {
		takepicture();
		ev.preventDefault();
}, false);


	function putPreview(imgPath, imgName, oriPath)
	{
		var imgPreview = document.querySelectorAll('.img_preview'),
			parentDiv = document.getElementById('side_container'),
			newImg = document.createElement('img'),
			form = document.createElement('form'),
			button = document.createElement('input');
		form.setAttribute("method", "post");
		form.setAttribute("action", "/" + oriPath + "/delete/del_pic");
		button.setAttribute("name", "Supprimer");
        button.setAttribute("value", imgName);
        button.setAttribute("type", "submit");
        form.appendChild(button);
		newImg.src = imgPath;
		newImg.className = 'img_preview';
		parentDiv.insertBefore(form, imgPreview[0]);
		parentDiv.insertBefore(newImg, form);
	}

	function savePic() {
		var filter = document.querySelector('input[name="fb"]:checked').value;
		var xhr = new XMLHttpRequest();
		var head = /^data:image\/(png|jpeg);base64,/;
		var data = canvas_cam.toDataURL('image/png').replace(head, '');
		xhr.open('POST', url() + "cam/save", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('content=' + data + "&filter=" + filter);
		xhr.onload = function () {
	    	if (xhr.readyState === xhr.DONE) {
        		if (xhr.status === 200) {
		        	var string = xhr.responseText;
					var info = JSON.parse(string);
					base_image = new Image();
					base_image.src = "../" + info['photo'];
					base_image.onload = function()
					{
						canvas_cam.width = width;
						canvas_cam.height = height;
						canvas_cam.getContext('2d').drawImage(base_image, 0, 0, width, height);
					}
					putPreview("../" + info['photo'], info['photo'], info['path']);
		    	}
			}
		};
	}

	function url() {
		var url = window.location.href;
		url = url.split("/");
		return(url[0] + '//' + url[2] + '/' + url[3] + '/');
	}

	

	function previewFile(){
       var preview = document.getElementById('preview_img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
           var filter = document.querySelector('input[name="fb"]:checked').value;
		var xhr = new XMLHttpRequest();
		var head = /^data:image\/(png|jpeg);base64,/;
		var data = reader.result.replace(head, '');
		xhr.open('POST', url() + "cam/save", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('content=' + data + "&filter=" + filter);
		xhr.onload = function () {
	    	if (xhr.readyState === xhr.DONE) {
        		if (xhr.status === 200) {
		        	var string = xhr.responseText;
					var info = JSON.parse(string);
					base_image = new Image();
					base_image.src = "../" + info['photo'];
					base_image.onload = function()
					{
						canvas_up.width = width;
						canvas_up.height = height;
						canvas_up.getContext('2d').drawImage(base_image, 0, 0, width, height);
					}
					putPreview("../" + info['photo'], info['photo'], info['path']);
		    	}
			}
		};
       }
       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "";
       }
   }

   	upload_img.addEventListener('click', function(ev) {
		previewFile();
}, false);


})();


