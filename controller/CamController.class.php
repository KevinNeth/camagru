<?php
class CamController extends Controller {
	private $newWidth = 150;
	private $newHeight;

	public function view() {
		if (isset($_SESSION['login']) === false) {
			header('Location: http://localhost:8080/' . $this->req->path);
		}
		else {
			$allPic = $this->preview($_SESSION['login']);
			foreach ($allPic as $pic) {
				$this->vars['test'] .= '<img class="img_preview" src="../' . $pic->path_picture . '"><br>' .
				'<form method = "post" action = "/' . $this->req->path . '/delete/del_pic"><input type="submit" name = "Supprimer" value="' . $pic->path_picture . '"></form>';
			}
			$this->render('cam');
		}
		die();
	}

	public function save() {
		$file = uniqid(date('Y-m-d-H-i-s'));
		$encodedData = str_replace(' ', '+', $_POST['content']);
		$decodedData = base64_decode($encodedData);
		$original = imagecreatefromstring($decodedData);
		$newfilter = $this->resize(ROOT . "/img/filter/" . $_POST['filter'] . ".png");
		$this->imagecopymerge_alpha($original, $newfilter, 1, 1, 1, 1, $this->newWidth - 1, $this->newHeight - 1, 100);
		$photo_path = 'img/photo/' . $file . '.jpg';
		imagejpeg($original, $photo_path);
		$this->saveindb($photo_path, $_SESSION['login']);
		$canvasphoto = array('photo' => $photo_path, 'login' => $_SESSION['login'], 'path' => $this->req->path);
		echo json_encode($canvasphoto);
	}

	public function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    public function resize($filter) {
    	list($width, $height) = getimagesize($filter);
		$this->newHeight = $height * $this->newWidth / $width;
    	$newfilter = imagecreatetruecolor($this->newWidth, $this->newHeight);
		imagealphablending($newfilter, false);
		imagesavealpha($newfilter, true);
		$transparent = imagecolorallocatealpha($newfilter, 255, 255, 255, 127);
		imagefilledrectangle($newfilter, 0, 0, $this->newWidth, $this->newHeight, $transparent);
    	$test = imagecreatefrompng($filter);
    	imagecopyresized($newfilter, $test, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $width, $height);
    	return ($newfilter);
    }

    public function saveindb($photo_path, $login) {
    	require 'config/database.php';
		$db = new CamModel($DB_DSN, $DB_USR, $DB_PSW);
		$db->savepic($photo_path, $login);
    }

    public function preview($login) {
    	require 'config/database.php';
		$db = new CamModel($DB_DSN, $DB_USR, $DB_PSW);
		$allPic = $db->takepic($login);
		return($allPic);
    }
}

?>
