<?php
class CamModel extends Model {
	public function savepic($photo_path, $login) {
		$this->query("INSERT INTO `picture` (`path_picture`, `login`, `date`)
			VALUES ('$photo_path', '$login', NOW());");
	}

	public function takepic($login) {
		$allPic = $this->query("SELECT path_picture FROM picture WHERE login = '$login' ORDER BY `date` DESC;", Picture);
		return($allPic);
	}
}

?>