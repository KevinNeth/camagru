
<script>
	function cam_up() {     
			var link = document.getElementById('upload_mode');
			var link2 = document.getElementById('camera_mode');
			var button1 = document.getElementById("camera_radio");
			var button2 = document.getElementById("file_radio");

            if (button1.checked)
            {
    			link2.style.display = 'block'; 
    			 link.style.display = 'none';
            }
  	  		else if (button2.checked)
  	  		{
  	  			link.style.display = 'block'; 
    		 	link2.style.display = 'none';
  	  		}
    }
</script>

<div id="main">

<div>
	<label class = "test">
  		<input type="radio" name="fb" value="PingDetoure" checked="checked" />
  		<img src="/<?= $this->req->path ?>/img/filter/PingDetoure.png" style = "width:100px; height:150px;">
	</label>
	<label class = "test2">
		<input type="radio" name="fb" value="DzhengDetoure" />
  		<img src="/<?= $this->req->path ?>/img/filter/DzhengDetoure.png" style = "width:100px; height:150px;">
  	</label>
  	<label class = "test3">
		<input type="radio" name="fb" value="GratinDetoure" />
  		<img src="/<?= $this->req->path ?>/img/filter/GratinDetoure.png" style = "width:100px; height:150px;">
  	</label>
</div>

<div>
<p>
Camera Mode or Upload a File? 
<input checked="checked" type="radio" name="toggle" class="cam_or_upload" id="camera_radio" checked="checked" onchange="cam_up()"/>Camera Preview
<input type="radio" name="toggle" class="cam_or_upload" id="file_radio"  onchange="cam_up()"/>File Upload
</p>
</div>
	<div id="upload_mode" visibility="hidden">
	<input type='file' id='getval' />
		<div><button id="upload_img">Uploader une image</button></div>
		<img id="preview_img" style = ""></img>
		<canvas id= "canvas_up"></canvas>
	</div>
	 
	<div id="camera_mode">
		<video id= "video" ></video>
		<div><button id= "startbutton" >Prendre une photo</button></div>
		<canvas id= "canvas_cam"></canvas>
	</div>
</div>

<div id="side">
	<div id = "side_container">
	<?php
		print_r($this->vars['test']);
	?>
	</div>
	<img src="" id="photo" alt="photo" style = "display:none;">
	<script src="../view/elem/cam.js"></script>
</div>
