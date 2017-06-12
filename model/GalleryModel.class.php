<?php

class GalleryModel extends Model {

	public function takegall() {
		$allPic = $this->query("SELECT path_picture, id_picture FROM picture ORDER BY `date` DESC;", Picture);
		return ($allPic);
	}

	public function takecom($id_pic) {
		$allCom = $this->query("SELECT commentary, login, `date` FROM commentary WHERE id_picture = '$id_pic';", Commentary);
		return ($allCom);
	}
}

?>